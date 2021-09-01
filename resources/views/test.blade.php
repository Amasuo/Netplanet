@extends('entry')

@section('csv_data')

@php
$i=0;
@endphp
@foreach($data as $keyIP => $itemsIP)
@php
$i++;
@endphp
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a data-toggle="collapse" href="#collapse<?=$i?>" > {{ $keyIP }} </a></h3>
</div>
<div class="collapse" id="collapse<?=$i?>">
<table class="table table-bordered table-striped">
 <thead>
  <tr>
   <th>Time Source</th>
   <th>Protocol Application</th>
   <th>Source FQDN</th>
   <th>Source Local Hostname</th>
   <th>Source Local IP</th>
   <th>Aknowledged</th>
  </tr>
 </thead>
 <tbody>
@foreach($itemsIP as $keyPort => $itemsPort)
@foreach($itemsPort as $keyProtocol => $itemsProtocol)
@foreach($itemsProtocol as $key => $row)
  <tr>
   <td>{{ $row->time_source }}</td>
   <td>{{ $row->protocol_application }}</td>
   <td>{{ $row->source_fqdn }}</td>
   <td>{{ $row->source_local_hostname }}</td>
   <td>{{ $row->source_local_ip }}</td>
   @if($row->aknowledged == 'false')
   <td><a href="entry/aknowledge/{{ $row->id }}"><input type="submit" class= "btn btn-primary" value="Aknowledge"> </a></td>
   @else
   <td>{{ $row->aknowledged }}</td>
   @endif
  </tr>
@endforeach
@endforeach
@endforeach
</tbody>
</table>
</div>
</div>
@endforeach

@endsection