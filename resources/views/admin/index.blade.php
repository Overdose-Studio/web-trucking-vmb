@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-home fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Dashboard</h1>
            </div>
        </div>
        <div class="card-body">
            <p class="m-0">Welcome {{ auth()->user()->name }}</p>
        </div>
    </div>
@endsection
