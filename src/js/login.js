const loginForm = document.querySelector('#login-form');
const alertLogin = document.querySelector('#login-alert')
const inputUser = document.querySelector('#user');

eventListener();
function eventListener() {

    document.addEventListener('DOMContentLoaded', () => {
        inputUser.focus();
    });
    loginForm.addEventListener('submit', login);
}

function login(e) {

    e.preventDefault();

    const loginData = new FormData(loginForm);

    const url = 'API/sessions/login.php';
    const options = {
        method: 'POST',
        body: loginData
    }

    fetch(url, options)
        .then( response => response.json() )
        .then( data => {
            console.log(data)
            validateLogin(data);
        })
        .catch( err => console.log(err) )
    
}

function validateLogin(data) {

    const { status, code, message } = data;

    if ( code === 200 &&  status === 'success' && message === "Sesión iniciada") {
        window.location.replace("index.php");
    } else {

        alertLogin.innerHTML = `
            <button type="button" id="close-alert" class="btn-close float-end"></button>
            <strong>¡Error!</strong> ${message} 
        `;
        alertLogin.onclick = function(e) {
            if (e.target.id == 'close-alert') {
                alertLogin.hidden = true;
            }   
        }
        alertLogin.hidden = false;
    }

}