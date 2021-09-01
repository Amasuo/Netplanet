<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $table = 'entries';

    protected $fillable = [
        'time_source',
        'source_ip',
        'protocol_transport',
        'source_port',
        'protocol_application',
        'source_fqdn',
        'source_local_hostname',
        'source_local_ip',
        'source_url',
        'source_asn',
        'source_geolocation_cc',
        'source_geolocation_city',
        'classification_taxonomy',
        'classification_type',
        'classification_identifier',
        'destination_ip',
        'destination_port',
        'destination_fqdn',
        'destination_url',
        'feed',
        'event_description_text',
        'event_description_url',
        'malware_name',
        'extra',
        'comment',
        'additional_field_freetext',
        'feed_documentation',
        'version',
        'aknowledged',
    ];
}
