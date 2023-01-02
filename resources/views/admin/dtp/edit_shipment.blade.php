@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dtp.index') }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Back to DTP
        List</a>
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Edit Daily Trucking Plan</h1>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('dtp.update_shipment', $shipment->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="order_type">Order Type</label>
                        <select name="order_type" class="form-control">
                            <option value="import" @if ($shipment->order_type == 'import') selected @endif>Import</option>
                            <option value="export" @if ($shipment->order_type == 'export') selected @endif>Export</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @if ($shipment->client_id == $client->id) selected @endif>
                                    {{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
