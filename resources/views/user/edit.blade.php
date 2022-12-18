@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">Edit User</div>
                    <div class="panel-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div
                                class="form-group
                                @if ($errors->has('name')) has-error @endif
                            ">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span
                                        class="help-block
                                        @if ($errors->has('name')) has-error @endif
                                    ">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('role')) has-error @endif
                            ">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="trucking" {{ $user->role == 'trucking' ? 'selected' : '' }}>Trucking
                                    </option>
                                    <option value="finance" {{ $user->role == 'finance' ? 'selected' : '' }}>Finance
                                    </option>
                                </select>
                                @if ($errors->has('role'))
                                    <span
                                        class="help-block
                                        @if ($errors->has('role')) has-error @endif
                                    ">
                                        {{ $errors->first('role') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('email')) has-error @endif
                            ">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span
                                        class="help-block
                                        @if ($errors->has('email')) has-error @endif
                                    ">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('password')) has-error @endif
                            ">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span
                                        class="help-block
                                        @if ($errors->has('password')) has-error @endif
                                    ">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div
                                class="form-group
                                @if ($errors->has('password_confirmation')) has-error @endif
                            ">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        class="help-block
                                        @if ($errors->has('password_confirmation')) has-error @endif
                                    ">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
