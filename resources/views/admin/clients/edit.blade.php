@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Edit Client</h1>
        </div>
        <div class="card-body">
            <div
                class="panel-body @if ($errors->any()) has-error @endif ">
                <form action="{{ route('client.update', $client->id) }}" method="POST">
                    @csrf
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}">
                        @if ($errors->has('name'))
                            <span class="help-block @if ($errors->has('name')) has-error @endif">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>&nbsp;
                            Save Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
