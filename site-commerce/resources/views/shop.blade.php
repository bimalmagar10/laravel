@extends('layout')

@section('title','Products')

@section('extra-css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/algolia.css') }}">
 @endsection
 @section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="{{ route('landing-page') }}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shop</span>
    @endcomponent

     <div class="products-section container">
        <div class="sidebar">
            <h3>By Category</h3>
            <ul>
                @foreach ($categories as $category)
                  <li  class="{{ setActive($category->slug)}}"><a href="{{ route('shop.index',['category' => $category->slug])}}">{{ $category->name}}</a></li>
                @endforeach
             

                
            </ul>
            {{-- <h3>By Price</h3>
             <ul>
             	<li><a href="">$0-$700</a></li>
             	<li><a href="">$700-$2500</a></li>
             	<li><a href="">$2500</a></li>
             </ul> --}}
        </div> <!-- end sidebar -->


        <!-- <div>
            <div class="products-header">
                <h1 class="stylish-heading">Laptops</h1>
                <div>
                    <strong>Price: </strong>
                    <a href="">Low to High</a> |
                    <a href="">High to Low</a>

                </div>
            </div>

           </div>
 -->
           <div>
            <div class="products-header">
              <h1 class="stylish-heading">{{ $categoryName}}</h1>
              <div>
                <strong>Price</strong>
                <a href="{{ route('shop.index',['category' => request()->category,'sort' => 'low_high'])}}">Low To High</a> |
                <a href="{{ route('shop.index',['category' => request()->category,'sort' => 'high_low'])}}">High To Low</a>
              </div>
            </div>
           	{{-- <h1 class="stylish-heading">{{ $categoryName}}</h1> --}}
           	<div class="products text-center">
           		
             @forelse($products as $product)
                <div class="product">
                <a href="{{ route('shop.show',$product->slug) }}"><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product" /></a>

                    <a href="{{ route('shop.show',$product->slug) }}"><div class="product-name">{{$product->name}}</div></a>
                    <div class="product-price">{{ $product->presentPrice() }}</div>
              </div>
              @empty
                <div style="text-align:left" class="alert alert-danger">No Items found</div>
             @endforelse  

            
           	</div>
            <div class="spacer">
              {{-- {{ $products->links()}}  --}}
              {{ $products->appends(request()->input())->links()}}
            </div>
             

           </div>
         </div>
@endsection