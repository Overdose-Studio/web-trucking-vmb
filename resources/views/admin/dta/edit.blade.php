@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h1 class="panel-heading">Update Daily Trucking Actually</h1>
                    <div class="panel-body">
                        <form action="{{ route('dta.update', $dta->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div
                                class="form-group
                                    {{ $errors->has('daily_trucking_plan_id') ? 'has-error' : '' }}">
                                <label for="daily_trucking_plan_id">Shipment</label>
                                <select name="daily_trucking_plan_id" class="form-control"
                                    onchange="this.options[this.selectedIndex].value && (window.location = '{{ route('dta.edit', $dta->id) }}' + '?DTA=' + this.options[this.selectedIndex].value);">
                                    <option value="" selected disabled>Please Select</option>
                                    @foreach ($dtps as $dtp)
                                        <option value="{{ $dtp->id }}"
                                            @if (request()->DTA == $dtp->id) selected @endif>
                                            {{ $dtp->shipment->id }} - {{ $dtp->client->name }} -
                                            {{ $dtp->truck->license_plate }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail"
                                    placeholder="Destination 1"
                                    value="{{ $dta->destination_1_id != null ? $dta->destination1->detail : '' }}">
                                <input type="file" class="form-control" name="destination_1_image"
                                    placeholder="Destination 1 Image">
                                <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail"
                                    placeholder="Destination 2"
                                    value="{{ $dta->destination_2_id != null ? $dta->destination2->detail : '' }}">
                                <input type="file" class="form-control" name="destination_2_image"
                                    placeholder="Destination 2 Image">
                                <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail"
                                    placeholder="Destination 3"
                                    value="{{ $dta->destination_3_id != null ? $dta->destination3->detail : '' }}">
                                <input type="file" class="form-control" name="destination_3_image"
                                    placeholder="Destination 3 Image">
                                <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Price"
                                    value="{{ $dta->price }}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('renban') ? 'has-error' : '' }}">
                                <label>Renban</label>
                                <input type="text" class="form-control" name="renban" placeholder="Renban"
                                    value="{{ $dta->renban }}">
                                <span class="text-danger">{{ $errors->first('renban') }}</span>
                            </div>
                            <div
                                class="form-group
                                    {{ $errors->has('container_size') ? 'has-error' : '' }}">
                                <label>Container Size</label>
                                <input type="decimal" class="form-control" name="container_size"
                                    placeholder="Container Size" value="{{ $dta->container_size }}">
                                <span class="text-danger">{{ $errors->first('container_size') }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card p-2">
                @if ($selected != null)
                    <h3>{{ $selected != null ? $selected->client->name : '' }}</h3>
                    <h5>License Plate : {{ $selected != null ? $selected->truck->license_plate : '' }}</h5>
                    <p><strong>Shipment ID </strong>: {{ $selected->shipment != null ? $selected->shipment->id : '' }}</p>
                    <p><strong>Status </strong>:{{ $selected->shipment != null ? $selected->shipment->status : '' }}</p>
                    <p><strong>Destination 1
                        </strong>:{{ $selected->destination_1_id != null ? $selected->destination1->detail : '' }} </br>
                        {{ $selected->destination_1_id != null ? $selected->destination1->image : '' }}</p>
                    <p><strong>Destination 2
                        </strong>:{{ $selected->destination_2_id != null ? $selected->destination2->detail : '' }} </br>
                        {{ $selected->destination_2_id != null ? $selected->destination2->image : '' }}</p>
                    <p><strong>Destination 3
                        </strong>:{{ $selected->destination_3_id != null ? $selected->destination3->detail : '' }} </br>
                        {{ $selected->destination_3_id != null ? $selected->destination3->image : '' }}</p>
                    <p><strong>Price </strong>:{{ $selected->price }}</p>
                    <p><strong>Order Type </strong>:{{ $selected->order_type }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
