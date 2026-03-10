<html>

<title>Currency Management</title>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs_view.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/currency.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
</head>


<body>
	<div class="col-12">
		<div class="col-12 alert background-Planning">
			<div class="col-12 planning">
				<img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning">
				Financial Planning
			</div>
			<div class="col-12 mt-15">
				<div class="alert alert2-secondary3 pr-5">
					<div class="row">
						<div class="col-6 text-start">
							<span class="mr-5">
								<img src="../images/icons/Settings/back-blue.svg" class="small-icon mr-5">
								<a href="#">
									Back
								</a>
							</span>
							<span class="mr-5">Currency Management</span>
							<a href="" class=" btn create-btn">Register
								<i class="fa fa-magic ทสข5" aria-hidden="true"></i>
							</a>
						</div>
						<div class="col-6 text-end"></div>
					</div>
					<div class="col-12 mt-10">
						<table class="table table-borderless">
							<thead>
								<tr class="text-center head-table">
									<th class="table-left-radius">CURRENCY NAME</th>
									<th>CURRENCY CODE</th>
									<th>CURRENCY SIGN</th>
									<th>COUNTRY</th>
									<th>DOLLAR UNIT</th>
									<th>EXCHANGE RATE</th>
									<th>SOURCE</th>
									<th>LAST UPDATED</th>
									<th class="table-righ-radius">Refresh</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>

</html>