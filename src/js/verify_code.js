import Alert from "./alerts.js";

const codeForm = document.querySelector('#verify-code');
const email = document.querySelector('#email').value;
const token = document.querySelector('#token').value;

eventListener();
function eventListener() {
    codeForm.addEventListener('submit', verifyToken);
}

function verifyToken(e) {

  e.preventDefault();

  const verifyData = new FormData(codeForm);

  const url = 'API/sessions/verify_token.php';
  const options = {
      method: 'POST',
      body: verifyData
  }

  fetch(url, options)
      .then( response => response.json() )
      .then( data => {
          console.log(data)
          redirectChangePass(data)
      })
      .catch( err => console.log(err) )

}

function redirectChangePass(data) {
    
    const { status, code, message } = data;

    if ( code === 200 &&  status === 'success' && message === "Verificación válida") {
        window.location.replace("reset_password.php?email=" + email + "&token=" + token);
    } else {
        const alert = new Alert("Acceso denegado", 'danger', loginForm);
        alert.showAlert();
    }

}