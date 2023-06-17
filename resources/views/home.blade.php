@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Products Details</h3>
    <div class="row">
        <form action="{{ route('home') }}" method="GET">
            <div class="col-4 m-2">
                <input type="text" name="search" class="form-control" placeholder="Search by Product">
            </div>
            <div class="col-4 m-2">
                <select name="order" class="form-control">
                    <option value="" selected disabled>Select Price Order</option>
                    <option value="high_to_low" @if(isset($_GET['order']) && $_GET['order']=="high_to_low" ) selected="true" @endif>Price: High to Low</option>
                    <option value="low_to_high" @if(isset($_GET['order']) && $_GET['order']=="low_to_high" ) selected="true" @endif>Price: Low to High</option>
                </select>
            </div>
            <div class="col-4 m-2">
                <button type="submit" class="form-control btn btn-success">Search</button>
            </div>
        </form>
    </div>



    <div class="row" id="list-products">
        @include('data')
       
    </div>
    <div class="auto-load text-center" style="display: none;">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                    from="0 50 50" to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    @if($total_prod > 10)
    <div class="text-center" id="">
        <button class="btn btn-success load-more-data"><i class="fa fa-refresh"></i> Load More Data...</button>
    </div>
    @endif

</div>

</div>


</div>


@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var ENDPOINT = "{{ route('home') }}";
    var page = 1;
  
    $(".load-more-data").click(function(){
        page++;
        infinteLoadMore(page);
    });
  
    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.html == '') {
                    $('.auto-load').html("We don't have more data to display :(");
                    $(".load-more-data").hide(); 
                    return;
                }
                $('.auto-load').hide();
                $("#list-products").append(response.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
@endpush

