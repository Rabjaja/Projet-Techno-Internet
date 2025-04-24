//JQUERY et AJAX//

let panier = [];

function ajouterAuPanier(id) {
    $.ajax({
        url: '../src/php/utils/ajouter_panier.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                panier.push({ id: id, titre: data.titre, quantite: data.quantite });
                afficherPanier();
            } else {
                alert("Erreur : " + data.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("Erreur lors de l'ajout au panier :", error);
        }
    });
}

function afficherPanier() {
    const $panierList = $('#panier');
    $panierList.empty();

    if (panier.length === 0) {
        $panierList.append('<li>Aucun vinyle ajouté.</li>');
    } else {
        panier.forEach(item => {
            $panierList.append('<li>' + item.titre + '</li>');
        });
    }
}

function getPanier() {
    return panier;
}
