const current_loc = window.location.href

const logout = document.getElementById('logout')
if(logout) {
  logout.addEventListener("click",(e) => {
    e.preventDefault();
    const token = localStorage.getItem('api_token')
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
}