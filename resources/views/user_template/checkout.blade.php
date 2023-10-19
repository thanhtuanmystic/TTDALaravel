@extends('user_template.layouts.template')
@section('main-content')
    <h2>Final step to place your order</h2>
    <div class="row">
        <div class="col-8">
            <div class="box_main">
                <h3>Product will send at - </h3>
                <p>City/ Village: {{ $shipping_address->city_name }}</p>
                <p>Phone Number: {{ $shipping_address->phone_number }}</p>
                <p>Postal Code: {{ $shipping_address->postal_code }}</p>
            </div>
        </div>
        <div class="col-4">
            <div class="box_main">
                <h3>Your final products are: </h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart_items as $item)
                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                @endphp
                                <td>{{ $product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @php
                                $total = $total + $item->price;
                            @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            @csrf
            <input type="submit" value="Cancel Order" class="btn btn-danger mr-3">
        </form>
        <form action="{{route('placeorder')}}" method="POST">
            @csrf
            <input type="submit" value="Place Order" class="btn btn-primary">
        </form>
       
    </div>
@endsection
