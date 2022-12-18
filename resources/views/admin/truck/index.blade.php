@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Truck List</div>
                    <a href="{{ route('truck.create') }}" class="btn btn-success">Create Truck</a>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
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
                                        <td>{{ $truck->license_plate }}</td>
                                        <td>{{ $truck->brand }}</td>
                                        <td>{{ $truck->production_year }}</td>
                                        <td>{{ $truck->last_maintenance }}</td>
                                        <td>{{ $truck->state->type }}</td>
                                        <td>{{ $truck->state->evidence }}</td>
                                        <td>
                                            <a href="{{ route('truck.edit', $truck->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('truck.destroy', $truck->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
