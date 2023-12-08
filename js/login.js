async function login() {
  const form = document.getElementById('login')
  const formData = new FormData(form)

  const req = await fetch("backend/formsController.php", {
    method: 'POST',
    body: formData,
  })
  console.log(req, 'req')

  if (req.ok) {
    const response = await req.json()
    window.localStorage.setItem('usuario', response.nome)
    location.href = '/modelo.html'
  }
}
