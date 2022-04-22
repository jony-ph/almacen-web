const tableUsers = document.querySelector('#table-users tbody');

const register = document.querySelector('#user-form');
const dropArea = document.querySelector('#drop-area');
const btnImage = document.querySelector('#btn-image');
const inputImg = document.querySelector('#image');
const dropTitle = document.querySelector('#drop-title');
const preview = document.querySelector('#preview');

const btnDeleteFile = document.querySelector('#reset-file');

// Inputs
const username = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#psdw');
const privilegeSelect = document.querySelector('#privilege');

let usersList = [];
let privilegesList = [];
let files;

eventListeners();
function eventListeners(){

    document.addEventListener('DOMContentLoaded', () => {
        showUsers();
        showPrivileges();
    });
    register.addEventListener('click', registerNewUser);

    btnImage.addEventListener('click', (e) => {
        e.preventDefault();
        if(e.target.id === 'btn-image'){
            inputImg.click();
        }
    });

    inputImg.addEventListener('change', uploadfiles);
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('active');
        dropTitle.textContent = "Suelta para subir archivo";
    });
    dropArea.addEventListener('dragleave', (e) => {
        e.preventDefault()
        dropArea.classList.remove('active');
        dropTitle.textContent = "Arrastra y suelta imágen";
    });
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault()
        files = e.dataTransfer.files[0];
        processfiles(files);
        dropArea.classList.remove('active');
        dropTitle.textContent = "Arrastra y suelta imágen";
    });
}

// Peticiones
    // Usuarios
function showUsers(){

    const url = 'API/sessions/show.php';
    fetch(url)
        .then( response => response.json() )
        .then( data => {
            usersList = data;
            updateUsersTable();
        })
        .catch( error => console.log(error) );

}


function registerNewUser(e){

    if( !(e.target.id === 'register') ){
        return;
    }

    e.preventDefault();

    const userData = new FormData(register);
    const url = `API/sessions/register.php`;

    userData.append('file', files);

    if(!validationFields()) {
        return;
    }

    const options = {
        method: 'POST',
        body: userData,
    }

    fetch(url, options)
        .then( response => response.json() )
        .then( () => showUsers() )
        .catch( error => console.log(error) );

    clearFields();
}

    // Privilegios
function showPrivileges(){

    const url = 'API/privileges/show.php';
    fetch(url)
        .then( response => response.json() )
        .then( data => {
            privilegesList = data;
            while (privilegeSelect.firstChild){
                privilegeSelect.removeChild(privilegeSelect.firstChild);
            }

            const voidOption = document.createElement('option');
            voidOption.value = '';
            voidOption.innerHTML = 'Selecciona';

            privilegeSelect.appendChild(voidOption);

            privilegesList.forEach( pvg => {

                const {privilege_code, privilege} = pvg;

                let option = document.createElement('option');
                option.value = privilege_code;
                option.innerHTML = privilege;

                privilegeSelect.appendChild(option);

            });
        })
        .catch( error => console.log(error) );

}


// Drag and drop
function uploadfiles() {   
    files = inputImg.files[0];
    dropArea.classList.add('active');
    processfiles(files);
    dropArea.classList.remove('active');
}

function processfiles(file) {
    const docType = file.type;
    const validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if ( validExtensions.includes(docType) ){
        const fileReader = new FileReader();

        fileReader.addEventListener('load', e => {
            const fileUrl = fileReader.result;

            preview.classList.add('mt-3');
            preview.innerHTML = `
                <img src="${fileUrl}" alt="${file.name}" width="100">
                <span>${file.name}</span>
                <button type="button" id="reset-file" class="btn-close float-end"></button>
            `;
            preview.onclick = function(e) {
                if(e.target.id === 'reset-file') {
                    resetInputFile();
                }
            }

        });

        fileReader.readAsDataURL(file);
    } else {
        alert("No es un archivo válido");
        resetInputFile();
    }
}

// Table usuarios
function updateUsersTable() {
    
    clearUsersTable();
    usersList.forEach( user => {

        const {user_code, fullname, username, email, privilege} = user;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user_code}</td>
            <td>${fullname}</td>
            <td>${username}</td>
            <td>${email}</td>
            <td>${privilege}</td>
        `;

        const td = document.createElement('td');
        const buttonDelete = document.createElement('button');
        buttonDelete.classList.add('btn', 'btn-link');
        buttonDelete.innerHTML = `Eliminar <i class="fa fa-times-circle"></i>`;
        buttonDelete.onclick = function() {
            deleteUser(user_code);
        };

        td.appendChild(buttonDelete);
        row.appendChild(td);
        tableUsers.appendChild(row);

    });


}

function deleteUser(user_code) {
    
    const answer = confirm('¡Eliminará todo lo relacionado al usuario!');

    if(answer) {

        const url = `API/sessions/delete.php?id=${user_code}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                showUsers();
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }

}

function clearUsersTable() {
    while ( tableUsers.firstChild ) {
        tableUsers.removeChild(tableUsers.firstChild);
    }
}

// Validaciones 
function validationFields(){

    if( username.value === '' || email.value === '' || password.value === '' || privilege.value === ''){
        alert("¡Debes llenar todos los campos!");
        return false;
    }

    return true;

}

function clearFields() {
    username.value = '';
    email.value = '';
    password.value = '';
    privilegeSelect.value = '';
    inputImg.value = '';
    preview.innerHTML = '';
}

function resetInputFile(){
    inputImg.value = '';
    preview.innerHTML = '';
}
