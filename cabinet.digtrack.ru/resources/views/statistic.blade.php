@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-4">
            <canvas id="barChart"  width="300" height="300"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="barChart2" width="300" height="300"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="barChart3" width="300" height="300"></canvas>
        </div>
    </div>
</div>

@endsection
