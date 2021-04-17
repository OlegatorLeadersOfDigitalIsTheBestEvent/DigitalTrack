@extends('layouts.app')


@section('content')
    <result-component 
        :data-room-number="{{ json_encode($key) }}" 
    ></result-component>
@endsection

