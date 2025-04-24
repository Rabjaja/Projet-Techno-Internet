<?php
session_start();
require_once '../src/php/classes/VinyleDAO.php';
require_once '../src/php/classes/CategorieDAO.php';

$vinyleDAO = new VinyleDAO();
$categorieDAO = new CategorieDao();

$categories = $categorieDAO->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite'];
        $image = $_POST['image'];
        $categorieId = $_POST['categorie'];
        
        $vinyleDAO->addVinyle($titre, $description, $prix, $quantite, $image, $categorieId);
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $vinyleDAO->deleteVinyle($id);
    }
}

$vinyles = $vinyleDAO->getAllVinyles();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Vinyles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestion des Vinyles</h1>
        <a href="dashboard.php" class="btn btn-primary">Retour</a>

        <h2>Ajouter un vinyle</h2>
        <form method="POST" class="form-group">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre:</label>
                <input type="text" class="form-control" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix:</label>
                <input type="number" class="form-control" name="prix" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantite:</label>
                <input type="number" class="form-control" name="quantite" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">URL:</label>
                <input type="text" class="form-control" name="image" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Categorie:</label>
                <select name="categorie" class="form-control" required>
                    <option value="">Selectionner une categorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id']; ?>">
                            <?php echo htmlspecialchars($categorie['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
        </form>


        <h2 class="mt-5">Liste des Vinyles</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Quantite</th>
                    <th>Categorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vinyles as $vinyle): ?>
                    <tr>
                        <td><?php echo $vinyle['id']; ?></td>
                        <td><?php echo $vinyle['titre']; ?></td>
                        <td><?php echo $vinyle['prix']; ?> 	&#8364;</td>
                        <td><?php echo $vinyle['quantite']; ?></td>
                        <td>
                        <?php
                            $categorie_nom = '';
                            foreach ($categories as $categorie) {
                                if ($vinyle['categorie_id'] == $categorie['id']) {
                                    $categorie_nom = $categorie['nom'];
                                    break;
                                }
                            }
                            echo htmlspecialchars($categorie_nom);
                            ?>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $vinyle['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Supprimer</button>
                                <a href="../src/php/utils/modifier_vinyle.php?id=<?php echo $vinyle['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
