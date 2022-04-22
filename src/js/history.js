const entries = document.querySelector('#entries-table tbody');
const outputs = document.querySelector('#outputs-table tbody');

const entryUpdateForm = document.querySelector('#entry-form');
const outputUpdateForm = document.querySelector('#output-form');

const productUpdateEntry = document.querySelector('#product-entry');
const amountUpdateEntry = document.querySelector('#amount-entry');
const deliveryUpdateEntry = document.querySelector('#delivered-entry');

const productUpdateOutput = document.querySelector('#product-output');
const amountUpdateOutput = document.querySelector('#amount-output');
const receivedUpdateOutput = document.querySelector('#received-output');

let entriesList = [];
let outputsList = [];
let updateEntryID = null;
let updateOutputID = null;

eventListeners();
function eventListeners() {

    document.addEventListener('DOMContentLoaded', () => {
        showEntries();
        showOutputs();
    });

    entryUpdateForm.addEventListener('submit', updateEntry);
    outputUpdateForm.addEventListener('submit', updateOutput);

}

function showEntries() {

    const url = 'API/entrys/show.php';

    fetch(url)
        .then( response => response.json() )
        .then( data => {
            entriesList = data;
            updateEntriesTable();
        })
        .catch( err => console.log(err) );

}

function showOutputs() {

    const url = 'API/outputs/show.php';

    fetch(url)
        .then( response => response.json() )
        .then( data => {
            outputsList = data;
            updateOutputsTable();
        })
        .catch( err => console.log(err) );
}

function updateEntriesTable() {

    clearEntriesTable();
    entriesList.forEach( entry =>  {

        const {entry_code, product, product_name, amount, delivered, recived, date, time} = entry;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${entry_code}</td>
            <td> <a href="javascript:void(0)" data-bs-toggle="tooltip" title="${product_name}"> ${product} </a> </td>
            <td>${amount}</td>
            <td>${delivered}</td>
            <td>${recived}</td>
            <td>${date}</td>
            <td>${time}</td>
        `;

        const td = document.createElement('td');
        const buttonUpdate = document.createElement('button');
        buttonUpdate.classList.add('btn', 'btn-link');
        buttonUpdate.setAttribute('data-bs-toggle', 'modal');
        buttonUpdate.setAttribute('data-bs-target', '#entry-modal');
        buttonUpdate.innerHTML = `Editar <i class="fa fa-edit"></i>`;
        buttonUpdate.onclick = function() {
            updateEntryID = entry_code;
            productUpdateEntry.value = product;
            amountUpdateEntry.value = amount;
            deliveryUpdateEntry.value = delivered;
        };

        const buttonDelete = document.createElement('button');
        buttonDelete.classList.add('btn', 'btn-link');
        buttonDelete.innerHTML = `Eliminar <i class="fa fa-times-circle"></i>`;
        buttonDelete.onclick = function() {
            deleteEntry(entry_code);
        };

        td.appendChild(buttonUpdate);
        td.appendChild(buttonDelete);
        row.appendChild(td);
        entries.appendChild(row);

    });
    tooltip();

}

function clearEntriesTable() {
    while (entries.firstChild){
        entries.removeChild(entries.firstChild);
    }
}

function updateOutputsTable() {

    clearOutputsTable();
    outputsList.forEach( output =>  {

        const {output_code, product, product_name, amount, delivered, recived, date, time} = output;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${output_code}</td>
            <td> <a href="javascript:void(0)" data-bs-toggle="tooltip" title="${product_name}"> ${product} </a> </td>
            <td>${amount}</td>
            <td>${delivered}</td>
            <td>${recived}</td>
            <td>${date}</td>
            <td>${time}</td>
        `;

        const td = document.createElement('td');
        const buttonUpdate = document.createElement('button');
        buttonUpdate.classList.add('btn', 'btn-link');
        buttonUpdate.setAttribute('data-bs-toggle', 'modal');
        buttonUpdate.setAttribute('data-bs-target', '#output-modal');
        buttonUpdate.innerHTML = `Editar <i class="fa fa-edit"></i>`;
        buttonUpdate.onclick = function() {
            updateOutputID = output_code;
            productUpdateOutput.value = product;
            amountUpdateOutput.value = amount;
            receivedUpdateOutput.value = recived;
        };

        const buttonDelete = document.createElement('button');
        buttonDelete.classList.add('btn', 'btn-link');
        buttonDelete.innerHTML = `Eliminar <i class="fa fa-times-circle"></i>`;
        buttonDelete.onclick = function() {
            deleteOutput(output_code);
        };

        td.appendChild(buttonUpdate);
        td.appendChild(buttonDelete);
        row.appendChild(td);
        outputs.appendChild(row);
    });

    tooltip();
}

function clearOutputsTable() {
    while (outputs.firstChild){
        outputs.removeChild(outputs.firstChild);
    }
}

function updateEntry(e) {
    e.preventDefault();

    let updateData = new FormData(entryUpdateForm);
    const url = `API/entrys/update.php?id=${updateEntryID}`;

    const product = updateData.get('product-entry');
    const amount = updateData.get('amount-entry');
    const delivered = updateData.get('delivered-entry');

    if ( product === '' || amount === '' || delivered === '' ) {
        alert('Debes llenar todos los campos!');
        return;
    }   

    const options = {
        method: 'PUT',
        body: JSON.stringify({
            product,
            amount,
            delivered,
        }) // No se puede trabajar con objetos multipart/form-data
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => {
                showEntries();
                return response.json(response);
            })
            .then( data =>  {
                console.log(data)
            })
            .catch( error => console.log(error) );

    }

    productUpdateEntry.value = '';
    amountUpdateEntry.value = '';
    deliveryUpdateEntry.value = '';
}

function updateOutput(e) {
    e.preventDefault();

    let updateData = new FormData(outputUpdateForm);
    const url = `API/outputs/update.php?id=${updateOutputID}`;

    const product = updateData.get('product-output');
    const amount = updateData.get('amount-output');
    const received = updateData.get('received-output');

    if ( product === '' || amount === '' || received === '' ) {
        alert('Debes llenar todos los campos!');
        return;
    }

    const options = {
        method: 'PUT',
        body: JSON.stringify({
            product,
            amount,
            received,
        }) // No se puede trabajar con objetos multipart/form-data
    }

    const answer = confirm('¿Desea actualizar este registro?');

    if(answer) {

        fetch(url, options)
            .then( (response) => {
                showOutputs();
                return response.json(response);
            })
            .then( data =>  {
                console.log(data)
            })
            .catch( error => console.log(error) );

    }

    productUpdateOutput.value = '';
    amountUpdateOutput.value = '';
    receivedUpdateOutput.value = '';
}

function deleteEntry(entry_code) {
    const answer = confirm("Eliminará una entrada, ¿Desea continuar?");

    if(answer) {

        const url = `API/entrys/delete.php?id=${entry_code}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                showEntries();
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }
}

function deleteOutput(output_code) {
    const answer = confirm("Eliminará una salida, ¿Desea continuar?");

    if(answer) {

        const url = `API/outputs/delete.php?id=${output_code}`;
        const options = {
            method: 'DELETE',
        }
        
        fetch(url, options)
            .then( response => {
                showOutputs();
                return response.json();
            })
            .then( data => {
                console.log(data);
            })
            .catch( error => console.log(error) );
    }
}

function tooltip() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}