@extends('layouts.app')

@section('content')

<div class="pagetitle">
  <h1>Ventas</h1>
</div>
<section class="section" id="app">
  <sales-component :id="{{Auth::user()->id}} "></sales-component>
</section>

<script src="{{asset('js/app.js')}}"></script>
@endsection