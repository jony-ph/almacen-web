const userForm = document.querySelector('#user-update-form');
const userName = document.querySelector('#user-name');
const userUser = document.querySelector('#user-user');
const userEmail = document.querySelector('#user-email');
const userImage = document.querySelector('#user-image');

let sessionFullname = document.querySelector('#session-fullname').value;
let sessionUsername = document.querySelector('#session-username').value;
let sessionEmail = document.querySelector('#session-email').value;
let sessionImage = document.querySelector('#session-image').value;

const modalInstance = document.querySelector('[data-bs-target="#update-user-modal"]');

const userCode = document.querySelector('[name="user-update"]').id;
const image = document.querySelector('#image-btn');
const imageBox = document.querySelector('#hover');

let file;

eventListeners();
function eventListeners() { 

    modalInstance.addEventListener('click', () => {
        userName.value = sessionFullname;
        userUser.value = sessionUsername;
        userEmail.value = sessionEmail;
        userImage.value = '';
        image.src = sessionImage;
    });
    userForm.addEventListener('submit', updateUserData);
    imageBox.addEventListener('click', (e) => {
        e.preventDefault();
        userImage.click();
    });
    userImage.addEventListener('change', uploadfiles);
}

function updateUserData(e) {

    e.preventDefault();

    const userData = new FormData(userForm);
    const fullname = userData.get('user-name');
    const username = userData.get('user-user');
    const email = userData.get('user-email');

    if (!validationUserFields(fullname, username, email)) {
        return;
    }

    const url = `API/sessions/update.php?id=${userCode}`;
    let options = {
        method: 'POST',
        body: userData
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => response.json(response) )
            .then( data => console.log(data) )
            .catch( error => console.log(error) );

    }

    clearUserFields();
    
}

function validationUserFields(fullname, username, email){

    if( fullname === '' || username === '' || email === ''){
        alert("¡Debe llenar todos los campos!");
        return false;
    }

    return true;

}

function uploadfiles(e) {   
    e.preventDefault();
    file = userImage.files[0];
    processfile(file);
}

function processfile(file) {
    const docType = file.type;
    const validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if ( validExtensions.includes(docType) ){
        const fileReader = new FileReader();

        fileReader.addEventListener('load', (e) => {

            e.preventDefault();

            const fileUrl = fileReader.result;
            image.src = fileUrl;
        });

        fileReader.readAsDataURL(file);
    } else {
        alert("No es un archivo válido");
        userImage.value = '';
    }
}

function clearUserFields() {
    userName.value = '';
    userUser.value = '';
    userEmail.value = '';
    userImage.value = '';
}