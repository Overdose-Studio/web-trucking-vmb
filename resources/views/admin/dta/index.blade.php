@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Daily Trucking Actually List</div>
                    <a href="{{ route('dta.create') }}" class="btn btn-success">Create</a>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Shipment ID</th>
                                    <th>Shipment Status</th>
                                    <th>Destination 1</th>
                                    <th>Destination 2</th>
                                    <th>Destination 3</th>
                                    <th>Price</th>
                                    <th>Renban</th>
                                    <th>Container Size</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dtas as $dta)
                                    <tr>
                                        <td>{{ $dta->dailyTruckingPlan->shipment->id }}</td>
                                        <td>{{ $dta->dailyTruckingPlan->shipment->status }}</td>
                                        <td>{{ $dta->destination_1_id != null ? $dta->destination1->detail : '' }} </br> {{ $dta->destination_1_id != null ? $dta->destination1->image : '' }}</td>
                                        <td>{{ $dta->destination_2_id != null ? $dta->destination2->detail : '' }} </br> {{ $dta->destination_2_id != null ? $dta->destination2->image : '' }}</td>
                                        <td>{{ $dta->destination_3_id != null ? $dta->destination3->detail : '' }} </br> {{ $dta->destination_3_id != null ? $dta->destination3->image : '' }}</td>
                                        <td>{{ $dta->price }}</td>
                                        <td>{{ $dta->renban }}</td>
                                        <td>{{ $dta->container_size }}</td>
                                        <td>
                                            <a href="{{ route('dta.edit', $dta->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('dta.destroy', $dta->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
