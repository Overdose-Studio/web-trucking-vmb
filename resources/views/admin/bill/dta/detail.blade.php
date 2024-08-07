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
                <table class="table table-bordered" id="dta-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Truck</th>
                            {{-- <th>Driver Name</th> --}}
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
                        @foreach ($dtas as $dta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($dta->truck_id)
                                        <span>{{ $dta->truck->license_plate }} | {{ $dta->truck->brand }}</span>
                                    @else
                                        <span>Vendor Truck</span>
                                    @endif
                                </td>
                                {{-- <td>{{ $dta->driver_name }}</td> --}}
                                <td>
                                    @if ($dta->destination1)
                                        @if ($dta->destination1->image)
                                            <a class="border p-1 mb-1"
                                                href="{{ route('dta.download', ['file' => $dta->destination1->image]) }}">Download</a>
                                            <br>
                                        @endif
                                        {{ $dta->destination1->detail }}
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($dta->destination2)
                                        @if ($dta->destination2->image)
                                            <a class="border p-1 mb-1"
                                                href="{{ route('dta.download', ['file' => $dta->destination2->image]) }}">Download</a>
                                            <br>
                                        @endif
                                        {{ $dta->destination2->detail }}
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($dta->destination3)
                                        @if ($dta->destination3->image)
                                            <a class="border p-1 mb-1"
                                                href="{{ route('dta.download', ['file' => $dta->destination3->image]) }}">Download</a>
                                            <br>
                                        @endif
                                        {{ $dta->destination3->detail }}
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ $dta->size }}</td>
                                <td>Rp {{ number_format($dta->dailyTruckingPlan->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($dta->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($dta->diff, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('bill.dta.truck', [$shipment->id, $dta->id]) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-eye"></i>&nbsp;
                                        Check DTA
                                    </a>
                                </td>
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
            $('#dta-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    // targets: 10
                    targets: 9
                }]
            });
        });
    </script>
@endsection
