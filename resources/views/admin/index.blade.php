@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product List') }}
                    <a href="{{route('product.create')}}" class="btn btn-success" style="float:right">Create Product</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
  $(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('product.getdata') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'price', name: 'price'},
            {data: 'category_id', name: 'category_id'},
            {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return "<img src=\"images/" + data + "\" height=\"100\" with=\"100\"/>";
                    }
                },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>
@endpush
