@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-edit fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Edit Order</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('shipment.update', $shipment->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('order_type') ? 'has-error' : '' }}">
                        <label for="order_type">Order Type</label>
                        <select name="order_type" class="form-control">
                            <option value="import" @if ($shipment->order_type == 'import') selected @endif>Import</option>
                            <option value="export" @if ($shipment->order_type == 'export') selected @endif>Export</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('order_type') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                        <label for="client_id">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @if ($shipment->client_id == $client->id) selected @endif>
                                    {{ $client->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('party') ? 'has-error' : '' }}">
                        <label for="party">Party</label>
                        <input type="number" name="party" class="form-control" value="{{ $shipment->party }}">
                        <span class="text-danger">{{ $errors->first('party') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                        <label>Photo</label><br>
                        <a href="{{ asset($shipment->photo) }}" target="_blank">
                            <img src="{{ asset($shipment->photo) }}" class="img-thumbnail" width="100">
                        </a>
                        <input type="file" class="form-control-file mt-1" name="photo" placeholder="Order Photo" accept="image/*">
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>&nbsp;
                            Save Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
