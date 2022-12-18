@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Create Daily Trucking Plan</h1>
            <div class="panel-body">
                <form action="{{ route('dtp.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Destination 1</label>
                        <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1">
                        <input type="file" class="form-control" name="destination_1_image"
                            placeholder="Destination 1 Image">
                    </div>
                    <div class="form-group">
                        <label>Destination 2</label>
                        <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2">
                        <input type="file" class="form-control" name="destination_2_image"
                            placeholder="Destination 2 Image">
                    </div>
                    <div class="form-group">
                        <label>Destination 3</label>
                        <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3">
                        <input type="file" class="form-control" name="destination_3_image"
                            placeholder="Destination 3 Image">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="order_type">Order Type</label>
                        <select name="order_type" class="form-control">
                            <option value="export">Export</option>
                            <option value="import">Import</option>
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
                        <label for="truck_id">Truck</label>
                        <select name="truck_id" class="form-control">
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}">{{ $truck->license_plate }}</option>
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
