@extends('/layouts/public')

@section('content')
    <div class="header">
        <div class="text-center text-white p-4">Task 1</div>
    </div>
    <div class="content mt-5 mb-5">
        @include('/public/shop/cart_header')
       <div class="products">
           @if (isset($products) && !empty($products))
               <div class="col-md-6 offset-md-3 products-container">
                   <div class="row">
                   @foreach ($products as $product)
                       <div class="col-md-3 product-item">
                           <div class="product-info">
                               <div class="title">{{ $product['title'] }}</div>
                               <hr/>
                               <div class="price"><b>Price:</b> {{ number_format($product['price'], 2) }} €</div>
                               <div class="count"><b>Count:</b> <span class="price">{{ $product['count'] }}</span></div>
                               <hr/>
                               <div class="action text-center">
                                   <button class="add-to-cart btn btn-success btn-sm" data-product-id="{{ $product['id'] }}">Add to cart</button>
                               </div>
                           </div>
                       </div>
                   @endforeach
                   </div>
               </div>
           @else
               <div class="col-md-6 offset-md-3 alert alert-info text-center" role="alert">
                   No products yet.
               </div>
           @endif
       </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/shop.js') }}"></script>
@endsection
