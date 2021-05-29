const form = document.querySelector("#loginform");
const mensaje = document.querySelector("#mensaje");
form.addEventListener("submit", login);

function login(e) {
  e.preventDefault();
  let API = new Api();
  const formdata = new FormData(form);
  API.validarLogin(formdata)
    .then((data) => {
      if (data.success) {
        window.location = data.link;
      } else {
        mensaje.textContent = data.msg;
        mensaje.classList.remove("d-none");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
