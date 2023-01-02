@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Truck list for {{ $shipment->client->name }} | {{ $shipment->date }}</h1>
            <a href="{{ route('dtp.create', $shipment->id) }}" class="btn btn-success mb-2">Add Truck</a>
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
                        @forelse ($dtps as $dtp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($dtp->truck_id)
                                    <td>{{ $dtp->truck->license_plate }} | {{ $dtp->truck->brand }}</td>
                                @else
                                    <td>Vendor Truck</td>
                                @endif
                                <td>{{ $dtp->driver_name }}</td>
                                <td>{{ $dtp->destination1 }}</td>
                                <td>{{ $dtp->destination2 }}</td>
                                <td>{{ $dtp->destination3 }}</td>
                                <td>{{ $dtp->size }}</td>
                                <td>Rp {{ number_format($dtp->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dtp.edit', [$shipment->id, $dtp->id]) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('dtp.destroy', [$shipment->id, $dtp->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
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
