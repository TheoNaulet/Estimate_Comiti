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

        // Get les values from the form
        $adherents = $_POST['adherents'];
        $sections = $_POST['sections'];
        $federation = $_POST['federation'];

        $resultat = calculateEstimate($adherents, $sections, $federation);
    ?>
    <div class="container">
        <h2>Récapitulatif du devis</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
            <p class="lead">Prix des adhérents : <strong><?php echo $resultat["adherentsPrice"]; ?> euros</strong></p>
            </div>
            <div class="col-md-6">
            <p class="lead">Prix des sections : <strong><?php echo $resultat["sectionPrice"]; ?> euros</strong></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p class="lead">Prix total HT / mois: <strong><?php echo $resultat["priceWithReduction"]; ?> euros</strong></p>
                <p class="lead">Prix total TTC / mois: <strong><?php echo round($resultat["priceWithTVA"], 2); ?> euros</strong></p>
                <p class="lead">Prix total TTC / an: <strong><?php echo round($resultat["yearlyPrice"], 2); ?> euros</strong></p>
            </div>
        </div>
        <h2>Bonus</h2>
        <div class="row">
            <div class="col-md-12">
                <p class="lead">Prix total HT / mois: <strong><?php echo $resultat["priceWithReduction_bonus"]; ?> euros</strong></p>
                <p class="lead">Prix total TTC / mois: <strong><?php echo round($resultat["priceWithTVA_bonus"], 2); ?> euros</strong></p>
                <p class="lead">Prix total TTC / an: <strong><?php echo round($resultat["yearlyPrice_bonus"], 2); ?> euros</strong></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>


