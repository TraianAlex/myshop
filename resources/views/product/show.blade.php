@extends('layouts.app')

@section('content')

<img class="pull-left product-img" src="/imgs/products/{{ $product->sku }}.png"/>

<h1>{{ $product->name }}</h1>

{!! Form::open(['url' => '/checkout']) !!}
{!! Form::hidden('product_id', $product->id) !!}
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="{{ env('STRIPE_KEY', 'pk_test_2RyzeuD9IWA5VMWNYns0E4mI') }}"
data-name="myshop.embassy-pub.com"
data-billingAddress=true
data-shippingAddress=true
data-label="Buy ${{ $product->price }}"
data-description="{{ $product->name }}"
data-amount="{{ $product->priceToCents() }}">
</script>
{!! Form::close() !!}

<br />

<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_2RyzeuD9IWA5VMWNYns0E4mI"
    data-amount="{{ $product->priceToCents() }}"
    data-name="myshop.embassy-pub.com"
    data-description="{{ $product->name }}"
    data-image="/128x128.png"
    data-locale="auto">
  </script>
</form>

<br />

{!! Form::open(['url' => '/cart/store']) !!}
<input type="hidden" name="product_id" value="{{ $product->id }}"/>
<button type="submit" class="btn btn-primary">Add to Cart</button>
{!! Form::close() !!}

<p>
{{ $product->description }}
</p>

@endsection