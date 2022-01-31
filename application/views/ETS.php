<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="30"/>
  <title>EnggLiveView</title>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome 5 -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href=<?= base_url()."assets/MDB/css/addons/datatables.min.css"?> rel="stylesheet">
    
    <!-- Background CSS -->
    <link href=<?= base_url()."assets/css/background.css"?> rel="stylesheet">

    <style>
      table.dataTable thead .sorting:after,
      table.dataTable thead .sorting:before,
      table.dataTable thead .sorting_asc:after,
      table.dataTable thead .sorting_asc:before,
      table.dataTable thead .sorting_asc_disabled:after,
      table.dataTable thead .sorting_asc_disabled:before,
      table.dataTable thead .sorting_desc:after,
      table.dataTable thead .sorting_desc:before,
      table.dataTable thead .sorting_desc_disabled:after,
      table.dataTable thead .sorting_desc_disabled:before {
      bottom: .5em;
      }

      #tableSection{
        margin: 20px;
        padding: 20px;
        background-color: white;
      }
      
      #doughnutChart{
        object-fit: contain;
      }


    </style>
</head>
<body>
  <!-- <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;"> -->
    <!-- Mask & flexbox options-->
    <!-- <div class="mask rgba-gradient align-items-center"> -->
      <!-- Content -->
      <div id="container" >
        <div class="row">
          <div id="tableSection" class="col col-md-8">
            <table id="dataTable" class="table table-hover table-md">
              <thead>
                <tr>
                  <th scope="col">Index</th>
                  <th scope="col">Test Name</th>
                  <th scope="col">Mean</th>
                  <th scope="col">Std Dev</th>
                  <th scope="col">CPK</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($rowValues as $key=>$row):?>
                <tr > 
                  <th scope="row"><?= $key?></th>
                  <td><?= $row[0]?></td>
                  <td><?= $row[1]?></td>
                  <td><?= $row[2]?></td>
                  <td class=<?php if($row[3]<1.67){echo "text-danger";}?>><?= $row[3]?></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>

          <div class="col col-md-4">
              <!-- Insert Site Selection here and % Yield -->
              <div class="yield-chart">
                <canvas id="doughnutChart"></canvas>
              </div>
          </div>
        </div>
      </div>
    <!-- </div> -->
  <!-- </div> -->
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

</body>

  <!-- Background -->
  <script type="text/javascript" src=<?= base_url()."/assets/js/background.js"?>></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/addons/datatables.min.js"?>></script>
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/mdb.min.js"?>></script>
  <script>
    //Table Filter and Sort
    $(document).ready(function () {
    $('#dataTable').DataTable({
      "order": [[ 0, "asc" ]]
    });
    $('.dataTables_length').addClass('bs-select');
    });

    //Yield Doughnut Chart
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ["Pass", "Fail"],
        datasets: [{
          data: [ <?= $yield*100?>, (100-<?= $yield*100?>).toFixed(2)],
          backgroundColor: ["#28a745", "#949FB1"],
          hoverBackgroundColor: ["#20c997", "#A8B3C5"]
        }]
      },
      options: {
        responsive: true
      }
    });
  </script>
  
</html>