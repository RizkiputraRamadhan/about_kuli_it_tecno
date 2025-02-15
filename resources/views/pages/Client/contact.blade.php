@extends('layouts.client')
@section('title', $pages)
@section('content')
    @include('widget.client.contact')

    @include('widget.client.list-project', [
        'data' => $sources,
        'header' => true,
        'animate' => 'zoom-in',
        'column' => 3,
    ])

    @include('widget.client.about')

@endsection
