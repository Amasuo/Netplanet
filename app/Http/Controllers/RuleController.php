<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rule;

class RuleController extends Controller
{

    public function add() {
        $rule = new Rule();
        $rule->time_source = request()->time_source;
        $rule->source_ip = request()->source_ip;
        $rule->protocol_transport = request()->protocol_transport;
        $rule->source_port = request()->source_port;
        $rule->protocol_application = request()->protocol_application;
        $rule->source_fqdn = request()->source_fqdn;
        $rule->source_local_hostname = request()->source_local_hostname;
        $rule->source_local_ip = request()->source_local_ip;
        $rule->source_url = request()->source_url;
        $rule->source_asn = request()->source_asn;
        $rule->source_geolocation_cc = request()->source_geolocation_cc;
        $rule->source_geolocation_city = request()->source_geolocation_city;
        $rule->classification_taxonomy = request()->classification_taxonomy;
        $rule->classification_type = request()->classification_type;
        $rule->classification_identifier = request()->classification_identifier;
        $rule->destination_ip = request()->destination_ip;
        $rule->destination_port = request()->destination_port;
        $rule->destination_fqdn = request()->destination_fqdn;
        $rule->destination_url = request()->destination_url;
        $rule->feed = request()->feed;
        $rule->event_description_text = request()->event_description_text;
        $rule->event_description_url = request()->event_description_url;
        $rule->malware_name = request()->malware_name;
        $rule->extra = request()->extra;
        $rule->comment = request()->comment;
        $rule->additional_field_freetext = request()->additional_field_freetext;
        $rule->feed_documentation = request()->feed_documentation;
        $rule->version = request()->version;

        $rule->save();

        $entrycontroller = new EntryController();
        $entrycontroller->refresh();
        return back();
    }

    public function save(string $source_ip, string $protocol_transport, string $source_port) {
        $rule = new Rule();
        $rule->source_ip = $source_ip;
        $rule->protocol_transport = $protocol_transport;
        $rule->source_port = $source_port;
        $rule->permanent = 'true';
        $rule->save();

        $entrycontroller = new EntryController();
        $entrycontroller->refresh();
        return back();
    }    
}
