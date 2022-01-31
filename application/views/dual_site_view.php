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
								<th scope="col" style="border-right:1px solid #00000038;"><span class="table-header">HiLim</span></th>
								<th class="mean" scope="col"><span class="table-header">S1_Mean</span></th>
								<th class="mean" scope="col" style="border-right:1px solid #00000038;"><span class="table-header">S2_Mean</span></th>
								<th class="sDev" scope="col"><span class="table-header">S1_S.Dev</span></th>
								<th class="sDev" scope="col" style="border-right:1px solid #00000038;"><span class="table-header">S2_S.Dev</span></th>
								<th class="cp" scope="col"><span class="table-header">S1_CP</span></th>
								<th class="cp" scope="col" style="border-right:1px solid #00000038;"><span class="table-header">S2_CP</span></th>
								<th class="cpk" scope="col"><span class="table-header">S1_CPK</span></th>
								<th class="cpk" scope="col"><span class="table-header">S2_CPK</span></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($rowValues as $key=>$row):?>
							<tr>
								<td scope="row"><?= $key?></td>
								<td><?= $row['testName']?></td>
								<td><?= $row['LSL']?></td>
								<td style="border-right:1px solid #00000038;"><?= $row['USL']?></td>
								<td><?= $row['meanS1']?></td>
								<td style="border-right:1px solid #00000038;"><?= $row['meanS2']?></td>
								<td><?= $row['stdDevS1']?></td>
								<td style="border-right:1px solid #00000038;"><?= $row['stdDevS2']?></td>
								<td class=<?php if($row['cpS1']<10){echo "text-danger";}?>><?= $row['cpS1']?></td>
								<td style="border-right:1px solid #00000038;" class=<?php if($row['cpS2']<10){echo "text-danger";}?>><?= $row['cpS2']?></td>
								<td class=<?php if($row['cpkS1']<1.67){echo "text-danger";}?>><?= $row['cpkS1']?></td>
								<td class=<?php if($row['cpkS2']<1.67){echo "text-danger";}?>><?= $row['cpkS2']?></td>
							</tr>
							<?php endforeach?>
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
                                        <p hidden><input type="checkbox" id="mean" name="mean" value="Mean" ><label for="mean"><span class="ui"></span>Mean</label></p>
                                        <p><input type="checkbox" id="sDev" name="sDev" value="Standard Dev" checked><label for="sDev"><span class="ui"></span>Std Dev</label></p>
                                        <p hidden><input type="checkbox" id="sDev" name="sDev" value="Standard Dev" checked ><label for="sDev"><span class="ui"></span>Std Dev</label></p>
                                        <p><input type="checkbox" id="cp" name="cp" value="CP" checked><label for="cp"><span class="ui"></span>CP</label></p>
                                        <p hidden><input type="checkbox" id="cp" name="cp" value="CP" checked ><label for="cp" ><span class="ui"></span>CP</label></p>
                                        <p><input type="checkbox" id="cpk" name="cpk" value="CPK" unchecked><label for="cpk"><span class="ui"></span>CPK</label></p>
                                        <p hidden><input type="checkbox" id="cpk" name="cpk" value="CPK" unchecked ><label for="cpk" ><span class="ui"></span>CPK</label></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yield-chart rounded add-shadow">
						<!-- <div class="carousel-item active"> -->

					<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
							<img class="d-block w-100" src="https://kinsta.com/wp-content/uploads/2015/11/how-to-optimize-images-for-web-1.png" alt="First slide">
							</div>
							<div class="carousel-item">
							<img class="d-block w-100" src="https://kinsta.com/wp-content/uploads/2018/11/average-bytes-per-page-1.png" alt="Second slide">
							</div>
							<div class="carousel-item">
							<img class="d-block w-100" src="https://kinsta.com/wp-content/uploads/2015/11/low-compression-high-quality-jpg.jpg" alt="Third slide">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div> -->
					<table id="binResults" class="table table-bordered table-sm">
						<caption>Bin Summary Result</caption>
						<thead>
							<tr>
								<th class="text-center">Bin</th>
								<th class="text-center">Descr</th>
								<th class="text-center">Site 1</th>
								<th class="text-center">Site 2</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><strong>1</strong></td>
								<td class="text-center"><?= $binAssignment[1]['Descr']?></td>
								<td class="text-center"><span><?= $binsStat[0][1]." (".$siteYield['site1']."%)";?></span></td>
								<td class="text-center"><span><?= $binsStat[1][1]." (".$siteYield['site2']."%)";?></span></td>
							</tr>
							<?php foreach($binsStat[0] as $key=>$binNum): ?>
							<?php if($binsStat[0][$key]!=0 && $binsStat[1][$key]!=0 && $key>1): ?>
							<tr>
								<td class="text-center"><strong><?= $key?></strong></td>
								<td class="text-center"><?= $binAssignment[$key]['Descr']?></td>
								<td class="text-center"><?= $binsStat[0][$key]?></td>
								<td class="text-center"><?= $binsStat[1][$key]?></td>
							</tr>
							<?php endif?>
							<?php endforeach ?>
						</tbody>
					</table> 

				</div>
			</div>
		</div>
	</div>

	<br><p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

			<?php
			// echo '<pre>';
            // print_r($binAssignment);
			// echo '</pre>';
			?>
	</div>
</body>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- JQuery -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <!-- Table -->
  <script type="text/javascript" src=<?= base_url()."assets/js/excel-bootstrap-table-filter-bundle.js"?>></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/addons/datatables.min.js"?>></script>
  <script type="text/javascript" src=<?= base_url()."/assets/MDB/js/mdb.min.js"?>></script>
  <script>
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
            $tbl.find('tr :nth-child(' + (index + 2) + ')').toggle();
        });
    });

    // //Yield Doughnut Chart
	// var ctxD = document.getElementById("doughnutChart").getContext('2d');
	// var pass = <?php //echo  $pass ?>;
	// var fail = <?php //echo  $testsCount-$pass ?>;
	// var yield = <?php //echo  $yield ?>;

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