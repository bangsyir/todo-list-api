// set idle parameter to localStorage
// localStorage.setItem('api_token', '')
// localStorage.setItem('isAuth', 0)

const logout = document.getElementById('logout')

logout.addEventListener("click",(e) => {
  e.preventDefault();
  const token = localStorage.getItem('api_token')
  console.log(token)
  fetch('/v1/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    }
  })
  .then(response => response.json())
  .then((result) => {
    localStorage.removeItem('api_token')
    localStorage.removeItem('isAuth')

    window.location.href = "/login";
  })
})