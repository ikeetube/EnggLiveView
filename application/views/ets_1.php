<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="refresh" content="30" /> -->
	<title>EnggLiveView</title>
	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Font Awesome 5 -->
	<link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
	<!-- Table -->
	<link href=<?= base_url()."assets/css/excel-bootstrap-table-filter-style.css"?> rel="stylesheet">

	<style>
		@import url('https://fonts.googleapis.com/css?family=Varela+Round');

		body {
		background: #007bff;
		/* background: linear-gradient(to right, #0062E6, #33AEFF); */
		/* background: linear-gradient(to right, #2e7292, #33ffaa); */
		/* background: linear-gradient(to right,#229e4ec7 , #2e7292); */
		background: linear-gradient(to right, #0a3458c9 , #2e7292);
		
			font-family: 'Varela Round',serif;
		
		/* background: #0f2027; /* fallback for old browsers */
		/* background: -webkit-linear-gradient(to right, #0f2027, #203a43, #2c5364); /* Chrome 10-25, Safari 5.1-6 */
		/* background: linear-gradient(to right, #0f2027, #203a43, #2c5364); W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

		}

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

		#tableSection {
			/* margin-left: 20px; */
			padding: 10px 5px 0 30px;
			/* background-color: #e9ecef; */
			
		}
			
		.table-header {
			font-family: 'Varela Round',serif;
		}
		.my-custom-scrollbar {
		position: relative;
		height: 800px;
		overflow: auto;
		}

		.add-shadow{
		-moz-box-shadow:    2px 2px 2px 2px #00000073;
		-webkit-box-shadow: 2px 2px 2px 2px #00000073;
		box-shadow:         2px 2px 2px 2px #00000073;
		}

		.table-wrapper-scroll-y {
		display: block;
		background-color: #fffffff2;

		}
		#dataTable{
			background-color: #fffffff2;
		}

		#dataTable tbody {
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		/* , Arial, sans-serif; */
		font-size: 14px;
		}

		.control-section {
			margin: 10px 10px 10px 0;
			/* padding: 20px 10px; */
			/* background-color: #fffffff2; */
		}

		.card-body {
			padding: 0.25rem !important;
		}

		/*Flat UI Design Checkboxes*/
		.flatboxes {
		/* background: #494949 none repeat scroll 0 0; */
		/* float: left; */
		padding: 5%;
		width: 40%;
		/* height:100px;	 */
		}
		.flatboxes p {
		display: block;
		height: 30px;
		vertical-align: middle;
		}
		.flatboxes [type="checkbox"]:not(:checked),
		.flatboxes [type="checkbox"]:checked {
		position: absolute; 
		left: -9999px;
		}
		.flatboxes [type="checkbox"]:not(:checked) + label,
		.flatboxes [type="checkbox"]:checked + label {
		position: absolute;
		padding-left: 95px;
		cursor: pointer;
		/* color:#ddd; */
		}
		.flatboxes [type="checkbox"]:not(:checked) + label:before,
		.flatboxes [type="checkbox"]:checked + label:before,
		.flatboxes [type="checkbox"]:not(:checked) + label:after,
		.flatboxes [type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		}
		.flatboxes [type="checkbox"]:not(:checked) + label:before,
		.flatboxes [type="checkbox"]:checked + label:before {
		left: 0; top: 0;
		width: 80px; height: 30px;
		background: #DDDDDD;
		transition: background-color .2s;
		}
		.flatboxes [type="checkbox"]:not(:checked) + label:after,
		.flatboxes [type="checkbox"]:checked + label:after {
		width: 30px; height: 30px;
		transition: all .3s;
		background: #7F8C9A;
		top: 0; left: 0;
		}

		/* on checked */
		.flatboxes [type="checkbox"]:checked + label:before {
		background:#34495E; 
		}
		.flatboxes [type="checkbox"]:checked + label:after {
		background: #6cc0e5;
		top: 0; left: 51px;
		}

		.flatboxes [type="checkbox"]:checked + label .ui,
		.flatboxes [type="checkbox"]:not(:checked) + label .ui:before,
		.flatboxes [type="checkbox"]:checked + label .ui:after {
		position: absolute;
		left: 6px;
		width: 65px;
		font-size: 14px;
		font-weight: bold;
		line-height: 22px;
		transition: all .3s;
		}

		.flatboxes [type="checkbox"]:not(:checked) + label .ui:before {
		font-family: 'Font Awesome 5 Free';
		content: "\f070";
		left: 46px;
		margin-top: 3px;
		}
		.flatboxes [type="checkbox"]:checked + label .ui:after {
		font-family: 'Font Awesome 5 Free';
		content: "\f06e";
		color: #fbfbfb;
		margin-top: 3px;
		left: 12px;
		}
		.flatboxes [type="checkbox"]:focus + label:before {
		border: 0; outline: 0;
		box-sizing: border-box;
		}

		.yield-chart {
			margin: 10px 10px 10px 0;
			padding: 20px 10px;
			background-color: #fffffff2;
		}

		#doughnutChart {
			object-fit: contain;
		}
	</style>
</head>
<body>
	<div id="container">
		<div class="row">
			<div id="tableSection" class="col  col-lg-9 col-md-9 col-sm-12" >
				<div class="table-wrapper-scroll-y my-custom-scrollbar add-shadow rounded">
					<table id="dataTable" class="table table-hover table-md">
						<thead>
							<tr>
								<th scope="col" style="text-align:center"><span class="table-header">Index</span></th>
								<th scope="col"><span class="table-header">Test Name</span></th>
								<th scope="col"><span class="table-header">LoLim</span></th>
								<th scope="col"><span class="table-header">HiLim</span></th>
								<th class="mean" scope="col"><span class="table-header">Mean</span></th>
								<th class="sDev" scope="col"><span class="table-header">Std Dev</span></th>
								<th class="cp" scope="col"><span class="table-header">CP</span></th>
								<th class="cpk" scope="col"><span class="table-header">CPK</span></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($rowValues as $key=>$row):?>
							<tr>
								<td scope="row" style="text-align:center"><?= $key?></td>
								<td><?= $row['testName']?></td>
								<td><?= $row['LSL']?></td>
								<td><?= $row['USL']?></td>
								<td><?= $row['mean']?></td>
								<td><?= $row['stdDev']?></td>
								<td class=<?php if($row['cp']<10){echo "text-danger";}?>><?= $row['cp']?></td>
								<td class=<?php if($row['cpk']<1.67){echo "text-danger";}?>><?= $row['cpk']?></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>	
			</div>
			<div class="col col-lg-3 col-md-3 col-sm-12">
				<div class="control-section ">
					<div class="card rounded add-shadow">
						<div class="card-header">
							Select columns to display
						</div>
						<div class="card-body">
							<div id="columnSelector">
							<!-- Design 2 -->
								<div class="flatboxes rounded">
									<form action="#">
										<p><input type="checkbox" id="mean" name="mean" value="Mean"><label for="mean"><span class="ui"></span>Mean</label></p>
										<p><input type="checkbox" id="sDev" name="sDev" value="Standard Dev" checked><label for="sDev"><span class="ui"></span>Std Dev</label></p>
										<p><input type="checkbox" id="cp" name="cp" value="CP" checked><label for="cp"><span class="ui"></span>CP</label></p>
										<p><input type="checkbox" id="cpk" name="cpk" value="CPK" unchecked><label for="cpk"><span class="ui"></span>CPK</label></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yield-chart rounded add-shadow">
					<div class="row">
						<!-- <div class="col col-md-9"> -->
							<canvas id="doughnutChart"></canvas>
						<!-- </div>		 -->
						<!-- <div class="col col-md-3"> -->
							<!-- Pass = asdasd <br>Fail = asdasd   -->
						<!-- </div>		 -->

					</div>
				</div>
			</div>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

</body>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Table -->
  <script type="text/javascript" src=<?= base_url()."assets/js/excel-bootstrap-table-filter-bundle.js"?>></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/addons/datatables.min.js"?>></script>
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/mdb.min.js"?>></script>
  <script>
    /* === Table === */
    // $(document).ready(function () {
    //   $('#dataTable').DataTable(
    //     {"ordering": false}
    //   );
    //   });
    $('table').excelTableFilter();

    /* === Column Selection ===*/
    $(function () {
    var $chk = $("#columnSelector input:checkbox"); 
    var $tbl = $("#dataTable");
    var $tblhead = $("#dataTable th");
 
    $chk.prop('checked', true); 
 
    $chk.click(function () {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });

    /* === Refresh Rate ===*/
	setInterval("my_function();",5000); 
    function my_function(){
      $('#datTable').load(location.href + ' tbody');
    }

    //Yield Doughnut Chart
	var ctxD = document.getElementById("doughnutChart").getContext('2d');
	var pass = <?= $pass ?>;
	var fail = <?= $testsCount-$pass ?>;
	var yield = <?= $yield ?>;

    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ["Bin1 = "+pass+" ", "Fail = "+fail+" "],
        datasets: [{
          data: [ yield, (100-yield).toFixed(2)],
          backgroundColor: ["#28a745", "#dc3545"],
          hoverBackgroundColor: ["#20c997", "#fb808b"]
        }]
      },
      options: {
        responsive: true
      }
    });
  </script>
  
</html>