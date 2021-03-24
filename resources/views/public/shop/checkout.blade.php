@extends('/layouts/public')

@section('content')
    <div class="header">
        <div class="text-center text-white p-4">Task 1</div>
    </div>
    <div class="content mt-5 mb-5">
        <div class="cart-container mb-3">
            <div id="cart" class="col-md-6 offset-md-3 text-right">
                <a href="{{ route('shop') }}">
                    <i class="fa fa-shopping-basket"></i> Shop</span>
                </a>
            </div>
        </div>
        <div class="checkout">
            @if (isset($products) && !empty($products))
                <div class="col-md-6 offset-md-3 products-container">
                    @foreach ($products as $product)
                        <div class="col-md-12 p-checkout-item">
                                <div class="row">
                                    <div class="col-md-3"><b>{{ $product['title'] }}</b></div>
                                    <div class="col-md-3 price" data-price="{{ $product['price'] * $product['count'] }}">{{ $product['price'] }}€</div>
                                    <div class="col-md-3"><b>Count:</b> {{ $product['count'] }}</div>
                                    <div class="col-md-3 text-right">
                                        <a href="#" class="text-danger remove-product" data-product-id="{{ $product['id'] }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                    <div class="total-container">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <b>Total price:</b>
                                    <span class="total-price" data-total-price="{{ (isset($total_price) ? $total_price : '0') }}">{{ (isset($total_price) ? $total_price .'€' : '') }}</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-container mb-4">
                                        <b>Choose your payment method</b>
                                        <select name="payment-method" class="form-control payment-method">
                                            <option value=""></option>
                                            <option value="iban">IBAN</option>
                                            <option value="card">Credit card</option>
                                        </select>
                                    </div>
{{--                                    <div class="checkout-btn text-right">--}}
{{--                                        <a href="{{ route('gocheckout') }}">--}}
{{--                                            <button class="btn btn-success" disabled="disabled">Checkout</button>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="payment-info">
                                <form class="payment-form" method="POST" action="{{ route('gocheckout') }}">
                                    {!! csrf_field() !!}
                                    <div class="form-group iban">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="First name, Last name">
                                    </div>
                                    <div class="form-group iban">
                                        <label>IBAN</label>
                                        <input type="text" name="iban" class="form-control" placeholder="IBAN">
                                    </div>
                                    <div class="form-group creditcard">
                                        <label>Card number</label>
                                        <input type="text"  name="cardnumber" class="form-control" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="form-group creditcard">
                                        <label>Name on card</label>
                                        <input type="text" name="nameoncard" class="form-control" placeholder="Ex. Artur Website">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group creditcard">
                                                <label>Expiry date</label>
                                                <input type="text" name="expirydate" class="form-control" placeholder="24 /  21">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group creditcard">
                                                <label>Security code</label>
                                                <input type="password" name="securitycode" class="form-control" placeholder="***">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success checkout-btn">Checkout</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6 offset-md-3 alert alert-info text-center" role="alert">
                    No products in cart. <br/>
                    <a href="{{ route('shop') }}">Return to Shop</a>
                </div>
            @endif
            <div class="col-md-6 offset-md-3 alert alert-info text-center no-product-left" role="alert">
                No products in cart. <br/>
                <a href="{{ route('shop') }}">Return to Shop</a>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/shop.js') }}"></script>
@endsection
