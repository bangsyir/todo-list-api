@extends('layouts.app')
@section('title') login @endsection
@section('content')
  <div class="container pt-5">
    @include('../components/navbar')
    <div class="justify-content-center">
     <div class="pt-5">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A list item
          <span class="badge badge-primary badge-pill">14</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A second list item
          <span class="badge badge-primary badge-pill">2</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A third list item
          <span class="badge badge-primary badge-pill">1</span>
        </li>
      </ul>
     </div>
    </div>
  </div>
@endsection
@section('script-header')
    <script>
      const token = localStorage.getItem("api_token")
      console.log(token)
        if(localStorage.getItem("api_token") == null ) {
          window.location.href = "/login";
        }
    </script>
@endsection