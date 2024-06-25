@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="panel-heading">Approval - Daily Trucking Plan List </h1>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Order Type</th>
                            <th>Client Name</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->date }}</td>
                                <td>{{ ucfirst($shipment->order_type) }}</td>
                                <td>{{ $shipment->client->name }}</td>
                                <td>Rp {{ number_format($shipment->dailyTruckingPlan->sum('price'), 0, ',', '.') }}</td>
                                <td>
                                    <form id="statusForm-{{ $shipment->id }}"
                                        action="{{ route('approve.update', $shipment->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <select name="status" class="form-control shipmentStatus"
                                            data-shipment-id="{{ $shipment->id }}"
                                            data-previous-value="{{ $shipment->status }}">
                                            <option value="Waiting DTP" @if ($shipment->status == 'Waiting DTP') selected @endif>
                                                Waiting DTP
                                            </option>
                                            <option value="Approving DTP" @if ($shipment->status == 'Approving DTP') selected @endif>
                                                Approving DTP
                                            </option>
                                            <option value="Rejected DTP" @if ($shipment->status == 'Rejected DTP') selected @endif>
                                                Rejected DTP
                                            </option>
                                        </select>
                                    </form>
                                </td>

                                {{-- <td>
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
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.shipmentStatus').on('change', function() {
                var selectedStatus = $(this).val();
                var shipmentId = $(this).data('shipment-id');
                var formId = 'statusForm-' + shipmentId;
                var previousValue = $(this).data('previous-value');

                if (confirm('Are you sure you want to change the shipment status?')) {
                    document.getElementById(formId).submit();
                } else {
                    $(this).val(previousValue);
                }
            });
        });
    </script>
@endsection
