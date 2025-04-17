let panier = [];

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
        panier.forEach(v => {
            const li = document.createElement('li');
            li.textContent = v;
            panierList.appendChild(li);
        });
    }
}

function afficherCommande() {
    if (panier.length === 0) {
        alert("Votre panier est vide.");
    } else {
        alert("Commande passée pour :\n" + panier.join(', '));
        panier = [];
        afficherPanier();
    }
}