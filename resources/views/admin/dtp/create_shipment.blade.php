@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Create Daily Trucking Plan</h1>
            <div class="panel-body">
                <form action="{{ route('dtp.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach ([1, 2, 3, 4] as $client)
                                <option value="{{ $client }}">{{ $client }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="truck_id">Bill</label>
                        <select name="truck_id" class="form-control">
                            @foreach ([1, 2, 3, 4] as $client)
                                <option value="{{ $client }}">{{ $client }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
