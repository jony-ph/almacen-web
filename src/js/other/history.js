const entries = document.querySelector('#entries-table tbody');
const outputs = document.querySelector('#outputs-table tbody');

let entriesList = [];
let outputsList = [];

eventListeners();
function eventListeners() {

    document.addEventListener('DOMContentLoaded', () => {
        showEntries();
        showOutputs();
    });

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

        outputs.appendChild(row);
        tooltip();

    });

}

function clearEntriesTable() {
    while (outputs.firstChild){
        outputs.removeChild(outputs.firstChild);
    }
}

function tooltip() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}