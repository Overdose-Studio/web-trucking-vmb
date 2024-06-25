@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-list fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Approval Daily Trucking Actually List</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="dta-table">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Party</th>
                            <th>Client Name</th>
                            <th>Total Price</th>
                            <th>DTP - DTA</th>
                            <th>Status</th>
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
                                <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($shipment->diff, 0, ',', '.') }}</td>
                                <td>
                                    @switch($shipment->status)
                                        @case("Waiting DTP")
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-spinner"></i>&nbsp;
                                                Waiting DTP
                                            </span>
                                            @break

                                        @case("Approving DTP")
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-spinner"></i>&nbsp;
                                                Approving DTP
                                            </span>
                                            @break

                                        @case("Waiting DTA")
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-pencil"></i>&nbsp;
                                                Waiting DTA
                                            </span>
                                            @break

                                        @case("Approving DTA")
                                            <span class="badge badge-warning">
                                                <i class="fas fa-spinner"></i>&nbsp;
                                                Waiting Approval
                                            </span>
                                            @break

                                        @case("Waiting Bill")
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i>&nbsp;
                                                Approved
                                            </span>
                                        @break

                                        @default
                                            <span class="badge badge-danger">
                                                <i class="fas fa-ban"></i>&nbsp;
                                                Closed
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('dta.approval.show', $shipment->id) }}" class="btn btn-primary">Show</a>
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
                    targets: 8
                }]
            });
        });
    </script>
@endsection
