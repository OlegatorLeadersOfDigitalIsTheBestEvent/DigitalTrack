@extends('layouts.app')


@section('content')
    <game-component :data-room-number="{{ json_encode($key) }}"></game-component>
@endsection
