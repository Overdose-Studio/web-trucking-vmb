@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Create Client</h1>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <form action="{{ route('client.store') }}" method="POST">
                    @csrf
                    <div class="form-group
                        @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span
                                class="help-block
                                @if ($errors->has('name')) has-error @endif">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;
                            Add New Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
