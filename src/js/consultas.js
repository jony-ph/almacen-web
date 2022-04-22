import * as UI from './interface.js';

let record_list = [];
let category_list = [];
let updateProductID = null;
let updateCategoryID = null;

eventListeners();
function eventListeners() {

    document.addEventListener('DOMContentLoaded', () => {
        requestApiTables('show.php');
        requestApiCategories();
    });

    UI.navCategories.addEventListener('click', showTableCategory);
    UI.productForm.addEventListener('submit', addNewProduct);
    UI.updateForm.addEventListener('submit', updateRecord);
    UI.categoryForm.addEventListener('submit', addNewCategory);
    UI.searchForm.addEventListener('submit', searchRecord);
    UI.outputForm.addEventListener('submit', addOutput);
    UI.entryForm.addEventListener('submit', addEntry);
    UI.categoryUpdateForm.addEventListener('submit', updateCategory);
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

    const productData = new FormData(UI.productForm);
    const url = 'API/stock/add.php';

    const productCode = productData.get('new-product-code');
    const productName = productData.get('new-product-name');
    const productDescription = productData.get('new-product-description');
    const productCategory = productData.get('new-product-category');

    if ( productCode === '' || productName === '' || productDescription === '' || productCategory === '' ) {
        alert("Debes llenar todos los campos!");
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

function deleteRecord(id) {

    const answer = confirm('¡Eliminará todo lo relacionado a este producto!');

    if(answer) {

        const url = `API/stock/delete.php?id=${id}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                requestApiTables('show.php');
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }

    updateNavCategories();
}

function updateRecord(e) {

    e.preventDefault();

    let updateData = new FormData(UI.updateForm);
    const url = `API/stock/update.php?id=${updateProductID}`;

    const code = updateData.get('code-update');
    const name = updateData.get('update-name');
    const description = updateData.get('update-description');
    const amount = updateData.get('update-amount');
    const category = updateData.get('update-category');

    if (code === '' || name === '' || description === '' || amount === '' || category === '') {
        alert("Debes llenar todos los campos!");
        return;
    }

    const options = {
        method: 'PUT',
        body: JSON.stringify({
            code,
            name,
            description,
            amount,
            category,
        }) // No se puede trabajar con objetos multipart/form-data
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => {
                requestApiTables('show.php');
                return response.json(response);
            })
            .then( data =>  {
                console.log(data)
            })
            .catch( error => console.log(error) );

    }

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

function updateCategory(e) {

    e.preventDefault();
    
    const updateData = new FormData(UI.categoryUpdateForm);
    const url = `API/categories/update.php?id=${updateCategoryID}`;

    const category = updateData.get('category-update-name');

    if( category === '' ) {
        alert("Debes llenar todos los campos!");
        return;
    }

    const options = {
        method: 'PUT',
        body: JSON.stringify({
            category,
        }) // No se puede trabajar con objetos multipart/form-data
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => {
                requestApiCategories();
                return response.json(response);
            })
            .then( data =>  {
                console.log(data)
            })
            .catch( error => console.log(error) );

    }
}

function deleteCategory(category_code) {

    const answer = confirm('¡Eliminará todo lo relacionado a esta categoria!');

    if(answer) {

        const url = `API/categories/delete.php?id=${category_code}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                requestApiCategories();
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }

}

    // Buscador
function searchRecord(e){
    e.preventDefault();

    const searchData = new FormData(UI.searchForm);
    const search = searchData.get('search').toLocaleLowerCase();

    if( search === '' ) {
        alert('No puedes dejar el campo vacío!');
        return;
    }
 
    const url = `show.php?product=${search}`;
    requestApiTables(url);

    UI.searchField.value = '';
}

    // Entradas
function addEntry(e) {

    e.preventDefault();

    let entryData = new FormData(UI.entryForm);
    const url = 'API/entrys/add.php';

    const product = entryData.get('product-entry');
    const amount = entryData.get('amount-entry');
    const deliveredEntry = entryData.get('delivery-entry');

    if ( product === '' || amount === '' || deliveredEntry === '') {
        alert('Debes llenar todos los campos!');
        return;
    }
    
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

    const product = outputData.get('product-output');
    const amount = outputData.get('amount-output');
    const received = outputData.get('recived-output');

    if ( product === '' || amount === '' || received === '') {
        alert("Debes llenar todos los campos!");
        return;
    }

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
        const buttonUpdate = document.createElement('button');

        buttonUpdate.classList.add('btn', 'btn-link');
        buttonUpdate.setAttribute('data-bs-toggle', 'modal');
        buttonUpdate.setAttribute('data-bs-target', '#modal-update-record');
        buttonUpdate.innerHTML = `Editar <i class="fa fa-edit"></i>`;
        buttonUpdate.onclick = function() {
            updateProductID = product_code;
            UI.codeUpdate.value = product_code;
            UI.productUpdate.value = name;
            UI.descriptionUpdate.value = description;
            UI.amountUpdate.value = amount;
            UI.categoryUpdate.value = category_code;
        };

        const buttonDelete = document.createElement('button');
        buttonDelete.classList.add('btn', 'btn-link');
        buttonDelete.innerHTML = `Eliminar <i class="fa fa-times-circle"></i>`;
        buttonDelete.onclick = function() {
            deleteRecord(product_code);
        };

        const deliveryButton = document.createElement('button');
        deliveryButton.classList.add('btn', 'btn-outline-warning');
        deliveryButton.setAttribute('data-bs-toggle', 'modal');
        deliveryButton.setAttribute('data-bs-target', '#modal-delivery');
        deliveryButton.textContent = 'Entregar';
        deliveryButton.onclick = function() {
            UI.productOutput.value = product_code;
        };

        td.appendChild(buttonUpdate);
        td.appendChild(buttonDelete);
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

        const buttonUpdate = document.createElement('button');
        buttonUpdate.type = 'button';
        buttonUpdate.classList.add('btn', 'float-end', 'p-0', 'mx-2');
        buttonUpdate.innerHTML = `<i class="fa fa-edit"></i>`;
        buttonUpdate.setAttribute('data-bs-toggle', 'modal');
        buttonUpdate.setAttribute('data-bs-target', '#category-update-modal');
        buttonUpdate.onclick = function () {
            updateCategoryID = category_code;
            UI.categoryNameUpdate.value = category;
        }

        const buttonDelete = document.createElement('button');
        buttonDelete.type = 'button';
        buttonDelete.classList.add('btn-close', 'float-end');
        buttonDelete.onclick = function () {
            deleteCategory(category_code);
        }

        hyperlink.appendChild(buttonDelete);
        hyperlink.appendChild(buttonUpdate);
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

    if ( !e.target.classList.contains('list-group-item') ) {
        return;
    }

    addCategoryClass(e.target);
    UI.title.textContent = e.target.textContent;

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

// Eliminar caracteres especiales
function formattedString(str){
    return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
}