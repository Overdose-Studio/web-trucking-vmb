@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-edit fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading mb-0">Edit Invoice</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('bill.update', $bill->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                        <label for="number">Number</label>
                        <input type="text" class="form-control" name="number" value="{{ $bill->number }}">
                        <span class="text-danger">{{ $errors->first('number') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $bill->name }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $bill->address }}</textarea>
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('person_in_charge') ? 'has-error' : '' }}">
                        <label for="person_in_charge">Person in Charge (PIC)</label>
                        <input type="text" class="form-control" name="person_in_charge" value="{{ $bill->person_in_charge }}">
                        <span class="text-danger">{{ $errors->first('person_in_charge') }}</span>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>&nbsp;
                            Save Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
