@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content pt-2">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Client List</div>
                    <a href="{{ route('client.create') }}" class="btn btn-primary mb-2">Add New Client</a>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>
                                            <a href="{{ route('client.edit', $client->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('client.delete', $client->id) }}" method="POST">
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
