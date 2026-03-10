@extends('adminlte::page')

@section('title','Question Paper')

@section('content_header')
<h1>{{ $exam->title }}</h1>
@stop

@section('content')

@foreach($exam->questions as $q)

<div class="card mb-3">

<div class="card-body">

<p><strong>{{ $q->question }}</strong></p>

<ul>

<li>A. {{ $q->option_a }}</li>
<li>B. {{ $q->option_b }}</li>
<li>C. {{ $q->option_c }}</li>
<li>D. {{ $q->option_d }}</li>

</ul>

</div>

</div>

@endforeach

@stop