@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Update Daily Trucking Plan</div>
                    <div class="panel-body">
                        <form action="{{ route('dtp.update', $dtp->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group
                                {{ $errors->has('destination_1_detail') ? 'has-error' : '' }}">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1" value="{{ $dtp->destination_1_id != null ? $dtp->destination1->detail : '' }}">
                                <input type="file" class="form-control" name="destination_1_image" placeholder="Destination 1 Image">
                                <span class="text-danger">{{ $errors->first('destination_1_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('destination_2_detail') ? 'has-error' : '' }}">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2" value="{{ $dtp->destination_2_id != null ? $dtp->destination2->detail : '' }}">
                                <input type="file" class="form-control" name="destination_2_image" placeholder="Destination 2 Image">
                                <span class="text-danger">{{ $errors->first('destination_2_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('destination_3_detail') ? 'has-error' : '' }}">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3" value="{{ $dtp->destination_3_id != null ? $dtp->destination3->detail : '' }}">
                                <input type="file" class="form-control" name="destination_3_image" placeholder="Destination 3 Image">
                                <span class="text-danger">{{ $errors->first('destination_3_detail') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $dtp->price }}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('order_type') ? 'has-error' : '' }}">
                                <label>Order Type</label>
                                <select name="order_type" class="form-control">
                                    <option value="export" {{ $dtp->order_type == 'export' ? 'selected' : '' }}>Export</option>
                                    <option value="import" {{ $dtp->order_type == 'import' ? 'selected' : '' }}>Import</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('order_type') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                <label>Client</label>
                                <select name="client_id" class="form-control">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ $dtp->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('client_id') }}</span>
                            </div>
                            <div class="form-group
                                {{ $errors->has('truck_id') ? 'has-error' : '' }}">
                                <label>Truck</label>
                                <select name="truck_id" class="form-control">
                                    @foreach($trucks as $truck)
                                        <option value="{{ $truck->id }}" {{ $dtp->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->license_plate }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('truck_id') }}</span>
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
