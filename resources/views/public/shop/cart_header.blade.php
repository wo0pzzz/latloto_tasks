<div class="cart-container mb-3">
    <div id="cart" class="col-md-6 offset-md-3 text-right">
        <a href="{{ route('checkout') }}">
            <i class="fa fa-shopping-cart"></i> Cart <span class="count" data-item-count="{{ (isset($cart_count) ? $cart_count : 0) }}">{{ (isset($cart_count) ? '('. $cart_count .')' : '') }}</span>
        </a>
    </div>
</div>
