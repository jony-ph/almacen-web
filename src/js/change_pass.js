import Alert from "./alerts.js";

const changePassForm = document.querySelector('#change-password');

eventListener();
function eventListener() {
    changePassForm.addEventListener('submit', changePass);
}

function changePass(e) {

  e.preventDefault();

  const resetData = new FormData(changePassForm);

  const url = 'API/sessions/reset_pwd.php';
  const options = {
      method: 'POST',
      body: resetData
  }

  fetch(url, options)
      .then( response => response.json() )
      .then( data => {
          console.log(data)
          redirectIndex(data)
      })
      .catch( err => console.log(err) )

}

function redirectIndex(data) {
    
    const { status, code, message } = data;

    if ( code === 201 &&  status === 'success' && message === "Verificación válida" ) {
        window.location.replace("index.php");
    } else if ( code === 201 &&  status === 'success' && message === "Las contraseñas no coinciden" ){
        const alert = new Alert(message, 'danger', loginForm);
        alert.showAlert();
    } else {
        const alert = new Alert("Error, pasó algo inesperado", 'danger', loginForm);
        alert.showAlert();
    }

}