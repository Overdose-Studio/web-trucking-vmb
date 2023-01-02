@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="panel-heading">Truck List</h1>
            <a href="{{ route('truck.create') }}" class="btn btn-success mb-2">Create Truck</a>
            <div class="panel-body">
                <table class="table table-bordered">
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
                        @forelse ($trucks as $truck)
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
                                    @if ($truck->state->type == 'good')
                                        No Evidence, Truck is Good
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
                                    <a href="{{ route('truck.edit', $truck->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('truck.destroy', $truck->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
                        @endforelse
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
