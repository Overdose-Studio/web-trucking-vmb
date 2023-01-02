@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Back to DTP
        List</a>
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Add Truck</h1>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('dtp.store', $shipment->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="driver_name">Driver Name</label>
                        <input type="text" class="form-control" name="driver_name" placeholder="Driver Name"
                            value="{{ old('driver_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Destination 1</label>
                        <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1">
                        <input type="file" class="form-control-file mt-1" name="destination_1_image"
                            placeholder="Destination 1 Image">
                    </div>
                    <div class="form-group">
                        <label>Destination 2</label>
                        <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2">
                        <input type="file" class="form-control-file mt-1" name="destination_2_image"
                            placeholder="Destination 2 Image">
                    </div>
                    <div class="form-group">
                        <label>Destination 3</label>
                        <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3">
                        <input type="file" class="form-control-file mt-1" name="destination_3_image"
                            placeholder="Destination 3 Image">
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="size" id="size1" value="20"
                                {{ old('size') == 20 ? 'checked' : '' }}>
                            <label class="form-check-label" for="size1">
                                20"
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="size" id="size2" value="40"
                                {{ old('size') == 40 ? 'checked' : '' }}>
                            <label class="form-check-label" for="size2">
                                40"
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="truck_id">Truck</label>
                        <select name="truck_id" class="form-control">
                            <option value="">Vendor Truck</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->license_plate }} | {{ $truck->brand }}
                                </option>
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
