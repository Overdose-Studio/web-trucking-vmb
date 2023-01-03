@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('client.index') }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Back to Client List</a>
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
