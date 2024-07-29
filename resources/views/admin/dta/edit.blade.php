@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-2x mr-3"></i>
                        <h1 class="panel-heading mb-0">Set Daily Trucking Actually</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form action="{{ route('dta.update', [$shipment->id, $dta->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- <div class="form-group {{ $errors->has('driver_name') ? 'has-error' : '' }}">
                                <label for="driver_name">Driver Name</label>
                                <input type="text" class="form-control" name="driver_name" placeholder="Driver Name" value="{{ $dta->driver_name }}" readonly>
                                <span class="text-danger">{{ $errors->first('driver_name') }}</span>
                            </div> --}}
                            <div class="form-group {{ $errors->has('truck_id') ? 'has-error' : '' }}">
                                <label>Truck</label>
                                <select name="truck_id" class="form-control" readonly style="pointer-events: none;">
                                    <option value="" @if ($dta->truck_id == null) selected @endif>Vendor Truck
                                    </option>
                                    @foreach ($trucks as $truck)
                                        <option value="{{ $truck->id }}"
                                            {{ $dta->truck_id == $truck->id ? 'selected' : '' }}>
                                            {{ $truck->license_plate }} | {{ $truck->brand }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('truck_id') }}</span>
                            </div>
                            <hr>
                            <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }}">
                                <label>Size</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="size1" value="20" {{ old('size') == 20 || $dta->size == 20 ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="size1" style="pointer-events: none; opacity: 0.5;">20"</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="size2" value="40" {{ old('size') == 40 || $dta->size == 40 ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="size2" style="pointer-events: none; opacity: 0.5;">40"</label>
                                </div>
                                <span class="text-danger">{{ $errors->first('size') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Trip Fee</label>
                                <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $dta->price }}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <hr>
                            <div class="form-group {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1"value="{{ $dta->destination_1_id ? $dta->destination1->detail : '' }}" readonly>
                                <input type="file" class="form-control-file mt-1" name="destination_1_image" placeholder="Destination 1 Image">
                                <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2" value="{{ $dta->destination_2_id ? $dta->destination2->detail : '' }}" readonly>
                                <input type="file" class="form-control-file mt-1" name="destination_2_image" placeholder="Destination 2 Image">
                                <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3" value="{{ $dta->destination_3_id ? $dta->destination3->detail : '' }}">
                                <input type="file" class="form-control-file mt-1" name="destination_3_image" placeholder="Destination 3 Image">
                                <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                            </div>
                            <hr>
                            <div class="form-group d-flex justify-content-end mb-0">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>&nbsp;
                                    Save DTA
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file fa-2x mr-3"></i>
                        <h1 class="panel-heading mb-0">Daily Trucking Plan</h1>
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-truck fa-xl mr-2"></i>
                        <h3 class="mb-0">Truck</h3>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="card-text mb-0"><strong>Vehicle:</strong>{{ $selected->truck_id ? $selected->truck->license_plate : 'Vendor Truck' }}</p>
                        {{-- <p class="card-text mb-0"><strong>Driver Name:</strong>{{ $selected->driver_name }}</p> --}}
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-box-open fa-xl mr-2"></i>
                        <h3 class="mb-0">Delivery</h3>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="card-text mb-0"><strong>Size:</strong> {{ $selected->size }}</p>
                        <p class="card-text mb-0"><strong>Price:</strong> Rp
                            {{ number_format($selected->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map fa-xl mr-2"></i>
                        <h3 class="mb-0">Route</h3>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <p class="mb-1"><strong>Destination 1:</strong>
                            {{ $selected->destination_1_id ? $selected->destination1->detail : '' }}</p>
                        @if ($selected->destination_2_id && $selected->destination1->image)
                            <img src="{{ $selected->destination1->image }}" alt="Destination 1 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <p class="mb-1"><strong>Destination 2:</strong>
                            {{ $selected->destination_2_id ? $selected->destination2->detail : '' }}</p>
                        @if ($selected->destination_2_id && $selected->destination2->image)
                            <img src="{{ $selected->destination2->image }}" alt="Destination 2 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-1"><strong>Destination 3:</strong>
                            {{ $selected->destination_3_id ? $selected->destination3->detail : '' }}</p>
                        @if ($selected->destination_3_id && $selected->destination3->image)
                            <img src="{{ $selected->destination3->image }}" alt="Destination 3 Image" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
