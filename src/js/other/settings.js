const passwordForm = document.querySelector('#update-password-form');
const currentPassword = document.querySelector('#current-password');
const newPassword = document.querySelector('#new-password');
const confirmPassword = document.querySelector('#confirm-password');

const tablePrivileges = document.querySelector('#table-privileges tbody');
const privilegeFormUpdate = document.querySelector('#update-privilege-form');
const privilegePrivilegeUpdate = document.querySelector('#privilege-update');
const privilegeDescriptionUpdate = document.querySelector('#description-privilege-update');

const privilegeFormAdd = document.querySelector('#add-privilege-form');
const privilegePrivilegeAdd = document.querySelector('#privilege-add');
const privilegeDescriptionAdd = document.querySelector('#description-privilege-add');

const buttonNewPrivilege = document.querySelector('[data-bs-target="#add-privilege-modal"]');

let privilegesList = [];
let updatePrivilegeID = null;

eventListeners();
function eventListeners() {
    document.addEventListener('DOMContentLoaded', () => {
        showPrivileges();
        buttonNewPrivilege.remove();
    })
    passwordForm.addEventListener('submit', updatePassword);
    privilegeFormAdd.addEventListener('submit', newPrivilege);
    privilegeFormUpdate.addEventListener('submit', updatePrivilege);
}

function updatePassword(e) {

    e.preventDefault();

    const passwordData = new FormData(passwordForm);

    if ( !validatePasswordFields() ){
        return;
    }

    const url = `API/sessions/update_pwd.php?id=${userCode}`; 
    const options = {
        method: 'POST',
        body: passwordData
    };

    fetch(url, options)
        .then( response => response.json() ) 
        .then( data => console.log(data) )
        .catch( error => console.log(error))

    clearPasswordFields();
}

function validatePasswordFields() {
    
    if ( currentPassword.value == '' || newPassword.value == '' || confirmPassword.value == '' ) {
        alert('¡Debes llenar todos los campos!');
        return false;
    }
    return true;

}

function clearPasswordFields() {
    currentPassword.value = '';
    newPassword.value = '';
    confirmPassword.value = '';
}

// Privilegios
function showPrivileges(){

    const url = 'API/privileges/show.php';
    fetch(url)
        .then( response => response.json() )
        .then( data => {
            privilegesList = data;
            updatePrivilegesTable();
        })
        .catch( error => console.log(error) );

}

// Table Privilegios
function updatePrivilegesTable(){

    clearPrivilegesTable();
    privilegesList.forEach( pvg => {

        const {privilege_code, privilege, description} = pvg;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${privilege}</td>
            <td>${description}</td>
        `;

        tablePrivileges.appendChild(row);

    });
}

function clearPrivilegesTable() {
    while (tablePrivileges.firstChild){
        tablePrivileges.removeChild(tablePrivileges.firstChild);
    }
}

function newPrivilege(e) {

    e.preventDefault();

    let privilegeData = new FormData(privilegeFormAdd);
    const url = 'API/privileges/add.php';

    const options = {
        method: 'POST',
        body: privilegeData
    }
    
    fetch(url, options)
        .then( (response) => {
            showPrivileges();
            return response.json();
        })
        .then( data => console.log(data))
        .catch( error => console.log(error) );

    privilegePrivilegeAdd.value = '';
    privilegeDescriptionAdd.value = '';

}

function updatePrivilege(e) {
    
    e.preventDefault();

    console.log(updatePrivilegeID)

    let updateData = new FormData(privilegeFormUpdate);
    const url = `API/privileges/update.php?id=${updatePrivilegeID}`;

    const privilege = updateData.get('privilege-update');
    const description = updateData.get('description-privilege-update');

    const options = {
        method: 'PUT',
        body: JSON.stringify({
            privilege,
            description
        }) // No se puede trabajar con objetos multipart/form-data
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => {
                showPrivileges();
                return response.json(response);
            })
            .then( data =>  {
                console.log(data)
            })
            .catch( error => console.log(error) );

    }
}

function deletePrivilege(privilege_code) {
    
    const answer = confirm('¡Eliminará todo lo relacionado a este privilegio!');

    if(answer) {

        const url = `API/privileges/delete.php?id=${privilege_code}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                showPrivileges();
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }

}