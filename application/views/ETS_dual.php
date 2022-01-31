<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- <meta http-equiv="refresh" content="30"/> -->
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
  <?php 
  // echo '<pre>';
  // print_r($rowValues);
  // echo '<pre/>';
  ?>
      <div id="container">
      	<div class="row">
      		<div id="tableSection" class="col">
      			<table id="dataTable" class="table table-hover table-md">
      				<thead>
      					<tr>
      						<th scope="col">Index</th>
      						<th scope="col">Test Name</th>
      						<th scope="col">S1_Mean</th>
      						<th scope="col">S2_Mean</th>
      						<th scope="col">S1_S.Dev</th>
      						<th scope="col">S2_S.Dev</th>
      						<th scope="col">S1_CP</th>
      						<th scope="col">S2_CP</th>
      						<th scope="col">S1_CPK</th>
      						<th scope="col">S2_CPK</th>
      					</tr>
      				</thead>
      				<tbody>
      					<?php foreach($rowValues as $key=>$row):?>
      					<tr>
      						<th scope="row"><?= $key?></th>
      						<td><?= $row['testName']?></td>
      						<td><?= $row['meanS1']?></td>
      						<td><?= $row['meanS2']?></td>
      						<td><?= $row['stdDevS1']?></td>
      						<td><?= $row['stdDevS2']?></td>
      						<td class=<?php if($row['cpS1']<10){echo "text-danger";}?>><?= $row['cpS1']?></td>
      						<td class=<?php if($row['cpS2']<10){echo "text-danger";}?>><?= $row['cpS2']?></td>
      						<td class=<?php if($row['cpkS1']<1.67){echo "text-danger";}?>><?= $row['cpkS1']?></td>
      						<td class=<?php if($row['cpkS2']<1.67){echo "text-danger";}?>><?= $row['cpkS2']?></td>
      					</tr>
      					<?php endforeach?>
      				</tbody>
      			</table>
      		</div>


      	</div>
      </div>
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

    
  </script>
  
</html>