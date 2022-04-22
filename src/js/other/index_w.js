import * as UI from '../interface.js';

let record_list = [];
let category_list = [];

const addProductBtn = document.querySelector('[data-bs-target="#modal-new-product"]');
const modalUpdateProduct = document.querySelector('#modal-update-record');
const modalProduct = document.querySelector('#modal-new-product');

eventListeners();
function eventListeners() {

    document.addEventListener('DOMContentLoaded', () => {
        UI.categoryForm.remove();
        addProductBtn.parentNode.remove();
        modalProduct.remove();
        modalUpdateProduct.remove();

        requestApiTables('show.php');
        requestApiCategories();
    });

    UI.navCategories.addEventListener('click', showTableCategory);
    UI.productForm.addEventListener('submit', addNewProduct);
    UI.categoryForm.addEventListener('submit', addNewCategory);
    UI.searchForm.addEventListener('submit', searchRecord);
    UI.outputForm.addEventListener('submit', addOutput);
    UI.entryForm.addEventListener('submit', addEntry);
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

function addNewProduct(e) {

    e.preventDefault();

    let productData = new FormData(UI.productForm);
    const url = 'API/stock/add.php';

    if(!validationFields(productData)) {
        return;
    }

    const options = {
        method: 'POST',
        body: productData
    }
    
    fetch(url, options)
        .then( (response) => {
            requestApiTables('show.php'); 
            return response.json();
        })
        .then( data => console.log(data))
        .catch( error => console.log(error) );

    UI.codeProduct.value = '';
    UI.nameProduct.value = '';
    UI.descriptionProduct.value = '';
    UI.categoryProduct.value = '';

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

function addNewCategory(e) {
    
    e.preventDefault();

    let categoryData = new FormData(UI.categoryForm);
    const categoryRecord = categoryData.get('category');

    if( categoryRecord === '' ) {
        alert('Debes ingresar la categoría!');
        return;
    }

    let exist = false;
    category_list.forEach( object => {

        const { category } = object;
        if(category === categoryRecord){
            exist = true;
            return;
        }

    });

    if(exist){
        alert("Esa categoria ya existe!");
        UI.newCategory.value = '';
        return;
    }

    const url = 'API/categories/add.php';
    const options = {
        method: 'POST',
        body: categoryData
    }

    fetch(url, options)
        .then( response => response.json() )
        .then( data => requestApiCategories() )
        .catch( error => console.log(error) );

    UI.newCategory.value = '';

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

    // Entradas
function addEntry(e) {

    e.preventDefault();

    let entryData = new FormData(UI.entryForm);
    const url = 'API/entrys/add.php';
    const options = {
        method: 'POST',
        body: entryData
    };


    fetch(url, options)
        .then( response => response.json() )
        .then( data => {
            requestApiTables('show.php');
        })
        .catch( error => console.log(error) );

    UI.productEntry.value = '';
    UI.amountEntry.value = '';
    UI.deliveredEntry.value = '';
}

    // Salidas
function addOutput(e){
    e.preventDefault();

    let outputData = new FormData(UI.outputForm);
    const url = 'API/outputs/add.php';
    const options = {
        method: 'POST',
        body: outputData
    };


    fetch(url, options)
        .then( response => response.json() )
        .then( data => {
            requestApiTables('show.php');
        })
        .catch( error => console.log(error) );

    UI.amountOutput.value = '';
    UI.recivedOutput.value = '';
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

        const td = document.createElement('td');

        const deliveryButton = document.createElement('button');
        deliveryButton.classList.add('btn', 'btn-outline-warning');
        deliveryButton.setAttribute('data-bs-toggle', 'modal');
        deliveryButton.setAttribute('data-bs-target', '#modal-delivery');
        deliveryButton.textContent = 'Entregar';
        deliveryButton.onclick = function() {
            UI.productOutput.value = product_code;
        };

        td.appendChild(deliveryButton);
        row.appendChild(td);

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