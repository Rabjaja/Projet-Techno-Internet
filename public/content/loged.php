<?php
session_start();

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique de Vinyles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #panier-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 15px;
            border-radius: 8px;
            z-index: 1000;
            width: 260px;
            box-shadow: 0 0 10px rgba(0,0,0,0.6);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body class="bg-dark text-white">

    <!-- Panier -->
    <div id="panier-container">
        <h5>🛒 Mon Panier</h5>
        <ul id="panier" class="list-unstyled mb-2">
            <li>Aucun vinyle ajouté.</li>
        </ul>
        <button class="btn btn-success btn-sm btn-block" onclick="afficherCommande()">Passer la commande</button>
    </div>

    <div class="container py-4">
        <!-- En-tête utilisateur -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4>Bienvenue, <?= htmlspecialchars($username) ?> !</h4>
                <small><?= htmlspecialchars($email) ?></small>
            </div>
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger">Déconnexion</button>
            </form>
        </div>

        <!-- Titre principal -->
        <h2 class="text-center mb-5">Explorez notre collection de vinyles</h2>

        <!-- Vinyles -->
        <div class="row" id="vinyles-container">
            <!-- JS générera les cartes ici -->
        </div>
    </div>

    <script>
        const panier = [];

        const vinyles = [
            { titre: 'Rock', desc: 'Du pur rock sur vinyle.', img: 'https://via.placeholder.com/300x180?text=Rock' },
            { titre: 'Jazz', desc: 'Les plus grands standards de jazz.', img: 'https://via.placeholder.com/300x180?text=Jazz' },
            { titre: 'Électro', desc: 'Des beats électro immersifs.', img: 'https://via.placeholder.com/300x180?text=Electro' },
            { titre: 'Pop', desc: 'Les classiques de la pop.', img: 'https://via.placeholder.com/300x180?text=Pop' },
            { titre: 'Classique', desc: 'Œuvres intemporelles.', img: 'https://via.placeholder.com/300x180?text=Classique' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
            { titre: 'Funk', desc: 'Groove et énergie.', img: 'https://via.placeholder.com/300x180?text=Funk' },
        ];

        function afficherVinyles() {
            const container = document.getElementById('vinyles-container');
            vinyles.forEach((v, i) => {
                container.innerHTML += `
                    <div class="col-md-4 mb-4">
                        <div class="card bg-secondary text-white">
                            <img src="${v.img}" class="card-img-top" alt="${v.titre}">
                            <div class="card-body">
                                <h5 class="card-title">${v.titre}</h5>
                                <p class="card-text">${v.desc}</p>
                                <button class="btn btn-primary mt-auto" onclick="ajouterAuPanier('${v.titre}')">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function ajouterAuPanier(vinyle) {
            panier.push(vinyle);
            afficherPanier();
        }

        function afficherPanier() {
            const panierList = document.getElementById('panier');
            panierList.innerHTML = '';

            if (panier.length === 0) {
                panierList.innerHTML = '<li>Aucun vinyle ajouté.</li>';
            } else {
                panier.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;
                    panierList.appendChild(li);
                });
            }
        }

        function afficherCommande() {
            if (panier.length === 0) {
                alert("Votre panier est vide.");
            } else {
                alert("Commande passée : " + panier.join(', '));
                panier.length = 0;
                afficherPanier();
            }
        }

        afficherVinyles();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
