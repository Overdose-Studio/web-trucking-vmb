@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-boxes fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">Shipment</h1>
                </div>
                <div>
                    <a href="{{ route('shipment.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Create Shipment
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="shipment-table">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Client Name</th>
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
                                <td>{{ $shipment->client->name }}</td>
                                <td>
                                    @if ($shipment->bill_id)
                                        <span class="badge badge-success">Billed</span>
                                    @else
                                        <span class="badge badge-warning">Running</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dtp.show', $shipment->id) }}" class="btn btn-primary">Show</a>
                                    @if (!$shipment->bill_id)
                                        <a href="{{ route('dtp.edit_shipment', $shipment->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('dtp.destroy_shipment', $shipment->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
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
            $('#shipment-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 5
                }]
            });
        });
    </script>
@endsection
