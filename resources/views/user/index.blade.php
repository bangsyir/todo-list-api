@extends('layouts.app')
@section('title') Todos app @endsection
@section('content')
  <div class="container pt-5">
    @include('../components/navbar')
    <div class="row justify-content-center">
     <div class="pt-5 col-6">
      <div class="card">
        <div class="card-body">
          <div class="alert alert-success d-none" id="alertSuccess"> </div>
          <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" disabled>
          </div>
          <hr>
          <form action="/todos" method="PUT" id="updatePlan">
            <div class="form-group">
              <label for="plane">plane</label>
              <select name="plan" id="plan" class="form-control">
                <option value="FREE">FREE</option>
                <option value="PREMIUM">PREMIUM</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Plan</button>
          </form>
        </div>
      </div>
     </div>
    </div>
  </div>
@endsection
@section('script-header')
    <script src="{{asset('js/auth.js')}}"></script>
@endsection
@section('script')
<script>
  const token = localStorage.getItem("api_token")
  // get get todos
  fetch('/v1/user', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    mode: 'cors'
  })
  .then(response => response.json())
  .then((res) => {
      const name = document.getElementById('name')
      const email = document.getElementById('email')
      const phone = document.getElementById('phone')
      const plane = document.getElementById('plane')

      name.value = res.data.name
      email.value = res.data.email
      phone.value = res.data.phone
      plan.value = res.data.type
  })
  .catch(error => console.error(error))
  // end get todos
  const updatePlan = document.getElementById('updatePlan')

  updatePlan.addEventListener('submit', (e) => {
    e.preventDefault();

    const plan = document.querySelector('#plan').value;
    const data = {type: plan}
    fetch('v1/plan/update', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      mode: 'cors',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then((res) => {
      console.log(res)
      const alert = document.getElementById('alertSuccess')
      if(res.status == "success") {
        alert.classList.remove('d-none')
        alert.innerHTML = res.message
      }
      setTimeout(() => {
        window.location.href = '/todos'
      }, 1000);
    })
  })
</script>
@endsection