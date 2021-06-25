@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <button class="col-md-12 btn btn-success" onclick="$('#add-client').show()">Add Client</button>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Request count</th>
                        <th scope="col">Purchase sum</th>
                        <th scope="col">Unique link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $client)
                        <tr>
                            <th scope="row">{{ $client->id }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->request_count }}</td>
                            <td>{{ $client->purchase_sum }}</td>
                            <td>
                                @if($client->link)
                                    <a href="{{ request()->root() . '/link/' . $client->link }}">{{ $client->link }}</a>
                                @else
                                    ''
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="add-client" class="modal" tabindex="-1" role="dialog">
    <form method="POST" action="/clients/add">
    @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#add-client').hide()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-group">
                <input type="text" name="name" placeholder="name" class="form-control mb-2">
                <input type="text" name="phone" placeholder="phone" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#add-client').hide()">Close</button>
            </div>
            </div>
        </div>
    </form>
</div>
@endsection
