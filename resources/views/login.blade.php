@extends('layout.app')


@section('content')
    <div class="container">

        <div class="col-6 offset-md-3 offset-0 mt-5">
            <x-alert></x-alert>
            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="pass">password</label>
                    <input type="password" name="password"  class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
