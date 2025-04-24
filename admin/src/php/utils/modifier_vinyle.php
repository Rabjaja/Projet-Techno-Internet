<?php
require_once '../classes/VinyleDAO.php';
require_once '../classes/CategorieDAO.php';

$vinyleDAO = new VinyleDAO();
$categorieDao = new CategorieDao();
$categories = $categorieDao->getAllCategories();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $vinyle = $vinyleDAO->getVinyleById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $quantite = $_POST['quantite'];
    $image = $_POST['image'];
    $categorie_id = $_POST['categorie'];

    $vinyleDAO->updateVinyle($id, $titre, $description, $prix, $quantite, $image, $categorie_id);
    header("Location: ../../../content/admin_vinyles.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Vinyle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modifier un Vinyle</h1>

        <form method="POST" class="form-group">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre:</label>
                <input type="text" class="form-control" name="titre" value="<?php echo $vinyle['titre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" name="description" required><?php echo $vinyle['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix:</label>
                <input type="number" class="form-control" name="prix" value="<?php echo $vinyle['prix']; ?>" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantite:</label>
                <input type="number" class="form-control" name="quantite" value="<?php echo $vinyle['quantite']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image (URL ou nom de fichier):</label>
                <input type="text" class="form-control" name="image" value="<?php echo $vinyle['image_url']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Categorie:</label>
                <select name="categorie" class="form-control" required>
                    <option value="">Selectionner une categorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id']; ?>"
                        <?php echo ($vinyle['categorie_id'] == $categorie['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categorie['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre a jour</button>
        </form>

    </div>
</body>
</html>
