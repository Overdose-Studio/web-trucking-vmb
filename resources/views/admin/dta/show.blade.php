@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Truck list for {{ $shipment->client->name }} | {{ $shipment->date }}</h1>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Truck</th>
                            <th>Driver Name</th>
                            <th>Destination 1</th>
                            <th>Destination 2</th>
                            <th>Destination 3</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dtas as $dta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($dta->truck_id)
                                    <td>{{ $dta->truck->license_plate }} | {{ $dta->truck->brand }}</td>
                                @else
                                    <td>Vendor Truck</td>
                                @endif
                                <td>{{ $dta->driver_name }}</td>
                                <td>{{ $dta->destination1 }}</td>
                                <td>{{ $dta->destination2 }}</td>
                                <td>{{ $dta->destination3 }}</td>
                                <td>{{ $dta->size }}</td>
                                <td>Rp {{ number_format($dta->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dta.edit', [$shipment->id, $dta->id]) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
