@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dta.show', $shipment->id) }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Back to DTP
        List</a>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h1 class="panel-heading">Update Daily Trucking Actually</h1>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form action="{{ route('dta.update', [$shipment->id, $dta->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div
                                class="form-group
                                        {{ $errors->has('driver_name') ? 'has-error' : '' }}">
                                <label for="driver_name">Driver Name</label>
                                <input type="text" class="form-control" name="driver_name" placeholder="Driver Name"
                                    value="{{ $dta->driver_name }}">
                                <span class="text-danger">{{ $errors->first('driver_name') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail"
                                    placeholder="Destination 1"
                                    value="{{ $dta->destination_1_id ? $dta->destination1->detail : '' }}">
                                <input type="file" class="form-control-file mt-1" name="destination_1_image"
                                    placeholder="Destination 1 Image">
                                <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail"
                                    placeholder="Destination 2"
                                    value="{{ $dta->destination_2_id ? $dta->destination2->detail : '' }}">
                                <input type="file" class="form-control-file mt-1" name="destination_2_image"
                                    placeholder="Destination 2 Image">
                                <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail"
                                    placeholder="Destination 3"
                                    value="{{ $dta->destination_3_id ? $dta->destination3->detail : '' }}">
                                <input type="file" class="form-control-file mt-1" name="destination_3_image"
                                    placeholder="Destination 3 Image">
                                <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('size') ? 'has-error' : '' }}">
                                <label>Size</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="size1"
                                        value="20" {{ old('size') == 20 || $dta->size == 20 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="size1">
                                        20"
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="size2"
                                        value="40" {{ old('size') == 40 || $dta->size == 40 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="size2">
                                        40"
                                    </label>
                                </div>
                                <span class="text-danger">{{ $errors->first('size') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Price"
                                    value="{{ $dta->price }}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <div
                                class="form-group
                                        {{ $errors->has('truck_id') ? 'has-error' : '' }}">
                                <label>Truck</label>
                                <select name="truck_id" class="form-control">
                                    <option value="" @if ($dta->truck_id == null) selected @endif>Vendor Truck
                                    </option>
                                    @foreach ($trucks as $truck)
                                        <option value="{{ $truck->id }}"
                                            {{ $dta->truck_id == $truck->id ? 'selected' : '' }}>
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
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h2>Daily Trucking Plan</h2>
                </div>
                <div class="card-body">
                    <h5>Truck : {{ $selected->truck_id ? $selected->truck->license_plate : 'Vendor Truck' }}</h5>
                    <p><strong>Driver Name </strong>: {{ $selected->driver_name }}</p>
                    <p><strong>Size </strong>: {{ $selected->size }}</p>
                    <p><strong>Price </strong>: {{ $selected->price }}</p>
                    <p><strong>Destination 1
                        </strong>:{{ $selected->destination_1_id != null ? $selected->destination1->detail : '' }} </br>
                        {{ $selected->destination_1_id != null ? $selected->destination1->image : '' }}</p>
                    <p><strong>Destination 2
                        </strong>:{{ $selected->destination_2_id != null ? $selected->destination2->detail : '' }} </br>
                        {{ $selected->destination_2_id != null ? $selected->destination2->image : '' }}</p>
                    <p><strong>Destination 3
                        </strong>:{{ $selected->destination_3_id != null ? $selected->destination3->detail : '' }} </br>
                        {{ $selected->destination_3_id != null ? $selected->destination3->image : '' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
