@extends('layouts.app')
@section('title') Todos app @endsection
@section('content')
  <div class="container pt-5">
    @include('../components/navbar')
    <div class="justify-content-center">
     <div class="pt-5">
      <div class="list-group">
      </div>
     </div>
    </div>
  </div>
  @include('../components/addModal')
  @include('../components/updateModal')
  @include('../components/reminderModal')
@endsection
@section('script-header')
    <script>
      const token = localStorage.getItem("api_token")
    </script>
    <script src="{{asset('js/auth.js')}}"></script>
@endsection
@section('script')
<script>
  // get get todos
  fetch('/v1/todo', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    mode: 'cors'
  })
  .then(response => response.json())
  .then((result) => {
    const listGroup = document.querySelector('.list-group')
    result.data.forEach((data, index)=> {
        listGroup.innerHTML += `
        <a href="#" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">${data.title}</h5>
            <div>
              <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#updateModal" onClick="updateTodoBtn(${data.id}, '${data.title}', '${data.description}')">Update</button>
              <button class="btn btn-danger btn-sm" id="delete" onClick="return confirm('are you sure want to delete?') ? deteTodoBtn(${data.id}) : ''">Del</button>
              <button class="btn btn-primary btn-sm" id="reminder" type="button" data-toggle="modal" data-target="#reminderModal" onClick="setReminderBtn(${data.id})">Reminder</button>
            </div>
          </div>
          <p class="mb-1">${data.description}</p>
          <small>${data.created_at}</small>
        </a>
        `
    });
  })
  .catch(error => console.error(error))
  // end get todos

  // reminder function
  reminderBtn = (id) => {
    alert(id)
  }

  // add todo
</script>
<script src="{{asset('/js/todo.js')}}"></script>
@endsection
