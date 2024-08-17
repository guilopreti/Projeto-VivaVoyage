const username = window.localStorage.getItem("usuario");
if (username) {
  const usernameSpan = document.querySelector(".loginLabel");
  usernameSpan.innerHTML = `Olá ${username} <a onclick="logout()">(Sair)</a>`;
  usernameSpan.parentElement.href = "#";
}

function logout() {
  window.localStorage.removeItem("usuario");
  location.href = "/index.html";
}
