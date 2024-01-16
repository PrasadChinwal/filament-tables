@extends('main')
@section('title', 'Help')
@section('content')

<p class="text-center" ></p>

<ul class="list-group">

<li class="list-group-item justify-content-between">
Click Home to go to the main page.
</li>

</ul>

<p class="text-center">For assistance, please contact ITS Client Services at    <a  href="mailto:techsupport@uis.edu?subject={{ env('APP_NAME') }} Help" >techsupport@uis.edu</a>  </p>
<div class="col-xs-12" style="height:450px;"></div>

@stop
