@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-person fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">Client</h1>
                </div>
                <div>
                    <a href="{{ route('client.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Add New Client
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" id="client-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->created_at->format('l, d F Y - H:i:s') }}</td>
                                <td class="d-flex" style="gap: 4px">
                                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('client.delete', $client->id) }}" method="POST">
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#client-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 3
                }]
            });
        });
    </script>
@endsection
