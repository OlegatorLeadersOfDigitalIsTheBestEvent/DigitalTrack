@extends('layouts.app')

@section('content')

<test-component ids="{{ $ids }}" score="{{ Auth::user()->score }}"></test-component>

@endsection
