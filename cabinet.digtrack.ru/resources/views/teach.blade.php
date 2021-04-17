@extends('layouts.app')

@section('content')

<teach-component ids="{{ $ids }}" score="{{ Auth::user()->score }}"></teach-component>

@endsection
