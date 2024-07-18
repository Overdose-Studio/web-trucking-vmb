@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-coins fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">Bill List</h1>
                </div>
                <div>
                    <a href="{{ route('bill.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Create Invoice
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="bill-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Order Type</th>
                            <th>(DTP) Price</th>
                            <th>(DTA) Price</th>
                            <th>DTP - DTA</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
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
                                <td>
                                    @switch($shipment->status)
                                        @case('Waiting Bill')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-coins"></i>&nbsp;
                                                Waiting Bill
                                            </span>
                                        @break

                                        @case('Completed')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-check"></i>&nbsp;
                                                Completed
                                            </span>
                                        @break

                                        @default
                                            <span class="badge badge-warning">
                                                <i class="fas fa-spinner"></i>&nbsp;
                                                {{ $shipment->status }}
                                            </span>
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ ucfirst($shipment->order_type) }}</td>
                                <td>Rp {{ number_format($shipment->dailyTruckingPlan->sum('price'), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($shipment->diff, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('bill.dta.detail', $shipment->id) }}" class="btn btn-primary">DTA</a>
                                    <a href="{{ route('bill.dtp.detail', $shipment->id) }}" class="btn btn-secondary">DTP</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($bills as $bill)
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file fa-2x"></i>&nbsp;&nbsp;&nbsp;
                        <h1 class="panel-heading mb-0">Bill: {{ $bill->number }}</h1>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('bill.download', $bill->id) }}" class="btn btn-success mb-2 mr-1">
                            <i class="fas fa-download"></i>&nbsp;
                            Download
                        </a>
                        <a href="{{ route('bill.edit', $bill->id) }}" class="btn btn-warning mb-2 mr-1">
                            <i class="fas fa-edit"></i>&nbsp;
                            Edit
                        </a>
                        <form action="{{ route('bill.destroy', $bill->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>&nbsp;
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="panel-body">
                    <table class="table table-bordered" id="bill-{{ $bill->id }}-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Order Type</th>
                                <th>(DTP) Price</th>
                                <th>(DTA) Price</th>
                                <th>DTP - DTA</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bill->shipments as $shipment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shipment->id }}</td>
                                    <td>{{ $shipment->date }}</td>
                                    <td>{{ $shipment->client->name }}</td>
                                    <td>{{ ucfirst($shipment->order_type) }}</td>
                                    <td>Rp {{ number_format($shipment->dailyTruckingPlan->sum('price'), 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($shipment->dailyTruckingActually->sum('price'), 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($shipment->diff, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('bill.dta.detail', $shipment->id) }}" class="btn btn-primary">DTA</a>
                                        <a href="{{ route('bill.dtp.detail', $shipment->id) }}" class="btn btn-secondary">DTP</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Datable `bill-table`
            $('#bill-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 10
                }]
            });

            // Datatable each bill id
            const billsId = @json($bills->pluck('id'));
            billsId.forEach(element => {
                $(`#bill-${element}-table`).DataTable({
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
        });
    </script>
@endsection
