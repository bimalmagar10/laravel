@extends('layout')

@section('title','product')

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

 
    @component('components.breadcrumbs') 
    	<a href="{{ route('landing-page') }}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('shop.index') }}">Shop</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Macbook Pro</span>
   @endcomponent
 <!-- end breadcrumbs -->


  <div class="product-section container">
          <div >
               <div class="product-section-image">
                <img src="{{ asset('img/macbook-pro.png') }}" alt="product" />
              </div>
          </div>
         
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            
            <div class="product-section-price">{{$product->price}}</div>

            <p>
                {{ $product->description }}
            </p>

            <p>&nbsp;</p>

          {{--  <a href="" class="button">Add To Cart</a> --}}
          <form action="{{ route('cart.store') }}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ $product->id}}"/>
              <input type="hidden" name=" name" value="{{ $product->name}}"/>
              <input type="hidden" name="price" value="{{ $product->price}}"/>
            
            <button type="submit" class="button button-plain">Add To Cart</button>
          </form>
              
        </div>
    </div> <!-- end product-section -->
        @include('partials.might-like') 
    @endsection