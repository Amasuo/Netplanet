@extends('entry')

@section('csv_data')

@php
$j=0;
@endphp
@foreach($data as $key => $values)
@php
$j++;
@endphp
<div class="panel panel-default">
    @if(str_contains($key,'highlight'))
    <div class="alert alert-danger"><h3 class="panel-title"><a data-toggle="collapse" href="#collapse<?=$j?>" >IP: {{ $values[0]->source_ip }} - Port: {{ $values[0]->source_port }} - Protocol: {{ $values[0]->protocol_transport }}</a></h3></div>
    @else
    <div class="panel-heading"><h3 class="panel-title"><a data-toggle="collapse" href="#collapse<?=$j?>" >IP: {{ $values[0]->source_ip }} - Port: {{ $values[0]->source_port }} - Protocol: {{ $values[0]->protocol_transport }} </a></h3></div>
    @endif
<div class="collapse" id="collapse<?=$j?>">
<a href="aknowledgeGroup/{{ $values[0]->source_ip }}/{{ $values[0]->protocol_transport }}/{{ $values[0]->source_port }}"><input type="submit" class= "btn btn-primary" value="Aknowledge Group"> </a>
<a href="/rule/save/{{ $values[0]->source_ip }}/{{ $values[0]->protocol_transport }}/{{ $values[0]->source_port }}"><input type="submit" class= "btn btn-info" value="Save as Rule"> </a>
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
     @foreach($values as $keyV => $row)
  <tr>
   <td>{{ $row->time_source }}</td>
   <td>{{ $row->protocol_application }}</td>
   <td>{{ $row->source_fqdn }}</td>
   <td>{{ $row->source_local_hostname }}</td>
   <td>{{ $row->source_local_ip }}</td>
   @if($row->aknowledged == 'false')
   <td><a href="aknowledge/{{ $row->id }}"><input type="submit" class= "btn btn-primary" value="Aknowledge"> </a></td>
   @else
   <td>{{ $row->aknowledged }}</td>
   @endif
  </tr>
  @endforeach
</tbody>
</table>
</div>
</div>
@endforeach


@endsection