@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Daily Trucking Plan List</h1>
            <a href="{{ route('dtp.create') }}" class="btn btn-success mb-2">Create</a>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Shipment Status</th>
                            <th>Destination 1</th>
                            <th>Destination 2</th>
                            <th>Destination 3</th>
                            <th>Price</th>
                            <th>Order Type</th>
                            <th>Client</th>
                            <th>Truck</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtps as $dtp)
                            <tr>
                                <td>{{ $dtp->shipment->id }}</td>
                                <td>{{ $dtp->shipment->status }}</td>
                                <td>{{ $dtp->destination_1_id != null ? $dtp->destination1->detail : '' }} </br>
                                    {{ $dtp->destination_1_id != null ? $dtp->destination1->image : '' }}</td>
                                <td>{{ $dtp->destination_2_id != null ? $dtp->destination2->detail : '' }} </br>
                                    {{ $dtp->destination_2_id != null ? $dtp->destination2->image : '' }}</td>
                                <td>{{ $dtp->destination_3_id != null ? $dtp->destination3->detail : '' }} </br>
                                    {{ $dtp->destination_3_id != null ? $dtp->destination3->image : '' }}</td>
                                <td>{{ $dtp->price }}</td>
                                <td>{{ $dtp->order_type }}</td>
                                <td>{{ $dtp->client->name }}</td>
                                <td>{{ $dtp->truck->license_plate }}</td>
                                <td>
                                    <a href="{{ route('dtp.edit', $dtp->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('dtp.destroy', $dtp->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
