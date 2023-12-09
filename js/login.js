async function login(event) {
  event.preventDefault()

  const form = document.getElementById('login')
  const formData = new FormData(form)

  const req = await fetch("backend/formsController.php", {
    method: 'POST',
    body: formData,
  })

  if (!req.ok) {
    const errorDiv = document.querySelector('.errorDiv')
    errorDiv.innerHTML = '<p class="text-danger">E-mail ou senha inválidos</p>'
    return
  }

  const response = await req.json()
  window.localStorage.setItem('usuario', response.nome)
  location.href = '/modelo.html'
}
