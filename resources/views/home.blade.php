@extends('layouts.app')

@section('content')
@php

if(auth::user() != null)
{
    if(isset($findUser) != false)
    {
        $user = $finduser;
    }        
    else
    {
        $user = auth::user();
    } 
}   
else{
    if(isset($findUser) != false)
    {
        $user = $finduser;
    }
    else
    {
        $user = false;
    }     
}

@endphp
<div class="homeContainer">
    <div class="profileContainer">   
        @if($user != false)
            <img class="profileImage" src="{{asset('images/'.$user->image)}}" alt="Profile picture">         
        @endif

        <img class="thumbLogo" src="{{asset('images/thumb_up.png')}}" alt="Like logo">
        <div class="descriptionContainer">
            @if($user != false)
                @if(auth::user() != null)
                    <h1 class="name">{{$user->first_name}} {{$user->last_name}}</h1>
                    <h2 class="relation">Relation status: {{$relations->find($user->relation)->description}}</h2>
                @else
                    <h1 class="name">{{$user->username}}</h1>
                @endif
            @else
                <span class="guestSearch"> Use the search function to stalk some people ! </span>
            @endif
            <br>            
        </div>    
    </div>
    
    <div class="searchContainer">

        <input class="searchBar" name="searchData" type="text" placeholder="Search"> 

        <div id="searchResults"></div>
        <button class="searchBtn">
            <i class="fas fa-search"></i>
        </button> 
        {{ csrf_field() }}       
    </div>
</div>

{{-- <script>
    $('#searchBar').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#searchResults').fadeIn();  
                    $('#searchResults').html(data);
          }
         });
        }
    });
    
    $(document).on('click', 'li', function(){  
        $('#searchBar').val($(this).text());  
        $('#searchResults').fadeOut();  
    }); 
</script> --}}
@endsection
