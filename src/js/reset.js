const resetForm = document.querySelector('#reset-pass-form');
const inputEmail = document.querySelector('#email-reset');

eventListener();
function eventListener() {
    document.addEventListener('DOMContentLoaded', () => {
        inputEmail.focus();
    });
    resetForm.addEventListener('submit', reset);
}

function reset(e) {

  e.preventDefault();

  const resetData = new FormData(resetForm);

  const url = 'API/sessions/token.php';
  const options = {
      method: 'POST',
      body: resetData
  }

  fetch(url, options)
      .then( response => response.json() )
      .then( data => {
          console.log(data)
      })
      .catch( err => console.log(err) )

}