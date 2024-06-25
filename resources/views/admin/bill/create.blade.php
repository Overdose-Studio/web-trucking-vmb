@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-plus fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading mb-0">Create Invoice</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" name="number" id="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="person_in_charge">Person in Charge (PIC)</label>
                        <input type="text" name="person_in_charge" id="person_in_charge" class="form-control">
                    </div>
                    <div class="form-group form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;
                            Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
