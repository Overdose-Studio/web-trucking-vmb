@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Create Daily Trucking Actually</div>
                    <div class="panel-body">
                        <form action="{{ route('dta.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="daily_trucking_plan_id">Shipment</label>
                                <select name="daily_trucking_plan_id" class="form-control">
                                    @foreach($dtps as $dtp)
                                        <option value="{{ $dtp->id }}">{{ $dtp->shipment->id }} - {{ $dtp->client->name }} - {{ $dtp->truck->license_plate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Destination 1</label>
                                <input type="text" class="form-control" name="destination_1_detail" placeholder="Destination 1">
                                <input type="file" class="form-control" name="destination_1_image" placeholder="Destination 1 Image">
                            </div>
                            <div class="form-group">
                                <label>Destination 2</label>
                                <input type="text" class="form-control" name="destination_2_detail" placeholder="Destination 2">
                                <input type="file" class="form-control" name="destination_2_image" placeholder="Destination 2 Image">
                            </div>
                            <div class="form-group">
                                <label>Destination 3</label>
                                <input type="text" class="form-control" name="destination_3_detail" placeholder="Destination 3">
                                <input type="file" class="form-control" name="destination_3_image" placeholder="Destination 3 Image">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="renban">Renban</label>
                                <input type="text" class="form-control" name="renban" placeholder="Renban">
                            </div>
                            <div class="form-group">
                                <label for="container_size">Container Size</label>
                                <input type="decimal" class="form-control" name="container_size" placeholder="Container Size">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
