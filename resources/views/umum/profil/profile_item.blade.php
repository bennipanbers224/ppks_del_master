@extends('layouts.umum.app')
@section('content')
<div class="title-container">
    <h1 class="title-styling">{{$data->item}}</h1>
</div>
<div class="container mt-4">
    {!! $data->deskripsi !!}
</div>
@endsection