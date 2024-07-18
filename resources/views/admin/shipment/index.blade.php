@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-boxes fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">Order</h1>
                </div>
                <div>
                    <a href="{{ route('shipment.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Create Order
                    </a>
                </div>
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
                                        @case('Waiting Bill')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-coins"></i>&nbsp;
                                                Waiting Tagihan
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
                                <td>
                                    @if (!$shipment->bill_id)
                                        <a href="{{ route('shipment.edit', $shipment->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>&nbsp;
                                            Edit
                                        </a>
                                        <form action="{{ route('shipment.destroy', $shipment->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>&nbsp;
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        {{-- TODO  --}}
                                        {{-- <a href="{{ route('shipment.show', $shipment->id) }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>&nbsp;
                                            View
                                        </a> --}}
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
                    targets: 6
                }]
            });
        });
    </script>
@endsection
