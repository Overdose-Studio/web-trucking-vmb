@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-plus fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Create Order</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('shipment.create') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('order_type') ? 'has-error' : '' }}">
                        <label for="order_type">Order Type</label>
                        <select name="order_type" class="form-control">
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('order_type') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                        <label for="client_id">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('party') ? 'has-error' : '' }}">
                        <label for="party">Party</label>
                        <input type="number" name="party" class="form-control" value="0">
                        <span class="text-danger">{{ $errors->first('party') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                        <label>Photo</label>
                        <input type="file" class="form-control-file mt-1" name="photo" placeholder="Order Photo" accept="image/*">
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;
                            Create Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
