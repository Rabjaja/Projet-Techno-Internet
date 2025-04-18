let panier = [];

function ajouterAuPanier(id) {
    fetch('../src/php/utils/ajouter_panier.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
    })
        .then(response => {
            if (!response.ok) throw new Error('Erreur serveur');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Stocke l'ID et le titre dans le panier
                panier.push({ id: id, titre: data.titre, quantite: data.quantite });
                afficherPanier();
            } else {
                alert("Erreur : " + data.error);
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'ajout au panier :", error);
        });
}

function afficherPanier() {
    const panierList = document.getElementById('panier');
    panierList.innerHTML = '';

    if (panier.length === 0) {
        panierList.innerHTML = '<li>Aucun vinyle ajouté.</li>';
    } else {
        panier.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.titre;  // Affiche uniquement le titre
            panierList.appendChild(li);
        });
    }
}

// Exporte les fonctions nécessaires pour passer la commande
function getPanier() {
    return panier;
}
