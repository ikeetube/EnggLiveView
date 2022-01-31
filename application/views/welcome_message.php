<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!DOCTYPE HTML>
 <html>
 <head>
	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap JS -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<style>
		:root {
		--input-padding-x: 1.5rem;
		--input-padding-y: .75rem;
		}

		body {
		background: #007bff;
		/* background: linear-gradient(to right, #0062E6, #33AEFF); */
		background: linear-gradient(to right, #2e7292, #33ffaa);
		}

		.card-signin {
		border: 0;
		border-radius: 1rem;
		box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
		overflow: hidden;
		}

		.card-signin .card-title {
		margin-bottom: 2rem;
		font-weight: 300;
		font-size: 1.5rem;
		}

		.card-signin .card-img-left {
		width: 45%;
		/* Link to your background image using in the property below! */
		/* background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512'); */
		background: scroll center url(<?= base_url()."assets/img/header-background.jpg"?>);
		background-size: cover;
		}


		/* img {
		height: 130px; 
		width: 300px;
		} */

		.rotate:hover{
			-webkit-transform: rotateZ(-15deg);
			-ms-transform: rotateZ(-15deg);
			transform: rotateZ(-15deg);
			transition: all 0.3s ease;
		}

		#submitBtn:hover {
			box-shadow: inset 0 0 0 5px #015090;
			transition: all 0.3s ease;
			cursor: pointer;

		}
		.card-signin .card-body {
		padding: 2rem;
		}

		.form-signin {
		width: 100%;
		}

		.form-signin .btn {
		font-size: 80%;
		border-radius: 5rem;
		letter-spacing: .1rem;
		font-weight: bold;
		padding: 1rem;
		transition: all 0.2s;
		}

		.form-label-group {
		position: relative;
		margin-bottom: 1rem;
		}

		select:hover, input:hover {
			cursor:pointer;
		}

		.form-label-group input {
		height: auto;
		border-radius: 2rem;

		}

		.form-label-group>input,
		.form-label-group>label {
		padding: var(--input-padding-y) var(--input-padding-x);
		}

		.form-label-group>label {
		position: absolute;
		top: 0;
		left: 0;
		display: block;
		width: 100%;
		margin-bottom: 0;
		/* Override default `<label>` margin */
		line-height: 1.5;
		color: #495057;
		border: 1px solid transparent;
		border-radius: .25rem;
		transition: all .1s ease-in-out;
		}

		.form-label-group input::-webkit-input-placeholder {
		color: transparent;
		}

		.form-label-group input:-ms-input-placeholder {
		color: transparent;
		}

		.form-label-group input::-ms-input-placeholder {
		color: transparent;
		}

		.form-label-group input::-moz-placeholder {
		color: transparent;
		}

		.form-label-group input::placeholder {
		color: transparent;
		}

		.form-label-group input:not(:placeholder-shown) {
		padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
		padding-bottom: calc(var(--input-padding-y) / 3);
		}

		.form-label-group input:not(:placeholder-shown)~label {
		padding-top: calc(var(--input-padding-y) / 3);
		padding-bottom: calc(var(--input-padding-y) / 3);
		font-size: 12px;
		color: #777;
		}

		.btn-google {
		color: white;
		background-color: #ea4335;
		}

		.btn-facebook {
		color: white;
		background-color: #3b5998;
		}

	</style>
 
 </head>

 <body>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-9 mx-auto">
				<div class="card card-signin flex-row my-5">
					<div class="card-img-left d-none d-md-flex">
						<div id="onsemi-logo" style="padding: 30px 25px;">
							<img src="https://www.onsemi.com/site/images/ON-Semiconductor.jpg" class="img-responsive rounded rotate" width="300" alt="logo"><!-- Background image for card set in CSS! -->
						</div>
					</div>
					<div class="card-body">
						<h5 class="card-title text-center">EnggLiveView</h5>
						<form class="form-signin" method="GET" action=<?= "platform_select_v2"?>>
							<div class="form-group">
								<label clas="form-label-group"for="csvName">Select CSV file</label>
								<select class="form-control" name="csvName" id="csvName" required autofocus>
									<?php foreach ($files as $file):?>
									<option><?= $file['name']?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="form-group">
								<label for="numSites">Number of sites:</label>
								<select class="form-control" name="numSites" id="numSites">
									<option>1</option>
									<option>2</option>
									<!-- <option>4</option> -->
								</select>
							</div>
							<div class="form-label-group">
								<div>Select tester platform:</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="testerSelect" id="ets364"
										value="ets364" checked>
									<label class="form-check-label" for="ets364">
										ETS-364
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="testerSelect" id="ets88"
										value="ets88" >
									<label class="form-check-label" for="ets88">
										ETS-88
									</label>
								</div>
								<div class="form-check disabled">
									<input class="form-check-input" type="radio" name="testerSelect" id="asl1k"
										value="asl1k" disabled>
									<label class="form-check-label" for="asl1k">
										ASL1K
									</label>
								</div>
							</div>
							<button id="submitBtn" type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
 </body>
 </html>