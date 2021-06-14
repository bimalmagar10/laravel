@extends('layout')

@section('title', 'Thank You')

@section('extra-css')
          <script src="https://js.stripe.com/v3/"></script>
@endsection


@section('content')

   <div class="thank-you-section">
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button">Home Page</a>
       </div>
   </div>




@endsection
