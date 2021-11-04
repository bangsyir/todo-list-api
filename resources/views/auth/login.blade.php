@extends('layouts.app')
@section('title') login @endsection
@section('content')
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-10 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <span class="font-weight-bold">Login</span>
          </div>
          <div class="card-body">
            <div class="alert alert-danger d-none" id="alert"></div>
            <form action="/" method="POST" id="loginForm">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="input email">
                <small id="email-error" class="text-danger d-none">error message</small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="input password">
                <small id="password-error" class="text-danger d-none">error message</small>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
      window.onload= function() {
        const form = document.getElementById('loginForm')
        form.addEventListener("submit", (e) => {
          e.preventDefault();
  
          const email = document.querySelector('#email').value;
          const password = document.querySelector('#password').value;
  
          const data = {email: email, password: password};
          fetch('/v1/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
          })
          .then(response => response.json())
          .then(data => {
            if(data.status_code === 401 && data.message.length != 0) {
              document.getElementById('alert').innerHTML = data.message
              document.getElementById('alert').classList.remove('d-none')
            }
            if(data.errors !== null) {
              if(data.errors.email !== undefined) {
                document.getElementById('email').classList.add('is-invalid')
                document.getElementById('email-error').classList.remove('d-none')
                document.getElementById('email-error').innerHTML = data.errors.email[0]
              }
              if(data.errors.password !== undefined) {
                document.getElementById('password').classList.add('is-invalid')
                document.getElementById('password-error').classList.remove('d-none')
                document.getElementById('password-error').innerHTML = data.errors.password[0]
              }
            } else {
              localStorage.setItem("isAuth", 1)
              localStorage.setItem("api_token",data.data.api_token)
  
              window.location.href = "/todos";
            }
          })
          .catch((error) => {
            console.error('Error:', error)
          })
        })
      }
    </script>
@endsection
@section('script-header')
    <script>
      if(localStorage.getItem("api_token") != null ) {
        window.location.href = "/todos";
      } 
    </script>
@endsection