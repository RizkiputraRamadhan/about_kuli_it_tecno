@extends('layouts.client')
@section('title', $pages)
@section('content')
    @include('widget.client.hero')
    @include('widget.client.fitures')
    @include('widget.client.step')
    @include('widget.client.banefit')

    @include('widget.client.list-project', [
        'data' => $sources,
        'header' => true,
        'animate' => 'zoom-in',
        'column' => 3,
    ])
    @include('widget.client.about')
@endsection
