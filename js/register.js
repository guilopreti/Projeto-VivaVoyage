async function register(event) {
  event.preventDefault()

  const form = document.getElementById('register')
  const formData = new FormData(form)
  const camposRequeridos = []

  formData.forEach((value, key) => {
    if ( value.trim() == '')
     camposRequeridos.push(key)
  })

  if ( camposRequeridos.length > 0 ) {
    const divCamposRequeridos = document.querySelector('.required-fields')
    divCamposRequeridos.innerHTML = ''
    camposRequeridos.forEach(campo => {
      divCamposRequeridos.innerHTML += `<p class="text-danger font-weight-bold mb-2">O campo ${campo} não pode ser nulo.</p>`
    })

    return
  }

  const req = await fetch("backend/formsController.php", {
    method: 'POST',
    body: formData,
  })

  if (req.ok) {
    location.href = '/login.html'
  }
}
