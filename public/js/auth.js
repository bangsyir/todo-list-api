if(localStorage.getItem("api_token") == null ) {
  window.location.href = "/login";
}

fetch('v1/user', {
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`
  },
  mode: 'cors'
})
.then(response => response.json())
.then((res) => {
  if(res.status == "error") {
    localStorage.removeItem('api_token')
    window.location.href = "/login";
  }
})