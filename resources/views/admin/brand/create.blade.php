@extends('layouts.admin')

@section('content')
    <div class="my-5 mx-3 p-4 bg-white shadow rounded-3">
        <div class="card-header p-0 position-relative mt-n5 mx-n2 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Brand Create</h6>
                <a href="{{route('admin.brand.index')}}" class="btn btn-dark me-4">Back</a>
            </div>
        </div>
        <form action="{{route('admin.brand.store')}}" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" value="{{old('name')}}" type="text" class="form-control border px-2" id="name" aria-describedby="emailHelp" placeholder="name">
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input name="image" class="form-control border px-2" type="file" id="image">
            </div>
            <div class="mb-3 form-check">
                <input name="status" type="checkbox" class="form-check-input border" id="status">
                <label class="form-check-label" for="status">Status</label>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
