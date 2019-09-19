@extends('layouts.app')

@section('content')
@php

//$user always changes depending on the selected and logged-in user.
if(auth::user() != null)
{
    if(isset($findUser) != false)
    {
        $user = $findUser;
    }        
    else
    {
        $user = auth::user();
    } 
}   
else
{
    if(isset($findUser) != false)
    {
        $user = $findUser;
    }
    else
    {
        $user = false;
    }     
}

@endphp

<div class="pageContentContainer">
    <div class="homeContainer">  
        <div class="profileContainer"> 
            {{-- If user is logged in --}}
            @if($user != false)
                {{-- if the logged user is on someone elses page. --}}
                @if(isset($findUser) != false && $findUser->id != Auth::id() && Auth::user() != false)
                    @if( App\Like::where('user_id', Auth::id())->where('liked_user_id', $user->id)->first() == null )
                        <img class="func_img_like" id="functional_image" title="Like" onclick="like({{$user->id}}, '{{csrf_token()}}')" src="{{asset('images/like.png')}}" alt="Like logo">
                    @else
                        <img class="func_img_unlike" id="functional_image" title="Like" onclick="like({{$user->id}}, '{{csrf_token()}}')" src="{{asset('images/unlike.png')}}" alt="Unlike">
                    @endif
                {{-- if on the logged user page --}}
                @elseif(Auth::user() != false)                
                    <img class="func_img" title="Change profile" onclick="edit()" src="{{asset('images/settings.png')}}" alt="Settings logo">
                    <a id="editPageRedirect" href="{{ route('edit') }}"></a>                   
                @else
                    <img class="func_img" style="cursor:none;visibility: hidden;">
                @endif
                <img class="profileImage" src="{{asset('images/users/'.$user->image)}}" alt="Profile picture">         
            @endif  

            <meta name="csrf-token" content="{{ csrf_token() }}">  

            <div class="descriptionContainer">
                @if($user != false)
                    @if(auth::user() != null)
                        <h1 class="name">{{$user->first_name}} {{$user->last_name}}</h1>
                        <h2 class="relation">Relation status: {{$relations->find($user->relation)->description}}</h2>
                        <h4 class="email">Email: {{$user->email}}</h4>
                        <h4 class="adres">Adres: {{$user->streetname}}, {{$user->housenumber}} {{$user->housenumbersuffix}}. Zipcode: {{$user->zipcode}}</h4>
                    @else
                        <h1 class="name">{{$user->username}}</h1>
                    @endif                          
                @endif                
            </div>    
        </div>
        
        <div class="searchContainer">
            <input id="searchBar" class="searchBar" name="searchData" type="text" placeholder="Search"> 
            <div id="searchResults">

            </div>
            <button class="searchBtn">
                <i class="fas fa-search"></i>
            </button> 
            <input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">     
        </div>@csrf

        <div class="userList">
            
        </div>

    </div>

    {{-- shows users in the list  --}}
    <div class="users" class="active">
        <div class="all_users">
        {{-- loop through all users --}}            
            @foreach($users as $u)                
            {{-- Don't show the current user in the list --}}
                @if(@$user->id != $u->id)
                <a class="user-name module" href="{{ route('home.getuser', [$u->id]) }}">
                    <img src="{{asset('images/users/'.$u->image)}}" class="user-avatar" alt="">
                    <span class="user-name-text"> 
                        {{-- if the user isnt logged in, only show the usernames      --}}
                        @if(Auth::user() != null)          
                            {{$u->first_name.' '.$u->last_name}}
                        @else
                            {{$u->username}}
                        @endif
                    </span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>


<script>

$(document).ready(function()
{
    $('#searchBar').keyup(function(e)
    {
        var token = $('#_token').val();
        var searchInput = $('#searchBar').val();
        e.preventDefault();

        var form = $('#hdTutoForm').serialize();

        $.ajax({
            type: 'POST',
            url: "{{ route('home.search') }}",
            data: { searchInput, _token: token},
            
            success: function(response)
            {
                console.log(response);
                $('#searchResults').html(response);
            }
        });
    });
});
</script>
@endsection
