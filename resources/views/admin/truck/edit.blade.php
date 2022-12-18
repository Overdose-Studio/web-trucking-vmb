@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content pt-2">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Edit Truck</div>
                    <div class="panel-body">
                        <form action="{{ route('truck.update', $truck->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div
                                class="form-group
                                @if ($errors->has('license_plate')) has-error @endif
                            ">
                                <label for="license_plate">License Plate</label>
                                <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ $truck->license_plate }}">
                                @if ($errors->has('license_plate'))
                                    <span class="help-block
                                        @if ($errors->has('license_plate')) text-danger @endif
                                    ">
                                        {{ $errors->first('license_plate') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('brand')) has-error @endif
                            ">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control" value="{{ $truck->brand }}">
                                @if ($errors->has('brand'))
                                    <span class="help-block
                                        @if ($errors->has('brand')) text-danger @endif
                                    ">
                                        {{ $errors->first('brand') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('production_year')) has-error @endif
                            ">
                                <label for="production_year">Production Year</label>
                                <input type="number" name="production_year" id="production_year" class="form-control" value="{{ $truck->production_year }}">
                                @if ($errors->has('production_year'))
                                    <span class="help-block
                                        @if ($errors->has('production_year')) text-danger @endif
                                    ">
                                        {{ $errors->first('production_year') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('last_maintenance')) has-error @endif
                            ">
                                <label for="last_maintenance">Last Maintenance</label>
                                <input type="date" name="last_maintenance" id="last_maintenance" class="form-control" value="{{ $truck->last_maintenance }}">
                                @if ($errors->has('last_maintenance'))
                                    <span class="help-block
                                        @if ($errors->has('last_maintenance')) text-danger @endif
                                    ">
                                        {{ $errors->first('last_maintenance') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('state_type')) has-error @endif
                            ">
                                <label for="state_type">State Type</label>
                                <select name="state_type" id="state_type" class="form-control">
                                    <option value="good" @if ($truck->state->type == 'good') selected @endif>Good</option>
                                    <option value="bad" @if ($truck->state->type == 'bad') selected @endif>Bad</option>
                                </select>
                                @if ($errors->has('state_type'))
                                    <span class="help-block
                                        @if ($errors->has('state_type')) text-danger @endif
                                    ">
                                        {{ $errors->first('state_type') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('state_evidence')) has-error @endif
                            ">
                                <label for="state_evidence">State Evidence</label>
                                <img src="{{ asset($truck->state->evidence) }}" alt="State Evidence" class="img-thumbnail mb-2">
                                <input type="file" name="state_evidence" id="state_evidence" class="form-control" value="{{ $truck->state_evidence }}">
                                @if ($errors->has('state_evidence'))
                                    <span class="help-block
                                        @if ($errors->has('state_evidence')) text-danger @endif
                                    ">
                                        {{ $errors->first('state_evidence') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
