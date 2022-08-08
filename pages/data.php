<?php include_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    async function drawChart() {

      try{
        const products = await recollectData();

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(products);

        // Set chart options
        let options = {'title':'Productos totales',
                        'width':800,
                        'height':700};

        // Instantiate and draw our chart, passing in some options.
        let chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      } catch(err) {
        console.log(err);
      }
  
    }

    async function recollectData() {

      try{
        const url = `API/stock/show.php`;
        const result = await fetch(url);
        const data = await result.json();

        const products = []

        data.forEach(product => {
          const {name, amount} = product;

          const element = [name, amount];
          products.push(element);
        });

        return products;

      } catch(err) {
        console.log(err);
      }

    }

    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <?php include_once 'header.php'; ?>

    <div class="mt-5 container">
      <div id="chart_div"></div>
    </div>
  </body>
</html>