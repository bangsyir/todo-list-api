@extends('layouts.app')
@section('title') login @endsection
@section('content')
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <span class="font-weight-bold">Login</span>
          </div>
          <div class="card-body">
            <form action="#" method="post" id="loginForm">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="input email">
                <small id="email-error" class="text-danger d-none">
                  Looks good!
                </small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="input password">
                <small id="password-error" class="text-danger d-none">
                  Looks good!
                </small>
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
      const form = document.getElementById('loginForm')
      form.addEventListener("submit", (e) => {
        e.preventDefault();

        const name = document.querySelector('#email').value;
        const password = document.querySelector('#password').value;
      })
    </script>
@endsection