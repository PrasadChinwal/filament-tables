@extends('main')
@section('title', 'Index')
@section('content')
<div id='app'>
<employee-lookup placeholder="Search by Employee UIN or Last Name" url="/{{ env('MIX_APP_NAME') }}/api/v1/employeelookup" field_name="emp_supervisor_name" field_value="Tulio Llosa"></employee-lookup>
</div>
@stop
