@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Daily Trucking Plan List</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('dtp.create_shipment') }}" class="btn btn-success mb-2">Create Shipment</a>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Client Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->date }}</td>
                                <td>{{ ucfirst($shipment->order_type) }}</td>
                                <td>{{ $shipment->client->name }}</td>
                                <td>
                                    <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-primary">Show</a>
                                    @if (!$shipment->bill_id)
                                        <a href="{{ route('dtp.edit_shipment', $shipment->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('dtp.destroy_shipment', $shipment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
