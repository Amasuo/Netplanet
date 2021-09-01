<?php

namespace App\Imports;

use App\Models\Entry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;

class EntryImport implements ToModel, WithStartRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Entry([
            'time_source' => $row[0],
            'source_ip' => $row[1],
            'protocol_transport' => $row[2],
            'source_port' => $row[3],
            'protocol_application' => $row[4],
            'source_fqdn' => $row[5],
            'source_local_hostname' => $row[6],
            'source_local_ip' => $row[7],
            'source_url' => $row[8],
            'source_asn' => $row[9],
            'source_geolocation_cc' => $row[10],
            'source_geolocation_city' => $row[11],
            'classification_taxonomy' => $row[12],
            'classification_type' => $row[13],
            'classification_identifier' => $row[14],
            'destination_ip' => $row[15],
            'destination_port' => $row[16],
            'destination_fqdn' => $row[17],
            'destination_url' => $row[18],
            'feed' => $row[19],
            'event_description_text' => $row[20],
            'event_description_url' => $row[21],
            'malware_name' => $row[22],
            'extra' => $row[23],
            'comment' => $row[24],
            'additional_field_freetext' => $row[25],
            'feed_documentation' => $row[26],
            'version' => $row[27],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
