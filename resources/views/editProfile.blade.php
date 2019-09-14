@extends('layouts.app')

@section('content')
@php  
  
    $user = auth::user();  
    
@endphp

<div class="pageContentContainer">
    <div class="homeContainer">  
        <div class="profileContainer"> 

            <img class="func_img" onclick="{{ url('/home/edit')}}" src="{{asset('images/save_icon.png')}}" alt="Settings logo">
            <img class="profileImage" id="profileImage" src="{{asset('images/'.$user->image)}}" alt="Profile picture">   
            <img class="browseLogo" onclick="uploadImg()" src="{{asset('images/browse.png')}}" alt="Profile picture">     
           
            <input style="visibility:hidden;" type='file' id="imgInp" accept="image/x-png,image/gif,image/jpeg" />
            
            <form method="POST" action="{{ route('edit.update') }}">
                @csrf                  
                <div class="descriptionContainer">
                    
                    <label for="first_name">First/last name</label>   
                    <br>             
                    <input type="text" name="first_name" id="first_name" placeholder="{{$user->first_name}}">              
                    <input type="text" name="last_name" id="last_name" placeholder="{{$user->last_name}}">
                    <br>
                    <br>
                    <label for="relation">Relation status</label>
                    <br>
                    <input type="text" name="relation" id="relation" placeholder="{{$relations->find($user->relation)->description}}">
                    <br>
                    <br>
                    <label for="email">Email</label>
                    <br>
                    <input type="text" name="email" id="email" placeholder="{{$user->email}}">
                    <br>
                    <br>
                    <label for="street">Address</label>
                    <Br>
                    <input type="text" name="zipcode" placeholder="Zipcode">
                    <input type="text" id="street" name="street" placeholder="Street">
                    <input type="text" name="housenumber" placeholder="Housenumber">
                    <input type="text" name="housenumbersuffix" placeholder="Housenumber suffix">
                    <br>
                    <Br>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>    
            </div>
        </form>
        
        <div class="searchContainer">
            <div id="searchResults"></div>
            <button class="searchBtn">
                <i class="fas fa-search"></i>
            </button>      
        </div>
    </div>
</div>

@endsection
