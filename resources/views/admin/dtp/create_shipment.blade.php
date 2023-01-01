@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Create Daily Trucking Plan</h1>
            <div class="panel-body">
                <form action="{{ route('dtp.store_shipment') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="order_type">Order Type</label>
                        <select name="order_type" class="form-control">
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
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
