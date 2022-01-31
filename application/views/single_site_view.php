<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta http-equiv="refresh" content="30" /> -->
	<title>EnggLiveView</title>
	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Font Awesome 5 -->
	<link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
	<!-- Table -->
	<link href=<?= base_url()."assets/css/excel-bootstrap-table-filter-style.css"?> rel="stylesheet">
    
    <link href=<?= base_url()."assets/css/main.css"?> rel="stylesheet">

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
                    <table id="binResults" class="table table-bordered table-sm">
						<caption>Bin Summary Result</caption>
						<thead>
							<tr>
								<th class="text-center">Bin</th>
								<th class="text-center">Descr</th>
								<th class="text-center">Site 1</th>
							</tr>
						</thead>
						<tbody>
                            <tr>
								<td class="text-center"><strong>1</strong></td>
								<td class="text-center"><?= $binAssignment[1]['Descr']?></td>
								<td class="text-center"><span><?= $binsStat[0][1]." (".$siteYield['site1']."%)";?></span></td>
							</tr>
							<?php foreach($binsStat[0] as $key=>$binNum): ?>
							<?php if($binsStat[0][$key]!=0 && $binsStat[1][$key]!=0 && $key>1): ?>
							<tr>
								<td class="text-center"><strong><?= $key?></strong></td>
								<td class="text-center"><?= $binAssignment[$key]['Descr']?></td>
								<td class="text-center"><?= $binsStat[0][$key]?></td>
							</tr>
							<?php endif?>
							<?php endforeach ?>
						</tbody>
					</table> 
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
    $('#dataTable').excelTableFilter();

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

    // /* === Refresh Rate ===*/
	// setInterval("my_function();",5000); 
    // function my_function(){
    //   $('#datTable').load(location.href + ' tbody');
    // }

    //Yield Doughnut Chart
	// var ctxD = document.getElementById("doughnutChart").getContext('2d');
	// var pass = <?php //echo $pass ?>;
	// var fail = <?php //echo $testsCount-$pass ?>;
	// var yield = <?php //echo $yield ?>;

    // var myLineChart = new Chart(ctxD, {
    //   type: 'doughnut',
    //   data: {
    //     labels: ["Bin1 = "+pass+" ", "Fail = "+fail+" "],
    //     datasets: [{
    //       data: [ yield, (100-yield).toFixed(2)],
    //       backgroundColor: ["#28a745", "#dc3545"],
    //       hoverBackgroundColor: ["#20c997", "#fb808b"]
    //     }]
    //   },
    //   options: {
    //     responsive: true
    //   }
    // });


  </script>
  
</html>