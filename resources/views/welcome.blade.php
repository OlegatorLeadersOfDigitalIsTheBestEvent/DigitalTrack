@extends('layouts.app')

@section('content')
    <login-component :data-room-number="{{ json_encode($id) }}"></login-component>
@endsection
