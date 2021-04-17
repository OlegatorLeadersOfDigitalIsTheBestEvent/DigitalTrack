@extends('layouts.app')


@section('content')
    <rules-component 
        :data-room-number="{{ json_encode($key) }}" 
    ></rules-component>
@endsection

