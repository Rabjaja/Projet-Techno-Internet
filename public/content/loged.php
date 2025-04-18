<?php
session_start();
require_once '../../admin/src/php/classes/VinyleDAO.php';
require_once '../../admin/src/php/classes/CategorieDAO.php';
require_once '../../admin/src/php/classes/CommandeDAO.php';  // Ajoutez cette ligne pour inclure CommandeDAO

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$id = $_SESSION['user']['id'];

$vinyleDAO = new VinyleDAO();
$categorieDAO = new CategorieDAO();
$commandeDAO = new CommandeDAO();  // Instancie CommandeDAO

$vinyles = $vinyleDAO->getAllVinyles();
$categories = $categorieDAO->getAllCategories();
$commandes = $commandeDAO->getCommandesByUserId($id);  // Récupère les commandes de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La Boutique</title>
    <link rel="stylesheet" href="../assets/css/loged.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<div id="panier-container">
    <h5> Mon Panier</h5>
    <ul id="panier" class="list-unstyled mb-2">
        <li>Aucun vinyle ajouté.</li>
    </ul>
    <button class="btn btn-success btn-sm btn-block" onclick="passerCommande(<?php echo $id ?>)">Passer la commande</button>
</div>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>Bienvenue, <?= htmlspecialchars($username) ?> !</h4>
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger">Déconnexion</button>
            </form>
        </div>
    </div>

    <!-- Afficher les commandes de l'utilisateur -->
    <h4 class="text-center mb-4">Vos Commandes</h4>
    <div class="row">
        <?php if (empty($commandes)): ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    Aucune commande passée.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($commandes as $commande): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Commande ID: <?= htmlspecialchars($commande['commande_id']) ?></h5>
                            <p class="card-text">Date de la commande : <?= date('d F Y à H:i', strtotime($commande['created_at'])) ?></p>

                            <!-- Lien vers la page de détails de la commande -->
                            <a href="commande_details.php?commande_id=<?= htmlspecialchars($commande['commande_id']) ?>" class="btn btn-info btn-sm" target="_blank">Voir les détails</a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


    <!-- Barre de recherche et filtres -->
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <select id="categorieSelect" class="form-control">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['nom']?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row" id="vinyles-container">
        <?php foreach ($vinyles as $vinyle): ?>
            <div class="col-md-4 mb-4 vinyle-card" data-categorie="<?= htmlspecialchars($vinyle['categorie_id']) ?>">
                <div class="card bg-secondary text-white">
                    <img src="<?= htmlspecialchars($vinyle['image_url']) ?>" class="card-img-top" alt="Vinyle">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($vinyle['titre']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($vinyle['description']) ?></p>
                        <p><strong><?= htmlspecialchars($vinyle['prix']) ?> &#x20AC</strong></p>
                        <p><?= htmlspecialchars($vinyle['quantite']) ?> en stock</p>
                        <button class="btn btn-primary" onclick="ajouterAuPanier(<?= $vinyle['id'] ?>)">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="../src/js/panier.js"></script>
<script src="../src/js/filtrer_vinyles.js"></script>
<script src="../src/js/passer_commande.js"></script>

</body>
</html>
