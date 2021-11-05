@extends('layouts.app')
@section('title') Todos app @endsection
@section('css-header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection
@section('content')
  <div class="container pt-5">
    @include('../components/navbar')
    <div class="justify-content-center">
      <div class="pt-5">
       <h5>Todos logs</h5>
       <div class="card">
        <div class="card-body">
          <table id="logsTable" class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>UserID</th>
                <th class="text-nowrap">User Name</th>
                <th class="text-nowrap">Todo Id</th>
                <th class="text-nowrap">Todo Title</th>
                <th class="text-nowrap">Last Update</th>
                <th>Action/Method</th>
              </tr>
            </thead>
          </table>
        </div>
       </div>
     </div>
    </div>
  </div>
  @include('../components/addModal')
@endsection
@section('script-header')
    <script src="{{asset('js/auth.js')}}"></script>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
  const token = localStorage.getItem("api_token")
//   // get get logs
  // fetch('/v1/todo/logs/views', {
  //   method: 'GET',
  //   headers: {
  //     'Content-Type': 'application/json',
  //     'Authorization': `Bearer ${token}`
  //   },
  //   mode: 'cors'
  // })
  // .then(response => response.json())
  // .then((res) => {
  //   const tableBody = document.querySelector('tbody')
  //   res.data.forEach(data => {
  //    console.log(data)
  //   tableBody.innerHTML  += `<tr>
  //     <td>${data.id}</td>
  //     <td>${data.userName}</td>
  //     <td>${data.title}</td>
  //     <td>${data.updated_at}</td>
  //     <td>${data.action}</td>
  //     </tr>`;
  //  });
  // })
  // .catch(error => console.error(error))
  // end get todos
  $(document).ready(function() {
    $('#logsTable').DataTable({
      ajax: {
        url: "v1/todo/logs/views",
        headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        },
      },
      columns: [
        {"data": "id"},
        {"data": "user_id"},
        {"data": "userName"},
        {"data": "todo_id"},
        {"data": "title"},
        {"data": "created_at"},
        {"data": "action"}
      ]
    })

  });
// add todo
  </script>
  <script src="{{asset('/js/todo.js')}}"></script>
  
@endsection