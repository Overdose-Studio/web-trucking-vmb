@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-plus fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Create Truck</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('truck.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="license_plate">License Plate</label>
                        <input type="text" name="license_plate" id="license_plate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="production_year">Production Year</label>
                        <input type="number" name="production_year" id="production_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_maintenance">Last Maintenance</label>
                        <input type="date" name="last_maintenance" id="last_maintenance" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="state_type">State Type</label>
                        <select name="state_type" id="state_type" class="form-control">
                            <option value="good">Good</option>
                            <option value="bad">Bad</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="state_evidence">State Evidence</label>
                        <input type="file" accept="image/*" name="state_evidence" id="state_evidence"
                            class="form-control">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;
                            Create New Truck
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
