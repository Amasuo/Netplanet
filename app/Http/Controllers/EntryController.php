<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;

use App\Models\Entry;
use App\Imports\EntryImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Rule;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class EntryController extends Controller
{

    function index() {
        $array= array();
        $doneIndexes=[];

        $data = DB::select('select * from entries order by created_at desc');
        for($i=0;$i<count($data);$i++){
            if(!in_array($i,$doneIndexes)){
            $doneIndexes[] = $i;
            $values=[];
            array_push($values,$data[$i]);
            //Group by source_ip, source_port and protocol_transport
            for($j=$i+1;$j<count($data);$j++){
                if(($data[$i]->source_ip == $data[$j]->source_ip) && ($data[$i]->source_port == $data[$j]->source_port) && ($data[$i]->protocol_transport == $data[$j]->protocol_transport)) {
                    array_push($values,$data[$j]);
                    $doneIndexes[]=$j;
                }
            }
            $globalKey= $data[$i]->source_ip.' '.$data[$i]->source_port.' '.$data[$i]->protocol_transport;
            if($data[$i]->aknowledged == 'false') {
                $globalKey.=' highlight';      //Highlight group if there are unackonwledged entries
            }
            $array[$globalKey]=$values;
        }
        }
        $data= $array;
        return view('entry_pagination', compact('data'));
    }

    public function import() {
        //import file to database
        $file = request()->file('file');
        (new EntryImport)->import($file);

        $rules = Rule::all();
        $entries = Entry::all();

        //replace null with NaN
        foreach($entries as $entry) {
            foreach($entry->getAttributes() as $key => $value) {
                if($value =='') {
                    $entry->$key='NaN';
                }
                $entry->save();
            }
        }

        $this->refresh();
        
        return back();
    }

    public function refresh() {
        $rules = Rule::all();
        $entries = Entry::all();
        //aknowledge according to Permanent Rules
        foreach($entries as $entry) {
            foreach($rules as $rule) {
                if ($rule->permanent == 'true'){
                    $entry->aknowledged = 'true';   //we will suppose that the entry applies the rules
                    foreach($rule->getAttributes() as $key => $value) {
                        if($value!='' && $key!='id' && $key!='created_at' && $key!='updated_at' && $key!='permanent'){
                            if($entry->$key != $value) {
                                $entry->aknowledged = 'false'; //if one field isn't matched then it doesn't apply the rule
                            }
                        }
                    }
                    $entry->save();
                    if($entry->aknowledged == 'true') break;
                }
            }
        }

        //aknowledge according to Non-Permanent Rules (Rules that are coming from previous aknowledgements (less than a week))
        foreach($entries as $entry) {
            foreach($rules as $rule) {
                $date = new DateTime(date("Y-m-d H:i:s"));
                $diff = $date->diff($rule->created_at);
                if ($rule->permanent == 'false' && $diff->d<=7){
                    $entry->aknowledged = 'true';   //we will suppose that the entry applies the rules
                    foreach($rule->getAttributes() as $key => $value) {
                        if($value!='' && $key!='id' && $key!='created_at' && $key!='updated_at' && $key!='permanent'){
                            if($entry->$key != $value) {
                                $entry->aknowledged = 'false'; //if one field isn't matched then it doesn't apply the rule
                            }
                        }
                    }
                    $entry->save();
                    if($entry->aknowledged == 'true') break;
                }
            }
        }
    }

    public function aknowledge(int $id) {
        //aknowledge entry
        $entry = Entry::where('id', $id)->first();
        $entry->aknowledged = 'true';
        $entry->save();

        //create temporary rule
        $rule = new Rule();
        $rule->source_ip = $entry->source_ip;
        $rule->protocol_transport = $entry->protocol_transport;
        $rule->source_port = $entry->source_port;
        $rule->permanent = 'false';
        $rule->save();

        return back();
    }

    public function aknowledgeGroup(string $source_ip, string $protocol_transport, string $source_port) {
        //aknowledge entry
        $entries = Entry::where('source_ip', $source_ip)
        ->where('protocol_transport', $protocol_transport)
        ->where('source_port', $source_port)->get();

        foreach($entries as $entry) {
            $entry->aknowledged = 'true';
            $entry->save();
        }  

        //create temporary rule
        $rule = new Rule();
        $rule->source_ip = $source_ip;
        $rule->protocol_transport = $protocol_transport;
        $rule->source_port = $source_port;
        $rule->permanent = 'false';
        $rule->save();

        return back();
    }
}
