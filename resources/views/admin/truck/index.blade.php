@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-truck fa-2x"></i>&nbsp;&nbsp;&nbsp;
                    <h1 class="panel-heading">CRUD Truck</h1>
                </div>
                <div>
                    <a href="{{ route('truck.create') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i>&nbsp;
                        Add New Truck
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered" id="truck-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>License Plate</th>
                            <th>Brand</th>
                            <th>Production Year</th>
                            <th>Last Maintenance</th>
                            <th>State Type</th>
                            <th>State Evidence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trucks as $truck)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $truck->license_plate }}</td>
                                <td>{{ $truck->brand }}</td>
                                <td>{{ $truck->production_year }}</td>
                                <td>{{ $truck->last_maintenance_date }}</td>
                                <td>
                                    @if ($truck->state->type == 'good')
                                        <span class="badge badge-success">{{ ucfirst($truck->state->type) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($truck->state->type) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($truck->state->evidence == null)
                                        <span class="badge">No evidence</span>
                                    @else
                                        <a href="#" onclick="show('{{ $loop->index }}')">
                                            <img id="show-{{ $loop->index }}" src="{{ asset($truck->state->evidence) }}"
                                                class="d-none">
                                            Click to Show
                                        </a>
                                        <img alt="">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('truck.edit', $truck->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>&nbsp;
                                        Edit
                                    </a>
                                    <form action="{{ route('truck.destroy', $truck->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>&nbsp;
                                            Delete
                                        </button>
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

@section('modal')
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog container p-4">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" id="imagepreview" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function show(loop) {
            var img = document.getElementById("imageresource");
            var modalImg = document.getElementById("imagepreview");
            // var modal = document.getElementById("imagemodal");
            $('#imagemodal').modal('show')
            modalImg.src = $('#show-' + loop).attr('src');
            console.log(loop)
            console.log($('#show-' + loop).attr('src'))
            $('#imagepreview').attr('src', $('#show-' + loop).attr('src'));
        }
        // $("#pop").on("click", function() {
        //     $('#imagepreview').attr('src', $('#imageresource').attr(
        //         'src')); // here asign the image to the modal when the user click the enlarge link
        //     $('#imagemodal').modal(
        //         'show'
        //     ); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        // });
    </script>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#truck-table').DataTable({
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
