<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('time_source')->nullable();
            $table->string('source_ip')->nullable();
            $table->string('protocol_transport')->nullable();
            $table->string('source_port')->nullable();
            $table->longText('protocol_application')->nullable();
            $table->longText('source_fqdn')->nullable();
            $table->longText('source_local_hostname')->nullable();
            $table->longText('source_local_ip')->nullable();
            $table->longText('source_url')->nullable();
            $table->longText('source_asn')->nullable();
            $table->longText('source_geolocation_cc')->nullable();
            $table->longText('source_geolocation_city')->nullable();
            $table->longText('classification_taxonomy')->nullable();
            $table->longText('classification_type')->nullable();
            $table->longText('classification_identifier')->nullable();
            $table->longText('destination_ip')->nullable();
            $table->longText('destination_port')->nullable();
            $table->longText('destination_fqdn')->nullable();
            $table->longText('destination_url')->nullable();
            $table->longText('feed')->nullable();
            $table->longText('event_description_text')->nullable();
            $table->longText('event_description_url')->nullable();
            $table->longText('malware_name')->nullable();
            $table->longText('extra')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('additional_field_freetext')->nullable();
            $table->longText('feed_documentation')->nullable();
            $table->string('version')->nullable();
            $table->string('permanent')->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
    }
}
