@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-plus fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Create Driver</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('driver.create') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. John Doe">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" class="form-control" placeholder="e.g. 30">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. 081234567890">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="e.g. 1234567890">
                    </div>
                    <div class="form-group">
                        <label for="sim">SIM</label>
                        <input type="text" name="sim" class="form-control" placeholder="e.g. 1234567890">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;
                            Add New Driver
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
