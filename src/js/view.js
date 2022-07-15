const id = document.querySelector('#id-pdt');
const nameCard = document.querySelector('#nam');
const descriptionCard = document.querySelector('#dct');
const categoryCard = document.querySelector('#ctg');
const amountCard = document.querySelector('#amt');

eventListener();
function eventListener() {
  document.addEventListener('DOMContentLoaded', e => {

    params = getAllGetParams();
    
    const url = `API/stock/product.php?id=${params[0][1]}`;

    fetch(url)
    .then( result => result.json() )
    .then( data => {
      showProductInfo(data);
    })
    .catch( error => console.log(error) );
  });
}

function getAllGetParams() {
  var result = [];
  var parts = [];

  location.search
  .substr(1)
  .split("&")
  .forEach(function (item) {
    parts = item.split("=");
    if(parts[0]!=""){     
      result.push(parts);
    }
  });

  return result;
}

function showProductInfo(data) {
  
  const {product_code, name, description,  amount, category} = data[0];

  id.textContent = "ID: " + product_code;
  nameCard.textContent = "Producto: " + name;
  descriptionCard.textContent = "Descripción: " + description;
  amountCard.textContent = "Cantidad disponible: " + amount;
  categoryCard.textContent = "Categoría: " + category;

}