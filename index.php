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
        <form action="devis.php" method="post">
            <div class="mb-3">
                <label for="adherents" class="form-label">Nombre d'adhérents</label>
                <input type="number" class="form-control" id="adherents" name="adherents" required>
            </div>
            <div class="mb-3">
                <label for="sections" class="form-label">Nombre de sections</label>
                <input type="number" class="form-control" id="sections" name="sections" required>
            </div>
            <div class="mb-3">
                <label for="federation" class="form-label">Fédération</label>
                <select class="form-control" id="federation" name="federation" required>
                    <option value="">Choisissez une fédération</option>
                    <option value="N">Natation</option>
                    <option value="G">Gymnastique</option>
                    <option value="B">Basketball</option>
                    <option value="A">Autre</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</body>
</html>
