@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-cogs fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Log Order</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="log-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Client</th>
                            <th>Type</th>
                            <th>Order</th>
                            <th>Set DTP</th>
                            <th>Approved DTP</th>
                            <th>Set DTA</th>
                            <th>Approved DTA</th>
                            <th>Create Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shipment->client->name }}</td>
                                <td>
                                    @if ($shipment->order_type === 'import')
                                        <span class="badge badge-primary">Import</span>
                                    @else
                                        <span class="badge badge-secondary">Export</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'create_shipment')->first())
                                        {{ $shipment->logs->where('action', 'create_shipment')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'set_dtp')->first())
                                        {{ $shipment->logs->where('action', 'set_dtp')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'approve_dtp')->first())
                                        {{ $shipment->logs->where('action', 'approve_dtp')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'set_dta')->first())
                                        {{ $shipment->logs->where('action', 'set_dta')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'approve_dta')->first())
                                        {{ $shipment->logs->where('action', 'approve_dta')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($shipment->logs->where('action', 'create_bill')->first())
                                        {{ $shipment->logs->where('action', 'create_bill')->first()->date }}
                                    @else
                                        <span class="badge badge-danger">Not Set</span>
                                    @endif
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
            $('#log-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [3, 4, 5, 6, 7, 8]
                }]
            });
        });
    </script>
@endsection
