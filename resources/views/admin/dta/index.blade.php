@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Daily Trucking Actually List</h1>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Client Name</th>
                            <th>Total Price</th>
                            <th>DTP - DTA</th>
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
                                <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($shipment->diff, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dta.show', $shipment->id) }}" class="btn btn-primary">Show</a>
                                    @if (!$shipment->bill_id)
                                        <a href="{{ route('dta.edit_shipment', $shipment->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('dtp.destroy_shipment', $shipment->id) }}" method="POST"
                                            class="d-inline">
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
