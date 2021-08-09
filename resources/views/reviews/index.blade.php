@extends('layout.app')

@section('css')
    <style>
        .avatar {
            max-height: 100px;
            max-width:  100px;
        }
    </style>
@endsection

@section('content')

    <x-alert class="mt-5"></x-alert>
    <form action="{{ route('reviews') }}" method="post" enctype="multipart/form-data" class="mt-5">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="text">Text</label>
            <textarea name="text" id="text" class="form-control"></textarea>
            @error('text') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" class="form-control">
            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-info btn-xs mt-3">Send</button>
        </div>
    </form>

    <div class="col-12 mt-5">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Sort  ({{ request('sort') ?? 'created_at' }})
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/?sort=name">Name</a></li>
                <li><a class="dropdown-item" href="/?sort=email">Email</a></li>
                <li><a class="dropdown-item" href="/?sort=created_at">Date</a></li>
            </ul>
        </div>
    </div>
    <table class="table table-hovered">
        <thead>
            <tr>
                @auth()
                    <td>Photo</td>
                    <td>Status</td>
                @endauth
                <td>Name</td>
                <td>Email</td>
                <td>Text</td>
                <td>Is Edited</td>
                <td></td>
            </tr>
        </thead>

        <tbody>
        @forelse($reviews as $review)
            <tr>
                @auth()
                    <td>
                        <a href="{{ '/photo/'. $review->photo }}">
                            <img src="{{ '/photo/'. $review->photo }}" class="avatar thumbnail" alt="">
                        </a>
                    </td>
                    <td>{{ $statuses[$review->status] }}</td>
                @endauth
                <td>{{ $review->name }}</td>
                <td>{{ $review->email }}</td>
                <td>{{ $review->text }}</td>
                <td>{{ $review->edited_at ? 'edited by administrator' : null }}</td>
                <td>
                   @auth()
                        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-info btn-sm">Edit</a>
                    @endauth
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <h2 class="text-gray mt-5 border p-3 text-center">There is not review yet</h2>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
