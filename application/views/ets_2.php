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

<!--===============================================================================================-->	
<link rel="icon" type="image/png" href=<?= base_url()."assets/img/icons/favicon.ico"?>/>
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?= base_url()."assets/vendor/animate/animate.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?= base_url()."assets/vendor/select2/select2.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?= base_url()."assets/vendor/perfect-scrollbar/perfect-scrollbar.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?= base_url()."assets/css/util.css"?>>
	<link rel="stylesheet" type="text/css" href=<?= base_url()."assets/css/main.css"?>>
<!--===============================================================================================-->








	<style>
		body {
		background: #007bff;
		/* background: linear-gradient(to right, #0062E6, #33AEFF); */
		/* background: linear-gradient(to right, #2e7292, #33ffaa); */
		background: linear-gradient(to right, #2e7292, #40b9549e);
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
			
		.my-custom-scrollbar {
		position: relative;
		height: 800px;
		overflow: auto;
		}

		.table-wrapper-scroll-y {
		display: block;
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
			padding: 20px 10px;
			background-color: #fffffff2;
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
			<div id="tableSection" class="col" >
				<div class="limiter">
					<div class="">
						<div class="wrap-table100">
							<div class="table100 ver1 m-b-110">
								<div class="table100-head">
									<table>
										<thead>
											<tr class="row100 head">
												<th class="cell100" scope="col" style="text-align:center"><span class="table-header">Index</span></th>
												<th class="cell100" scope="col"><span class="table-header">Test Name</span></th>
												<th class="cell100" scope="col"><span class="table-header">LoLim</span></th>
												<th class="cell100" scope="col"><span class="table-header">HiLim</span></th>
												<th class="mean cell100" scope="col"><span class="table-header">Mean</span></th>
												<th class="sDev cell100" scope="col"><span class="table-header">Std Dev</span></th>
												<th class="cp cell100" scope="col"><span class="table-header">CP</span></th>
												<th class="cpk cell100" scope="col"><span class="table-header">CPK</span></th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="table100-body js-pscroll">
									<table>
										<tbody>
											
											<!-- <tr class="row100 body">
												<td class="cell100 column1">Like a butterfly</td>
												<td class="cell100 column2">Boxing</td>
												<td class="cell100 column3">9:00 AM - 11:00 AM</td>
												<td class="cell100 column4">Aaron Chapman</td>
												<td class="cell100 column5">10</td>
											</tr> -->
											<?php foreach($rowValues as $key=>$row):?>
											<tr>
												<td scope="row" style="text-align:center"><?= $key?></td>
												<td class="cell100"><?= $row['testName']?></td>
												<td class="cell100"><?= $row['LSL']?></td>
												<td class="cell100"><?= $row['USL']?></td>
												<td class="cell100"><?= $row['mean']?></td>
												<td class="cell100"><?= $row['stdDev']?></td>
												<td class=<?php echo "cell100 "; if($row['cp']<10){echo "text-danger";}?>><?= $row['cp']?></td>
												<td class=<?php echo "cell100 "; if($row['cpk']<1.67){echo "text-danger";}?>><?= $row['cpk']?></td>
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col col-lg-3 col-md-3 col-sm-12">
				<div class="control-section rounded">
					<form>
						<div id="columnSelector">
							<div class="form-check">
								<input class="form-check-input default-checked" type="checkbox" name="mean" value="" id="mean">
								<label class="form-check-label" for="mean">
									Mean
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input default-checked" type="checkbox" name="sDev" value="" id="sDev">
								<label class="form-check-label" for="sDev">
									Standard Dev
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="cp" value="" id="cp">
								<label class="form-check-label" for="cp">
									CP
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="cpk" value="" id="cpk">
								<label class="form-check-label" for="cpk">
									CPK
								</label>
							</div>
						</div>
					</form>
				</div>
				<div class="yield-chart rounded">
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
 

<!--===============================================================================================-->
	<script src=<?= base_url()."assets/vendor/bootstrap/js/popper.js"?>></script>
<!--===============================================================================================-->
	<script src=<?= base_url()."assets/vendor/select2/select2.min.js"?>></script>
<!--===============================================================================================-->
	<script src=<?= base_url()."assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"?>></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	<script src=<?= base_url()."assets/js/main.js"?>></script> 
 
 
 <script>
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