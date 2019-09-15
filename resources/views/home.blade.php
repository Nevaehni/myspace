@extends('layouts.app')

@section('content')
@php

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
else{
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

            @if($user != false)
                @if(isset($findUser) != false && $findUser->id != Auth::id() && Auth::user() != false)
                    <img class="func_img" title="Like" onclick="like({{$user->id}}, '{{csrf_token()}}')" src="{{asset('images/thumb_up.png')}}" alt="Like logo">
                    {{-- <span class="img_description">Like profile</span> --}}
                @elseif(Auth::user() != false)                
                    <img class="func_img" title="Change profile" onclick="edit()" src="{{asset('images/settings.png')}}" alt="Settings logo">
                    <a id="editPageRedirect" href="{{ route('edit') }}"></a>
                    {{-- <span class="img_description">Edit profile</span> --}}
                @endif
                <img class="profileImage" src="{{asset('images/'.$user->image)}}" alt="Profile picture">         
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
            <input class="searchBar" name="searchData" type="text" placeholder="Search"> 
            <div id="searchResults"></div>
            <button class="searchBtn">
                <i class="fas fa-search"></i>
            </button> 
            {{ csrf_field() }}       
        </div>

        <div class="userList">
            
        </div>
    </div>

    {{-- shows users in the list  --}}
    <div class="users" class="active">
        <div class="all_users">
        {{-- loop through all users --}}            
            @foreach($users as $u)                
            {{-- dont show the current user in the list --}}
                @if(@$user->id != $u->id)
                <a class="user-name module" href="{{ route('home.getuser', [$u->id]) }}">
                    <img src="{{asset('images/'.$u->image)}}" class="user-avatar" alt="">
                    <span class="user-name-text">                
                        {{$u->first_name.' '.$u->last_name}}
                    </span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
