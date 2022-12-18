@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Bill List</h1>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Shipment Status</th>
                            <th>Client</th>
                            <th>Destination 1</th>
                            <th>Destination 2</th>
                            <th>Destination 3</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->status }}</td>
                                <td>{{ $shipment->dailyTruckingPlan->client->name }}</td>
                                <td>{{ $shipment->dailyTruckingPlan->destination1 }}</td>
                                <td>{{ $shipment->dailyTruckingPlan->destination2 }}</td>
                                <td>{{ $shipment->dailyTruckingPlan->destination3 }}</td>
                                <td>{{ $shipment->dailyTruckingPlan->price }}</td>
                                <td>
                                    <a href="{{ route('bill.create', $shipment->id) }}" class="btn btn-primary">Create Invoice</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
