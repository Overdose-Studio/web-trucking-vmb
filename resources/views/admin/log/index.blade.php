@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-cogs fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <h1 class="panel-heading">Log Shipment</h1>
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
                            <th>Shipment</th>
                            <th>Set DTP</th>
                            <th>Approved DTP</th>
                            <th>Set DTA</th>
                            <th>Approved DTA</th>
                            <th>Create Bill</th>
                        </tr>
                    </thead>
                    <tbody>
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
                // order: [
                //     [0, 'asc']
                // ],
                // columnDefs: [{
                //     orderable: false,
                //     targets: 5
                // }]
            });
        });
    </script>
@endsection
