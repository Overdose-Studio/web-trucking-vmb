@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Update Daily Trucking Actually</div>
                    <div class="panel-body">
                        <form action="{{ route('dta.update', $dta->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group
                                {{ $errors->has('daily_trucking_plan_id') ? 'has-error' : '' }}">
                                <label for="daily_trucking_plan_id">Shipment</label>
                                <select name="daily_trucking_plan_id" class="form-control">
                                    @foreach($dtps as $dtp)
                                        <option value="{{ $dtp->id }}" {{ $dta->id == $dtp->id ? 'selected' : '' }}>{{ $dtp->shipment->id }} - {{ $dtp->client->name }} - {{ $dtp->truck->license_plate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group
                                {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1" value="{{ $dta->destination_1_id != null ? $dta->destination1->detail : '' }}">
                                <input type="file" class="form-control" name="destination_1_image" placeholder="Destination 1 Image">
                                <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2" value="{{ $dta->destination_2_id != null ? $dta->destination2->detail : '' }}">
                                <input type="file" class="form-control" name="destination_2_image" placeholder="Destination 2 Image">
                                <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3" value="{{ $dta->destination_3_id != null ? $dta->destination3->detail : '' }}">
                                <input type="file" class="form-control" name="destination_3_image" placeholder="Destination 3 Image">
                                <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $dta->price }}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('renban') ? 'has-error' : '' }}">
                                <label>Renban</label>
                                <input type="text" class="form-control" name="renban" placeholder="Renban" value="{{ $dta->renban }}">
                                <span class="text-danger">{{ $errors->first('renban') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('container_size') ? 'has-error' : '' }}">
                                <label>Container Size</label>
                                <input type="decimal" class="form-control" name="container_size" placeholder="Container Size" value="{{ $dta->container_size }}">
                                <span class="text-danger">{{ $errors->first('container_size') }}</span>
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
