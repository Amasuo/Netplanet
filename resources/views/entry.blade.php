
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Import Entries</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
      label{
        display: inline-block;
        width: 140px;
        text-align: right;
        padding:5px;
        }
  </style>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Import Entries</h3>
     <br />
     <div class="panel panel-default">
          <div class="panel-heading">
           <h3 class="panel-title">Import Entries</h3>
          </div>
          <div class="panel-body">
           <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
                  <br>
                  <button class="btn btn-success">Import Data</button>
           </form>
              @yield('csv_data')
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">
           <h3 class="panel-title"><a data-toggle="collapse" href="#ruleForm" aria-expanded="false" aria-controls="ruleForm">Add Rule</a></h3>
          </div>
          <div class="collapse" id="ruleForm">
           <form action="{{ route('addRule') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Source IP</label><input type="text" name="source_ip" >
            <br>
            <label>Protocol Transport</label><input type="text" name="protocol_transport" >
            <br>
            <label>Source Port</label><input type="text" name="source_port" >
            <br>
            <label>Protocol Application</label><input type="text" name="protocol_application" >
            <br>
            <label>Source FQDN</label><input type="text" name="source_fqdn" >
            <br>
            <label>Source Local Hostname</label><input type="text" name="source_local_hostname" >
            <br>
            <label>Source Local Protocol</label><input type="text" name="source_local_ip" >
            <br>
            <label>Source URL</label><input type="text" name="source_url" >
            <br>
            <label>Source ASN</label><input type="text" name="source_asn" >
            <br>
            <label>Source Geolocation CC</label><input type="text" name="source_geolocation_cc" >
            <br>
            <label>Source Geolocation City</label><input type="text" name="source_geolocation_city" >
            <br>
            <label>Classification Taxonomy</label><input type="text" name="classification_taxonomy" >
            <br>
            <label>Classification Type</label><input type="text" name="classification_type" >
            <br>
            <label>Classification Identifier</label><input type="text" name="classification_identifier" >
            <br>
            <label>Destination IP</label><input type="text" name="destination_ip" >
            <br>
            <label>Destination Port</label><input type="text" name="destination_port" >
            <br>
            <label>Destination FQDN</label><input type="text" name="destination_fqdn" >
            <br>
            <label>Destination URL</label><input type="text" name="destination_url" >
            <br>
            <label>Feed</label><input type="text" name="feed" >
            <br>
            <label>Event Description Text</label><input type="text" name="event_description_text" >
            <br>
            <label>Event Description URL</label><input type="text" name="event_description_url" >
            <br>
            <label>Malware Name</label><input type="text" name="malware_name" >
            <br>
            <label>Extra</label><input type="text" name="extra" >
            <br>
            <label>Comment</label><input type="text" name="comment" >
            <br>
            <label>Additional Field Freetext</label><input type="text" name="additional_field_freetext" >
            <br>
            <label>Feed Documentaion</label><input type="text" name="feed_documentation" >
            <br>
            <label>Version</label><input type="text" name="version" >
            <br>
                  <br>
                  <button class="btn btn-success">Add Rule</button>
           </form>
          </div>
      </div>
  </div>
 </body>
</html>