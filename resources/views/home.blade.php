@extends('layouts.app')

@section('content')

<div class="homeContainer">
    <div class="profileContainer">
        <img class="profileImage" src="https://p.w3layouts.com/demos/searching_profile_widget/web/images/img1.jpg" alt="Profile picture"> 
        <img class="thumbLogo" src="{{asset('images/thumb_up.png')}}" alt="Like logo">
        <div class="descriptionContainer">
        <h1 class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
            <h2 class="relation">Relation status: {{Auth::user()->relation}}</h2>
            <br>
            <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla illum consequatur veniam doloremque non eius dolorem quasi ut tenetur odit hic magni id libero, vel dolor aut vero quia aliquam?</p>            
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

<script>
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
</script>
@endsection
