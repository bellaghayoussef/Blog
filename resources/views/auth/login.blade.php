@extends('layouts.app')

@section('content')
    
    <!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
        <div class="container wrapper">
        <div class="row">
            <div class="col-sm-5">
            <div class="intro-texts">
               
            </div>
          </div>
            <div class="col-sm-6 col-sm-offset-1">
            <div class="reg-form-container"> 
            
              <!-- Register/Login Tabs-->
              <div class="reg-options">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#register" data-toggle="tab">Register</a></li>
                  <li><a href="#login" data-toggle="tab">Login</a></li>
                </ul><!--Tabs End-->
              </div>
              
              <!--Registration Form Contents-->
              <div class="tab-content">
                <div class="tab-pane active" id="register">
                  <h3>Register Now !!!</h3>
                 
                  
                  <!--Register Form-->
                  <form name="registration_form" id='registration_form' class="form-inline" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                        @csrf

                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" class="form-control input-group-lg" type="text" name="name" title="Enter  name" placeholder=" name"/>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email"/>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password"/>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                     <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" class="form-control input-group-lg" type="password" name="password_confirmation" title="Enter password-confirm" placeholder="password-confirm"/>
                      </div>
                    </div>

                      <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="avatar" class="sr-only">Avatar</label>
                        <input id="avatar" class="form-control input-group-lg" type="file" name="avatar" title="Enter avatar" placeholder="Your Email"/>
                      </div>
                    </div>
                     <button class="btn btn-primary">Register Now</button>
                  </form><!--Register Now Form Ends-->
                  <p><a href="#login" data-toggle="tab">Already have an account?</a></p>
                
                </div><!--Registration Form Contents Ends-->
                
                <!--Login-->
                <div class="tab-pane" id="login">
                  <h3>Login</h3>
                  <p class="text-muted">Log into your account</p>
                  
                  <!--Login Form-->
                  <form name="Login_form" id='Login_form'method="POST" action="{{ route('login') }}">
                        @csrf
                     <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-email" class="sr-only">Email</label>
                        <input id="my-email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-password" class="sr-only">Password</label>
                        <input id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password"/>
                      </div>
                    </div>
                  <button class="btn btn-primary">Login Now</button>
                  </form><!--Login Form Ends--> 
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-6">
          
            <!--Social Icons-->
           
          </div>
        </div>
      </div>
    </div>
@endsection
