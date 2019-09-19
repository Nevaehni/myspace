@extends('layouts.app')

@section('content')
@php  
  
    $user = auth::user();  
    
@endphp

<style>

.invalid-feedback
{
    display: unset !important;
}

</style>
<div class="pageContentContainer">
    <div class="homeContainer">  
        <div class="profileContainer"> 

            <form method="POST" class="mainForm" action="{{ route('edit.update') }}" enctype="multipart/form-data">
                @csrf   

                <img class="func_img_edit" title="Go back" onclick="home()" src="{{asset('images/go_back.png')}}" alt="Settings logo">
                <a id="homePageRedirect" href="{{ route('home') }}"></a>

                <img class="profileImage" id="profileImage" src="{{asset('images/users/'.$user->image)}}" alt="Profile picture">   
                <img class="browseLogo"  title="Upload image" onclick="uploadImg()" src="{{asset('images/browse.png')}}" alt="Profile picture">     
            
                <input style="visibility:hidden; position:fixed;" name="imageUpload" type='file' id="imageUpload" accept="image/png,image/gif,image/jpeg,image/jpg,image/svg" />
                
                <div class="descriptionContainer">                   
                    
                    <label for="first_name">Name</label>   
                    <br>             
                    <input type="text" name="first_name" id="first_name" value="{{$user->first_name}}" placeholder="First name">              
                    <input type="text" name="last_name" id="last_name" value="{{$user->last_name}}" placeholder="Last name">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <Br>
                    <label for="username">Username</label>
                    <br>                    
                    <input type="text" name="username" id="username" value="{{$user->username}}" placeholder="Username">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="relation">Relation status</label>
                    <br>
                    <select name="relation">
                        @foreach(App\Relation::all() as $r)
                        {
                            <option value="{{$r->id}}">{{$r->description}}</option>
                        }
                        @endforeach
                    </select>
                    @error('relation')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="email">Email</label>
                    <br>
                    <input type="text" name="email" id="email" value="{{$user->email}}" placeholder="Email">          
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror       
                    <br>
                    <label for="streetname">Address</label>
                    <Br>
                    <input type="text" name="zipcode" value="{{$user->zipcode}}" placeholder="Zipcode">
                    <input type="text" id="streetname" name="streetname" value="{{$user->streetname}}" placeholder="Street">
                    <input type="text" name="housenumber" value="{{$user->housenumber}}" placeholder="Housenumber">
                    <input type="text" name="housenumbersuffix" value="{{$user->housenumbersuffix}}" placeholder="Housenumber suffix">
                    <br>              
                    @error('zipcode')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('streetname')
                    <div class="custom-control">
                            <span class="invalid-feedback" role="alert">
                                    <br>
                                    <strong>{{ $message }}</strong>
                                </span>
                    </div>                        
                    @enderror
                    @error('housenumber')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('housenumbersuffix')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                
                    <br>
                    <label for="password">Password</label>
                    <Br>
                    <input id="password" type="password" name="password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <br>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                    <Br>
                    <Br>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>                   
            </div>
        </form>
        
        <div class="searchContainer">            
            <button class="searchBtn">                
            </button>     
        </div>
        
    </div>
</div>

@endsection
