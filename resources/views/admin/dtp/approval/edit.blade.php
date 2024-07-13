@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-edit fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Update Truck</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('dtp.update', [$shipment->id, $dtp->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('driver_name') ? 'has-error' : '' }}">
                        <label for="driver_name">Driver Name</label>
                        <select name="driver_name" class="form-control" readonly style="pointer-events: none;">
                            <option value="" disabled selected>Driver Name</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->name }}" {{ old('driver_name') == $driver->name || $dtp->driver_name == $driver->name ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('driver_name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('truck_id') ? 'has-error' : '' }}">
                        <label>Truck</label>
                        <select name="truck_id" class="form-control" readonly style="pointer-events: none;">
                            <option value="" @if ($dtp->truck_id == null) selected @endif>Vendor Truck</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ $dtp->truck_id == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->license_plate }} | {{ $truck->brand }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('truck_id') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                        <label>Destination 1</label>
                        <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1" value="{{ $dtp->destination_1_id != null ? $dtp->destination1->detail : '' }}" readonly>
                        <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                        <label>Destination 2</label>
                        <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2" value="{{ $dtp->destination_2_id != null ? $dtp->destination2->detail : '' }}" readonly>
                        <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                        <label>Destination 3</label>
                        <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3" value="{{ $dtp->destination_3_id != null ? $dtp->destination3->detail : '' }}" readonly>
                        <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }}">
                        <label>Size</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="size" id="size1" value="20" {{ old('size') == 20 || $dtp->size == 20 ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="size1" style="pointer-events: none; opacity: 0.5;">20"</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="size" id="size2" value="40" {{ old('size') == 40 || $dtp->size == 40 ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="size2" style="pointer-events: none; opacity: 0.5;">40"</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('size') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label>Trip Fee</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $dtp->price }}">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>&nbsp;
                            Save Truck
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
