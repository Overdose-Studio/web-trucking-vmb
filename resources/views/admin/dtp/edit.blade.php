@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Update Truck</h1>
            <div class="panel-body">
                <form action="{{ route('dtp.update', [$shipment->id, $dtp->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div
                        class="form-group
                                {{ $errors->has('driver_name') ? 'has-error' : '' }}">
                        <label for="driver_name">Driver Name</label>
                        <input type="text" class="form-control" name="driver_name" placeholder="Driver Name"
                            value="{{ $dtp->driver_name }}">
                        <span class="text-danger">{{ $errors->first('driver_name') }}</span>
                    </div>
                    <div
                        class="form-group
                                {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                        <label>Destination 1</label>
                        <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1"
                            value="{{ $dtp->destination_1_id != null ? $dtp->destination1->detail : '' }}">
                        <input type="file" class="form-control" name="destination_1_image"
                            placeholder="Destination 1 Image">
                        <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                    </div>
                    <div
                        class="form-group
                                {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                        <label>Destination 2</label>
                        <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2"
                            value="{{ $dtp->destination_2_id != null ? $dtp->destination2->detail : '' }}">
                        <input type="file" class="form-control" name="destination_2_image"
                            placeholder="Destination 2 Image">
                        <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                    </div>
                    <div
                        class="form-group
                                {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                        <label>Destination 3</label>
                        <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3"
                            value="{{ $dtp->destination_3_id != null ? $dtp->destination3->detail : '' }}">
                        <input type="file" class="form-control" name="destination_3_image"
                            placeholder="Destination 3 Image">
                        <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                    </div>
                    <div class="form-group
                                {{ $errors->has('size') ? 'has-error' : '' }}">
                        <label>Size</label>
                        <input type="decimal" class="form-control" name="size" placeholder="Size"
                            value="{{ $dtp->size }}">
                        <span class="text-danger">{{ $errors->first('size') }}</span>
                    </div>
                    <div class="form-group
                                {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price"
                            value="{{ $dtp->price }}">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                    <div
                        class="form-group
                                {{ $errors->has('truck_id') ? 'has-error' : '' }}">
                        <label>Truck</label>
                        <select name="truck_id" class="form-control">
                            <option value="" @if ($dtp->truck_id == null) selected @endif>Vendor Truck</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ $dtp->truck_id == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->license_plate }} | {{ $truck->brand }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('truck_id') }}</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
