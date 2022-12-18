<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Client</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Client</div>
                    <div class="panel-body
                        @if ($errors->any())
                            has-error
                        @endif
                    ">
                        <form action="{{ route('client.update', $client->id) }}" method="POST">
                            @csrf
                            <div class="form-group
                                @if ($errors->has('name'))
                                    has-error
                                @endif
                            ">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block
                                        @if ($errors->has('name'))
                                            has-error
                                        @endif
                                    ">
                                        {{ $errors->first('name') }}
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
        </div>
    </div>
</body>
</html>
