<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Conversor de Câmbio</title>
</head>
<body>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Convert</h5>
			<form method="get">
				<div>
					<label for="valor">Valor:</label>
					<input class="form-control" type="text" id="valor" name="valor" rows="1"></input>
				</div>
				<div>
					<label for="currency1">From:</label>
					<select class="form-control" id="currency1" name="currency1">
						<option selected>Choose...</option>
						<option value="BRL">BRL</option>
						<option value="EUR">EUR</option>
						<option value="USD">USD</option>
					</select>
				</div>
				<p></p>
				<div class="form-group">
					<label for="currency2">To:</label>
					<select class="form-control" id="currency2" name="currency2">
						<option selected>Choose...</option>
						<option value="BRL">BRL</option>
						<option value="EUR">EUR</option>
						<option value="USD">USD</option>
					</select>
				</div>
				<button name="" type="submit" class="btn btn-primary">Convert</button> 
			</form> 
			<p></p>
			<div>
				<?php 
				if (isset($_GET["valor"])) echo $_GET["valor"].' '.$_GET["currency1"].' equals to '.convertCurrency($_GET["valor"], $_GET["currency1"], $_GET["currency2"]).' '.$_GET["currency2"];
				?>
			</div>
			<p></p>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>



<?php
function convertCurrency($amount,$from_currency,$to_currency){

	$from_Currency = urlencode($from_currency);
	$to_Currency = urlencode($to_currency);
	$query =  "{$from_Currency}_{$to_Currency}";

	$json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra");
	$obj = json_decode($json, true);

	$val = floatval($obj["$query"]);


	$total = $val * $amount;
	return number_format($total, 2, '.', '');
}
?>