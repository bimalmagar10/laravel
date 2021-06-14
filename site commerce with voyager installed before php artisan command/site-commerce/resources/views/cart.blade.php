@extends('layout')

@section('title','Shopping Cart')

@section('extra-css')

@endsection


@section('content')
  @component('components.breadcrumbs')
        <a href="{{ route('landing-page') }}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Cart</span>
    @endcomponent

     <div class="cart-section container">
        <div>
        	@if(session()->has('success_message'))
        	     <div class="alert alert-success">
        	           {{session()->get('success_message')}}
        	     </div>      

        	@endif

        	@if(count($errors) > 0)
                 <div class="alert alert-danger">
	                <ul>
	               	    @foreach($errors->all() as $error)
	                      <li>{{ $error }}</li>
	                    @endforeach  
	                   
	                </ul>
                </div>
            @endif   
             
             @if(Cart::count() >0)


        	<h2>{{ Cart::count()}} item(s) in SHOPPING cart</h2>
        	     <div class="cart-table">
        	     	@foreach(Cart::content() as $item)

	        	  	 <div class="cart-table-row">
	        	  		<div class="cart-table-row-left">
	        	  			<a href="{{ route('shop.show',$item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
	        	  			   <div class="cart-item-details">
			    	  			  	<div class="cart-table-item"><a href="{{ route('shop.show',$item->model->slug) }}">{{$item->model->name}}</a></div>
			                        <div class="cart-table-description">{{$item->model->details}}</div>
	                            </div>
	                    </div>
	                  
	                    <div class="cart-table-row-right">
	                            <div class="cart-table-actions">
		                             {{-- <a href=" {{ route('cart.destroy',$item->model->id) }}">Remove</a> </br> --}}

		                             <form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
		                             	@csrf
		                             	@method('DELETE')
		                             	<button type="submit" class="cart-options">Remove</button>
		                             </form>
		                             {{-- <a href="">Save for Later</a>  --}}
		                             <form action="{{ route('cart.switchToSaveForLater',$item->rowId) }}" method="POST">
		                             	@csrf

		                             	<button type="submit" class="cart-options">Save For Later</button>

		                             </form>
	                            </div>

	                            <div>
	                            	<select class="quantity" data-id="{{ $item->rowId }}">
                                        @for ($i = 1; $i <10+1 ; $i++)
                                            <option {{ $item->qty == $i ? 'selected':''}}>{{ $i}}</option>
                                        @endfor
	                            		
	                            		
	                            	</select>
	                            </div>
	                            <div>{{ presentPrice($item->subtotal()) }}</div>
	                    </div>

	                </div>
	                 @endforeach
	             </div>
               

	             <a href="#" class="have-code">Have a Code?</a>

                <div class="have-code-container">
                    <form action="" method="">
                        @csrf
                        
                        <input type="text" >
                        <button type="submit" class="button button-plain">Apply</button>
                    </form>
                </div> <!-- end have-code-container -->
                  
            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax </br>
                        <span class="cart-totals-total">Total</span>
                     </div>
                     <div class="cart-totals-subtotal">
                        {{ presentPrice(Cart::subtotal()) }} </br>
                       {{presentPrice(Cart::tax())}}</br>
                        <span class="cart-totals-total">{{ presentPrice(Cart::total())}}</span>
                    </div>
                </div> 

             </div>
             
             <div class="cart-buttons">
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
            </div>  
            @else
              
               <h3>No items in the Cart</h3>
               <div class="spacer"></div>
               <a href="{{  route('shop.index') }}" class="button">Continue Shopping</a>
               <div class="spacer"></div>
           

            @endif 



             @if(Cart::instance('saveForLater')->count() > 0)
                    <h2>{{ Cart::instance('saveForLater')->count()}} item(s) saved for later</h2>

             

             <div class="saved-for-later cart-table">
                @foreach (Cart::instance('saveForLater')->content() as $item)
                    
                
             	<div class="cart-table-row">
                    <div class="cart-table-row-left">
                    	<a href="{{ route('shop.show',$item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                    	<div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('shop.show',$item->model->slug) }}">{{$item->model->name}}</a></div>
                            <div class="cart-table-description">{{$item->model->details}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                       <div class="cart-table-actions"> 
                         {{-- a href="" class="">DELETE</a> <br> --}}
                        
                         <form action="{{ route('saveForLater.destroy',$item->rowId)  }}" method="POST">
                          @csrf
                          @method('DELETE')
                           <button type="submit" class="cart-options">Remove</button> 
                         </form>
                         
                         
                         <form action="{{ route('saveForLater.switchToCart',$item->rowId) }}" method="POST">
                                 @csrf
                                  <button type="submit" class="class-options">Move To Cart</button>
                         </form>

                        </div>
                        <div>{{$item->model->price}}</div>
                      </div> 
                </div>
                @endforeach
            </div>
            @else
               <h3>No items Saved for Later</h3>
            @endif
            
      
            
            
           
            </div>
     </div>
     @include('partials.might-like')                 

@endsection

@section('extra-js')
<script src=" {{ asset('js/app.js') }}"></script>
<script>
    (function(){
          const classname = document.querySelectorAll('.quantity')

          Array.from(classname).forEach(function(element){
            element.addEventListener('change',function(){
                 const id= element.getAttribute('data-id')
                    axios.patch(`cart/${id}`, {
                    quantity:this.value
                  })
                  .then(function (response) {
                    
                    window.location.href = '{{ route('cart.index')}}';
                    console.log(response);
                  })
                  .catch(function (error) {
                     
                    window.location.href = '{{ route('cart.index') }}';
                    console.log(error);
                  });
            })
          })
    })();
</script>
@endsection