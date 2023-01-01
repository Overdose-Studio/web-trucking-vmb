@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Daily Trucking Plan List</h1>
            <a href="{{ route('dtp.create_shipment') }}" class="btn btn-success mb-2">Create Shipment</a>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Order Type</th>
                            <th>Client Name</th>
                            <th>Bill</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10</td>
                            <td>Import</td>
                            <td>Andi</td>
                            <td>1000000</td>
                            <td>
                                <a href="{{ route('dtp.show') }}" class="btn btn-primary">Show</a>
                                <a href="" class="btn btn-warning">Edit</a>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Export</td>
                            <td>Budi</td>
                            <td>3000000</td>
                            <td>
                                <a href="{{ route('dtp.show') }}" class="btn btn-primary">Show</a>
                                <a href="" class="btn btn-warning">Edit</a>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
