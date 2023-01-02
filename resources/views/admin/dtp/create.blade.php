@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Add Truck</h1>
            <div class="panel-body">
                <form action="{{ route('dtp.store', $shipment->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="driver_name">Driver Name</label>
                        <input type="text" class="form-control" name="driver_name" placeholder="Driver Name">
                    </div>
                    <div class="form-group">
                        <label>Destination 1</label>
                        <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1">
                    </div>
                    <div class="form-group">
                        <label>Destination 2</label>
                        <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2">
                    </div>
                    <div class="form-group">
                        <label>Destination 3</label>
                        <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3">
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input type="decimal" class="form-control" name="size" placeholder="Size">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="truck_id">Truck</label>
                        <select name="truck_id" class="form-control">
                            <option value="">Vendor Truck</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}">{{ $truck->license_plate }} | {{ $truck->brand }}</option>
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
