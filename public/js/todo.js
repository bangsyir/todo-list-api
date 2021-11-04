// display value todo to modal
function updateTodoBtn(id, title, description) {
  document.getElementById('update-id').value = id
  document.getElementById('update-title').value = title
  document.getElementById('update-description').value = description
}

function deteTodoBtn(id) {
  const deleteId = {id: id}
  fetch(`v1/todo/${id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    mode: 'cors',
    body: JSON.stringify(deleteId)
  })
  .then(response => response.json())
  .then((res) => {
    alert('Todo is successfull removed')
    if(res.status == "success") {
      window.location.href = '/todos'
    }
  })
}

// create todo
const addForm = document.getElementById('addTodoForm')
if(addForm) {
  addForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const title = document.getElementById('title')
    const description = document.getElementById('description')

    const data = {title: title.value, description: description.value}
    fetch('v1/todo/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      mode: 'cors',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then((res) => {
      if(res.status == "error") {
        if(res.message.title !== undefined) {
          title.classList.add('is-invalid')
          document.getElementById('title-error').classList.remove('d-none')
          document.getElementById('title-error').innerHTML = res.message.title[0]
        }
        if(res.message.description !== undefined) {
          description.classList.add('is-invalid')
          document.getElementById('description-error').classList.remove('d-none')
          document.getElementById('description-error').innerHTML = res.message.description[0]
        }
        if(res.code == 401) {
          document.getElementById('limitAlertSuccess').classList.remove('d-none')
          document.getElementById('limitAlertSuccess').innerHTML = res.message + ' '+'Please upgrade your <a href="/plan">Plan</a>.'

        }
      } else {
        const successAlert = document.getElementById('addAlertSuccess')
        successAlert.classList.remove('d-none')
        successAlert.innerHTML = "todo update is successfull"
        setTimeout(() => {
          window.location.href = '/todos'
        }, 2000)
      }
    })    
    .catch(error => console.error(error))
  })
}

// update todo
const updateForm = document.querySelector('#updateTodoForm')
if(updateForm) {
  updateForm.addEventListener("submit", (e) => {
    e.preventDefault()
    console.log('update')
    const id = document.getElementById('update-id')
    const title = document.getElementById('update-title')
    const description = document.getElementById('update-description')
    console.log(id.value)
    const data = {title: title.value, description: description.value}
    fetch(`v1/todo/${id.value}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      mode: 'cors',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then((res)=> {
      if(res.status == "error") {
        if(res.message.title !== undefined) {
          title.classList.add('is-invalid')
          document.getElementById('title-error').classList.remove('d-none')
          document.getElementById('title-error').innerHTML = res.message.title[0]
        }
        if(res.message.description !== undefined) {
          description.classList.add('is-invalid')
          document.getElementById('description-error').classList.remove('d-none')
          document.getElementById('description-error').innerHTML = res.message.description[0]
        }
      } else {
        const successAlert = document.getElementById('updateAlertSuccess')
        successAlert.classList.remove('d-none')
        successAlert.innerHTML = "todo update is successfull"
        setTimeout(() => {
          window.location.href = '/todos'
        }, 2000)
      }
    })
    .catch(error => console.error(error))
  })
}