@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-list fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">CRUD DTP</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="shipment-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Party</th>
                            <th>Client Name</th>
                            <th>Status</th>
                            <th>Trip Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->date }}</td>
                                <td>{{ ucfirst($shipment->order_type) }}</td>
                                <td>{{ $shipment->party }}</td>
                                <td>{{ $shipment->client->name }}</td>
                                <td>
                                    @switch($shipment->status)
                                        @case('Waiting DTP')
                                            <span class="badge badge-success">
                                                <i class="fas fa-pencil"></i>&nbsp;
                                                Open
                                            </span>
                                        @break

                                        @case('Approving DTP')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-spinner"></i>&nbsp;
                                                Waiting Approval
                                            </span>
                                        @break

                                        @default
                                            <span class="badge badge-danger">
                                                <i class="fas fa-ban"></i>&nbsp;
                                                {{ $shipment->status }}
                                            </span>
                                        @break
                                    @endswitch
                                </td>
                                <td>Rp {{ number_format($shipment->dailyTruckingPlan->sum('price'), 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>&nbsp;
                                        Detail
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
            $('#shipment-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 7
                }]
            });
        });
    </script>
@endsection
