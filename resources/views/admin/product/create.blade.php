@extends('layouts.admin')

@section('content')
    <div class="text-center py-4">
        <h3 class="text-3xl font-bold">Add new Product</h3>
        <p class="font-weight-bolder text-lg">This information will let us know more about you.</p>
    </div>
    <div x-data="{ tab1:'true', tab2:'false', tab3:'false', tab4:'false'}" class="my-5 mx-10 p-4 bg-white shadow rounded-3">
        <div class="card-header p-0 position-relative mt-n6 mx-n2 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg py-5 px-5 d-flex justify-content-between align-items-center">
                <span @click="tab1=true; tab2=false; tab3=false; tab4=false;" class="w-2 h-4 rounded-full bg-white inline-block"></span>
                <span class="w-[225px] h-0.5 bg-white/50 inline-block"></span>
                <span @click="tab1=false; tab2=true; tab3=false; tab4=false;" class="w-2 h-4 rounded-full bg-white/50 inline-block"></span>
                <span class="w-[225px] h-0.5 bg-white/50 inline-block"></span>
                <span @click="tab1=false; tab2=false; tab3=true; tab4=false;" class="w-2 h-4 rounded-full bg-white/50 inline-block relative"></span>
                <span class="w-[225px] h-0.5 bg-white/50 inline-block"></span>
                <span @click="tab1=false; tab2=false; tab3=false; tab4=true;" class="w-2 h-4 rounded-full bg-white/50 inline-block relative"></span>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $item)
                    <div>{{$item}}</div>
                @endforeach
            </div>
        @endif
        <form action="{{route('admin.product.store')}}" method="post" class="mt-4" enctype="multipart/form-data">
            @csrf

            <div x-show="tab1" class="min-h-[250px]">
                <h5 class="font-bold text-xl mb-4">Product Information</h5>
                <div class="d-flex justify-content-between gap-4">
                    <div class="w-50">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" value="{{old('name')}}" type="text" class="form-control form-control-sm border-bottom" id="name" aria-describedby="emailHelp">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" type="text" class="form-control form-control-sm border-bottom" id="description" aria-describedby="emailHelp"></textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="w-50">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input name="slug" value="{{old('slug')}}" type="text" class="form-control form-control-sm border-bottom" id="slug" aria-describedby="emailHelp">
                            @error('slug')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category_id</label>
{{--                            <input name="category_id" value="{{old('category_id')}}" type="text" class="form-control form-control-sm border-bottom" id="category_id" aria-describedby="emailHelp">--}}
                            <select name="category_id" id="category_id">
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}"</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand_id</label>
{{--                            <input name="brand_id" value="{{old('brand_id')}}" type="text" class="form-control form-control-sm border-bottom" id="brand_id" aria-describedby="emailHelp">--}}
                            <select name="brand_id" id="brand_id">
                                @foreach($brands as $item)
                                    <option value="{{$item->id}}">{{$item->name}}"</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab2" class="min-h-[250px]">
                <h5 class="font-bold text-xl mb-4">Media</h5>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input name="thumbnail" class="form-control form-control-sm border-bottom" type="file" id="thumbnail">
                </div>
            </div>

            <div x-show="tab3" class="min-h-[250px]">
                <h5 class="font-bold text-xl mb-4">Details</h5>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input name="quantity" value="{{old('quantity')}}" type="number" class="form-control form-control-sm border-bottom" id="quantity" aria-describedby="emailHelp">
                    @error('quantity')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input name="trending" type="checkbox" class="form-check-input border-bottom" id="status">
                    <label class="form-check-label" for="status">Trending</label>
                </div>
                <div class="mb-3 form-check">
                    <input name="status" type="checkbox" class="form-check-input border-bottom" id="status">
                    <label class="form-check-label" for="status">Status</label>
                </div>
            </div>

            <div x-show="tab4" class="min-h-[250px]">
                <h5 class="font-bold text-xl mb-4">Pricing</h5>
                <div class="mb-3">
                    <label for="base_price" class="form-label">Base_price</label>
                    <input name="base_price" value="{{old('base_price')}}" type="number" class="form-control form-control-sm border-bottom" id="base_price" aria-describedby="emailHelp">
                    @error('base_price')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sale_percent" class="form-label">Sale_percent</label>
                    <input name="sale_percent" value="{{old('sale_percent')}}" type="number" class="form-control form-control-sm border-bottom" id="sale_percent" aria-describedby="emailHelp">
                    @error('sale_percent')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input name="price" value="{{old('price')}}" type="number" class="form-control form-control-sm border-bottom" id="price" aria-describedby="emailHelp">
                    @error('price')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="flex justify-content-between items-center pt-4">
{{--                <button type="button" class="btn btn-light">Prev</button>--}}
                <button type="submit" class="btn btn-dark">Upload</button>
            </div>
        </form>
    </div>
@endsection
