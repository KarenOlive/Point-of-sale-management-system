@extends('layouts.layout')
@section('content')

<!-- Print section -->
<div id="printed_content" class="printed_content">
    <center>
        <div class="logo"></div>
        <div class="info"></div>
        <h2>TECHMart Ltd</h2>
    </center>
</div>
<div class="mid">
    <div class="info">
        <h4>Contact</h4><p>0765477899</p>
        <h5>Email:</h5><p>techmart@pos.com</p>
        <address>
            Address: 23 Orange Street
        </address>
    </div>
</div>
@endsection
@section('scripts')
<script>
     var dummydata = $.ajax({type:'GET',
     url:'https://fakestoreapi.com/products',
     success:
     

    })

       .then(json=>console.log(json))
</script>
@endsection
