@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-truck-loading fa-3x mr-4"></i>
                    <div class="d-flex flex-column">
                        <h5 class="mb-0 mt-1">Truck list for {{ $shipment->client->name }}</h5>
                        <h1>{{ $shipment->date }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="dtp-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Truck</th>
                            {{-- <th>Driver Name</th> --}}
                            <th>Destination 1</th>
                            <th>Destination 2</th>
                            <th>Destination 3</th>
                            <th>Size</th>
                            <th>Trip Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtps as $dtp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($dtp->truck_id)
                                    <td>{{ $dtp->truck->license_plate }} | {{ $dtp->truck->brand }}</td>
                                @else
                                    <td>Vendor Truck</td>
                                @endif
                                {{-- <td>{{ $dtp->driver_name }}</td> --}}
                                <td>{{ $dtp->destination1 ? $dtp->destination1->detail : '-' }}</td>
                                <td>{{ $dtp->destination2 ? $dtp->destination2->detail : '-' }}</td>
                                <td>{{ $dtp->destination3 ? $dtp->destination3->detail : '-' }}</td>
                                <td>{{ $dtp->size }}</td>
                                <td>Rp {{ number_format($dtp->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#dtp-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
            });
        });
    </script>
@endsection
