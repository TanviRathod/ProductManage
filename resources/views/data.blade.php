@foreach($products as $product)
        <div class="col-md-3">
            <div class="card m-2">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                        <img src="{{asset('images/'.$product->image)}}" hight="200" width="200" alt='No Image' /><br>
                        Name : {{$product->name}} <br>
                        Price : {{$product->price}} <br>
                        Description : {{$product->description}}<br>
                    <div class="stock_message text-danger"></div>
                </div>
                </p>
            </div>
        </div>

        @endforeach