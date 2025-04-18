<?php
require_once '../../../../admin/src/php/classes/VinyleDAO.php';

$vinyleDAO = new VinyleDAO();

$categorieId = $_POST['categorie_id'] ?? '';

if ($categorieId === '') {
    $vinyles = $vinyleDAO->getAllVinyles();
} else {
    $vinyles = $vinyleDAO->getVinylesByCategorie((int)$categorieId);
}

foreach ($vinyles as $vinyle): ?>
    <div class="col-md-4 mb-4 vinyle-card">
        <div class="card bg-secondary text-white h-100 d-flex flex-column">
            <img src="<?= htmlspecialchars($vinyle['image_url']) ?>" class="card-img-top" alt="Vinyle">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title"><?= htmlspecialchars($vinyle['titre']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($vinyle['description']) ?></p>
                </div>
                <div>
                    <p><strong><?= htmlspecialchars($vinyle['prix']) ?> &#x20AC</strong></p>
                    <p><?= htmlspecialchars($vinyle['quantite']) ?> en stock</p>
                    <button class="btn btn-primary" onclick="ajouterAuPanier(<?= $vinyle['id'] ?>)">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
