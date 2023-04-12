<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test Comiti</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
	<h1 class="text-center mb-5">Devis Comiti</h1>
	<?php
		require 'functions.php';

		// Get values from the form
		$adherents = $_POST['adherents'];
		$sections = $_POST['sections'];
		$federation = $_POST['federation'];

		$resultat = calculateEstimate($adherents, $sections, $federation);
	?>
	<div class="container">
		<h2 class="mb-4">Récapitulatif du devis</h2>
		<div class="row mb-5">
			<div class="col-md-4">
				<h3 class="lead">Prix total HT / mois:</h3>
				<p class="lead"><strong><?php echo $resultat["priceWithReduction"]; ?> euros</strong></p>
			</div>
			<div class="col-md-4">
				<h3 class="lead">Prix total TTC / mois:</h3>
				<p class="lead"><strong><?php echo $resultat["priceWithTVA"]; ?> euros</strong></p>
			</div>
			<div class="col-md-4">
				<h3 class="lead">Prix total TTC / an:</h3>
				<p class="lead"><strong><?php echo $resultat["yearlyPrice"]; ?> euros</strong></p>
			</div>
		</div>
		<h2 class="mb-4">Bonus</h2>
		<div class="row">
			<div class="col-md-4">
			<h3 class="lead">Prix total HT / mois:</h3>
			<p class="lead"><strong><?php echo $resultat["priceWithReduction_bonus"]; ?> euros</strong></p>
			</div>
			<div class="col-md-4">
			<h3 class="lead">Prix total TTC / mois:</h3>
			<p class="lead"><strong><?php echo $resultat["priceWithTVA_bonus"]; ?> euros</strong></p>
			</div>
			<div class="col-md-4">
			<h3 class="lead">Prix total TTC / an:</h3>
			<p class="lead"><strong><?php echo $resultat["yearlyPrice_bonus"]; ?> euros</strong></p>
			</div>
		</div>	
	</div>

</div>
</body>
</html>


