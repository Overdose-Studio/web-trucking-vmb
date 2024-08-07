@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-circle-info fa-2x mr-3"></i>
                        <h1 class="panel-heading mb-0">Daily Trucking Actually</h1>
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-truck fa-xl mr-2"></i>
                        <h3 class="mb-0">Truck</h3>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="card-text mb-0"><strong>Vehicle:</strong>{{ $dta->truck_id ? $dta->truck->license_plate : 'Vendor Truck' }}</p>
                        {{-- <p class="card-text mb-0"><strong>Driver Name:</strong>{{ $dta->driver_name }}</p> --}}
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-box-open fa-xl mr-2"></i>
                        <h3 class="mb-0">Delivery</h3>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="card-text mb-0"><strong>Size:</strong> {{ $dta->size }}</p>
                        <p class="card-text mb-0"><strong>Price:</strong> Rp {{ number_format($dta->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="card-header">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map fa-xl mr-2"></i>
                        <h3 class="mb-0">Route</h3>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <p class="mb-1"><strong>Destination 1:</strong>
                            {{ $dta->destination_1_id != null ? $dta->destination1->detail : '' }}</p>
                        @if ($dta->destination1 && $dta->destination1->image)
                            <img src="{{ asset($dta->destination_1_id != null ? $dta->destination1->image : '') }}"
                                alt="Destination 1 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <p class="mb-1"><strong>Destination 2:</strong>
                            {{ $dta->destination_2_id != null ? $dta->destination2->detail : '' }}</p>
                        @if ($dta->destination2 && $dta->destination2->image)
                            <img src="{{ asset($dta->destination_2_id != null ? $dta->destination2->image : '') }}"
                                alt="Destination 2 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-1"><strong>Destination 3:</strong>
                            {{ $dta->destination_3_id != null ? $dta->destination3->detail : '' }}</p>
                        @if ($dta->destination3 && $dta->destination3->image)
                            <img src="{{ asset($dta->destination_3_id != null ? $dta->destination3->image : '') }}"
                                alt="Destination 3 Image" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card bg-secondary">
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
                            {{ $selected->destination_1_id != null ? $selected->destination1->detail : '' }}</p>
                        @if ($dta->destination1 && $selected->destination1->image)
                            <img src="{{ $selected->destination_1_id != null ? $selected->destination1->image : '' }}"
                                alt="Destination 1 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <p class="mb-1"><strong>Destination 2:</strong>
                            {{ $selected->destination_2_id != null ? $selected->destination2->detail : '' }}</p>
                        @if ($dta->destination2 && $selected->destination2->image)
                            <img src="{{ $selected->destination_2_id != null ? $selected->destination2->image : '' }}"
                                alt="Destination 2 Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-1"><strong>Destination 3:</strong>
                            {{ $selected->destination_3_id != null ? $selected->destination3->detail : '' }}</p>
                        @if ($dta->destination3 && $selected->destination3->image)
                            <img src="{{ $selected->destination_3_id != null ? $selected->destination3->image : '' }}"
                                alt="Destination 3 Image" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
