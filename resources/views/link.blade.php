@extends('layouts.app')

@section('content')
<div class="container">
    @error('purchase')
        <div class="row justify-content-center alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="row justify-content-center alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <form method="POST" action="/link/{{ request()->route('id') }}">
        @csrf
            <div class="form-group">
                <input type="text" name="purchase" placeholder="Enter the purchase sum" class="form-control">
                <button type="submit" class="btn btn-primary form-control mt-2">OK</button>
            </div>
        </form>
    </div>
</div>
@endsection