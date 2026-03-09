{{-- @dd(session('cart')); --}}
{{-- <!-- cart mini area start --> --}}
<div class="cartmini__area tp-all-font-roboto">
  <div class="cartmini__wrapper d-flex justify-content-between flex-column">
    <div class="cartmini__top-wrapper">
      <div class="cartmini__top p-relative">
        <div class="cartmini__top-title">
          <h4>Shopping cart</h4>
        </div>
        <div class="cartmini__close">
          <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
        </div>
      </div>
      <div class="cartmini__widget">
        @php
          $subtotal = 0;
        @endphp
        @if(session('cart') && count(session('cart')) > 0)
          @foreach(session('cart') as $item)
            @php
              $price = $item['discountedPrice'] ?? $item['originalPrice'];
              $subtotal += $price * $item['qty'];
            @endphp

            <div class="cartmini__widget-item">
              <div class="cartmini__thumb">
                <a href="#">
                  <img src="/storage/{{ $item['productImage'] }}" alt="">
                </a>
              </div>
              <div class="cartmini__content">
                <h5 class="cartmini__title">
                  <a href="#">{{ $item['productName'] }}</a>
                </h5>
                <div class="cartmini__price-wrapper">
                  <span class="cartmini__price">
                    ${{ $item['discountedPrice'] ?? $item['originalPrice'] }}
                  </span>
                  <span class="cartmini__quantity">x{{ $item['qty'] }}</span>
                </div>
              </div>
              <button type="button" class="cartmini__del delete__cart__product" data-id="{{ $item['productId'] }}">
                <i class="fa-regular fa-xmark"></i>
              </button>
            </div>
          @endforeach
        @else
          <h3>Cart is Empty..</h3>
        @endif
      </div>
      <!-- for wp -->
      <!-- if no item in cart -->
      <div class="cartmini__empty text-center d-none">
        <img src="assets/img/product/cartmini/empty-cart.png" alt="">
        <p>Your Cart is empty</p>
        <a href="shop.html" class="tp-btn">Go to Shop</a>
      </div>
    </div>
    <div class="cartmini__checkout">
      <div class="cartmini__checkout-title mb-30">
        <h4>Subtotal:</h4>
        <span class="cart-mini-subtotal">$ {{ $subtotal ?? 0 }}</span>
      </div>
      <div class="cartmini__checkout-btn">
        <a href="{{ route('products.cart') }}" class="tp-btn mb-10 w-100"> view cart</a>
        <a href="checkout.html" class="tp-btn tp-btn-border w-100"> checkout</a>
      </div>
    </div>
  </div>
</div>
<!-- cart mini area end -->