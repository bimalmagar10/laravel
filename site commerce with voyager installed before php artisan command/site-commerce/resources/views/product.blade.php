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
                <img src="{{ productImage($product->image) }}" alt="product" id="currentImage" />
              </div>
              
               <div class="product-section-images">
                    @if ($product->images)
                          <div class="product-section-thumbnail selected">
                             <img src="{{ productImage($product->image) }}" alt="product">
                         </div>
                        <!--here json_decode is used to convert string into array -->
                        @foreach (json_decode($product->images,true) as $image)
                          <div class="product-section-thumbnail ">
                             <img src="{{ productImage($image) }}" alt="product">
                         </div>

                        @endforeach
                    @endif
                  </div>
          </div>
         
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            
            <div class="product-section-price">{{$product->presentPrice()}}</div>

            <p>
                {!! $product->description !!}
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

    @section('extra-js')
    <script>
      (function(){
                  const currentImage = document.querySelector('#currentImage');
                  const images = document.querySelectorAll('.product-section-thumbnail');

                  images.forEach((element)=> element.addEventListener('click',thumbnailClick));


                  function thumbnailClick(e){
                    currentImage.src = this.querySelector('img').src;
                    images.forEach((element) => element.classList.remove('selected'));
                    this.classList.add('selected');
                  }
      })();
    </script>
    @endsection