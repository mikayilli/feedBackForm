@extends('layout.app')


@section('content')

    <x-alert class="mt-5"></x-alert>
    <form action="{{ route('reviews.update', $review) }}" method="post" enctype="multipart/form-data" class="mt-5">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') ?? $review->name }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="form-control"  value="{{ old('email') ?? $review->email }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="text">Text</label>
            <textarea name="text" id="text" class="form-control">{{ old('text') ?? $review->text }}</textarea>
            @error('text') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="ac">Status</label>
            <select name="status" id="ac" class="form-select">
                <option {{ $review->status == 0 ? 'selected' : '' }} value="0">New</option>
                <option  {{ $review->status == 1 ? 'selected' : '' }} value="1">Accepted</option>
                <option  {{ $review->status == 2 ? 'selected' : '' }} value="2">Rejected</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-info btn-xs mt-3">Send</button>
        </div>
    </form>

@endsection
