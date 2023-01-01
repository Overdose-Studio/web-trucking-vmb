@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Bill List</h1>
            <a href="{{ route('bill.create') }}" class="btn btn-primary mb-2">Create Invoice</a>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Deadline</th>
                            <th>Order Type</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->date }}</td>
                                <td>{{ $shipment->client->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $shipment->deadline_status }}" style="font-size: 1rem">
                                        H{{ $shipment->deadline > 0 ? "+" : "" }}{{ $shipment->deadline }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($shipment->order_type) }}</td>
                                <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dta.show', $shipment->id) }}" class="btn btn-primary">DTA</a>
                                    <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-warning">DTP</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($bills as $bill)
        <div class="card">
            <div class="card-body">
                <h1 class="panel-heading">Bill: {{ $bill->number }}</h1>
                <a href="#" class="btn btn-success mb-2 mr-1">Download Invoice</a>
                <a href="{{ route('bill.edit', $bill->id) }}" class="btn btn-warning mb-2 mr-1">Edit</a>
                <form action="{{ route('bill.destroy', $bill->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Shipment ID</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Order Type</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bill->shipments as $shipment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shipment->id }}</td>
                                    <td>{{ $shipment->date }}</td>
                                    <td>{{ $shipment->client->name }}</td>
                                    <td>{{ ucfirst($shipment->order_type) }}</td>
                                    <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('dta.show', $shipment->id) }}" class="btn btn-primary">DTA</a>
                                        <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-warning">DTP</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection
