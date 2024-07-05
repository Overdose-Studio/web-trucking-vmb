@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-screwdriver-wrench fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">Driver</h1>
                </div>
                <div>
                    <a href="{{ route('shipment.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Add New Driver
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="driver-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>NIK</th>
                            <th>SIM</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($driver->name) }}</td>
                                <td>{{ $driver->age }}</td>
                                <td>{{ $driver->phone }}</td>
                                <td>{{ $driver->nik }}</td>
                                <td>{{ $driver->sim }}</td>
                                <td>{{ $driver->address }}</td>
                                <td>
                                    <span>-</span>
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
            $('#driver-table').DataTable({
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
