@extends('user_template.layouts.template')
@section('main-content')
    <h2>Provide your shipping address</h2>
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{route('addshippingaddress')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input class="form-control" type="text" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City/ Village Name:</label>
                        <input class="form-control" type="text" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input class="form-control" type="text" name="postal_code">
                    </div>
                    <input type="submit" value="Next" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
