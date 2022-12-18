@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Dashboard</h1>
            <p class="m-0">Welcome {{ auth()->user()->name }}</p>
        </div>
    </div>
@endsection
