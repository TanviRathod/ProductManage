@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}
                <a href="{{route('product.index')}}" class="btn btn-success" style="float:right">All Product</a>

                </div>

                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">price</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                           <select name="category_id[]" class="form-control js-example-basic-multiple" multiple="multiple" id="category_id">
                           <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                             <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(function() {
      $("#productForm").validate({
      rules: {
        name: {
          required: true
        },
        description: {
          required: true
        },
        price: {
          required: true
        },
        "category_id[]": {
          required: true
        },
        image: {
          required: true
        },
      },
      messages: {
        name: {
          required: "Product Name is a required field"
        },
        description: {
          required: "Description is a required field"
        },
        price: {
          required: "Price is a required field"
        },
        "category_id[]": {
          required: "Category is a required field"
        },
        image: {
          required: "image is a required field"
        },
          },
          errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'category_id') {
                error.insertAfter($(element).next());
            } else {
                error.insertAfter(element); // <- default
            }
    }
      });
});

</script>
@endpush