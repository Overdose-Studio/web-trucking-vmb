@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dta.index') }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Back to DTP List</a>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 mt-1">Truck list for {{ $shipment->client->name }}</h5>
            <h1>{{ $shipment->date }}</h1>
        </div>
        <div class="card-body">
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
                            <th>(DTP) Price</th>
                            <th>(DTA) Price</th>
                            <th>DTP - DTA</th>
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
                                <td>
                                    @if ($dta->destination1->image)
                                        <a class="border p-1 mb-1"
                                            href="{{ route('dta.download', ['file' => $dta->destination1->image]) }}">Download</a>
                                        <br>
                                    @endif
                                    {{ $dta->destination1->detail }}
                                </td>
                                <td>
                                    @if ($dta->destination2->image)
                                        <a class="border p-1 mb-1"
                                            href="{{ route('dta.download', ['file' => $dta->destination2->image]) }}">Download</a>
                                        <br>
                                    @endif
                                    {{ $dta->destination2->detail }}
                                </td>
                                <td>
                                    @if ($dta->destination3->image)
                                        <a class="border p-1 mb-1"
                                            href="{{ route('dta.download', ['file' => $dta->destination3->image]) }}">Download</a>
                                        <br>
                                    @endif
                                    {{ $dta->destination3->detail }}
                                </td>
                                <td>{{ $dta->size }}</td>
                                <td>Rp {{ number_format($dta->dailyTruckingPlan->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($dta->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($dta->diff, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dta.edit', [$shipment->id, $dta->id]) }}"
                                        class="btn btn-warning">Edit</a>
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
