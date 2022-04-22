import * as UI from '../interface.js';

let record_list = [];
let category_list = [];

const addProductBtn = document.querySelector('[data-bs-target="#modal-new-product"]');
const modalUpdateProduct = document.querySelector('#modal-update-record');
const modalProduct = document.querySelector('#modal-new-product');
const modalOutput = document.querySelector('[data-bs-target="#modal-add-record"]')

eventListeners();
function eventListeners() {

    document.addEventListener('DOMContentLoaded', () => {
        UI.categoryForm.remove();
        addProductBtn.parentNode.remove();
        modalProduct.remove();
        modalUpdateProduct.remove();
        modalOutput.parentNode.remove();

        requestApiTables('show.php');
        requestApiCategories();
    });

    UI.navCategories.addEventListener('click', showTableCategory);
    UI.searchForm.addEventListener('submit', searchRecord);
}


// Peticiones

    // Productos
function requestApiTables(file) {

    const url = `API/stock/${file}`;

    fetch(url)
    .then( result => result.json() )
    .then( data => {
        record_list = data;
        updateTable();

        while ( UI.productEntry.firstChild ) {
            UI.productEntry.removeChild(UI.productEntry.firstChild);
        }

        const voidOption = document.createElement('option');
        voidOption.value = '';
        voidOption.innerHTML = 'Seleccionar';

        UI.productEntry.appendChild(voidOption);

        record_list.forEach( record => {
            const { product_code, name, description } = record;

            let option = document.createElement('option');
            option.value = product_code;
            option.innerHTML = name + ' - ' + description;

            UI.productEntry.appendChild( option );
        });
    })
    .catch( error => console.log(error) );

}

    // Categorías
function requestApiCategories() {

    const url = 'API/categories/show.php';

    fetch(url)
        .then( result => result.json() )
        .then( data => {
            category_list = data;
            updateNavCategories();
            addOptionsToSelect();
        })
        .catch( error => console.log(error) );

}

    // Buscador
function searchRecord(e){
    e.preventDefault();

    const searchData = new FormData(UI.searchForm);
    const text = searchData.get('search').toLocaleLowerCase()
 
    const url = `show.php?product=${text}`;
    requestApiTables(url);

    UI.searchField.value = '';
}

// Funciones
function validationFields(form) {

    let validation = false;

    if ( form.get('new-product-code') === '' || form.get('new-product-name') === '' || form.get('new-product-description') === '' || form.get('new-product-category') === ''){
        alert("Debe llenar todos los campos!");
    } else {
        validation = true;
    }

    return validation;
}

function updateTable() {
    clearTableProducts();

    record_list.forEach( record => {
        const {product_code, name, description,  amount, category, category_code} = record;
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${product_code}</td>
            <td>${name}</td>
            <td>${description}</td>
            <td>${category}</td>
            <td>${amount}</td>
        `;

        UI.recordsTable.appendChild(row);
    });

}

function addOptionsToSelect(){

    while( UI.categoryProduct.firstChild ){
        UI.categoryProduct.removeChild(UI.categoryProduct.firstChild);
    }

    while( UI.categoryUpdate.firstChild ){
        UI.categoryUpdate.removeChild(UI.categoryUpdate.firstChild);
    }

    const voidOption = document.createElement('option');
    voidOption.value = '';
    voidOption.innerHTML = 'Seleccionar';

    UI.categoryProduct.appendChild(voidOption);

    category_list.forEach( obj =>  {
    
        const { category_code, category } = obj;
        let optionRegister = document.createElement('option');
        optionRegister.value = category_code;
        optionRegister.innerHTML = category;

        UI.categoryProduct.appendChild(optionRegister);

        let optionUpdate = document.createElement('option');
        optionUpdate.value = category_code;
        optionUpdate.innerHTML = category;
        
        UI.categoryUpdate.appendChild(optionUpdate);

    })
}

function clearTableProducts() {
    while (UI.recordsTable.firstChild) {
        UI.recordsTable.removeChild(UI.recordsTable.firstChild)
    }
}

function updateNavCategories() {
    
    clearNavCategories();
    UI.navCategories.innerHTML = `
        <a id="0" class="list-group-item list-group-item-action active" href="#">Todo</a>
    `;

    category_list.forEach( item => {

        const { category_code, category } = item;

        const hyperlink = document.createElement('a');

        hyperlink.textContent = category;
        hyperlink.id = category_code;
        hyperlink.classList.add('list-group-item', 'list-group-item-action');
        hyperlink.href = '#';

        UI.navCategories.appendChild(hyperlink);
    });

}

function clearNavCategories() {
    while (UI.navCategories.firstChild) {
        UI.navCategories.removeChild(UI.navCategories.firstChild);
    }
}

function showTableCategory(e) {
    
    e.preventDefault();

    addCategoryClass(e.target);

    UI.title.textContent = e.target.textContent;

    console.log(e.target.id)

    if(e.target.id === '0'){
        const url = 'show.php';
        requestApiTables(url);  
    } else {
        const url = `show.php?id=${e.target.id}`;
        requestApiTables(url);
    }

}

// Agregar clase de activación
function addCategoryClass(selectedCategory) {

    selectedCategory.classList.add('active');
    let category = UI.navCategories.children;

    for(let i=0; i < category.length; i++){
        if(category[i].classList.contains('active') && category[i] != selectedCategory){
            category[i].classList.remove('active');
        }
    }

}