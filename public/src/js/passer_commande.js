//JQUERY et AJAX//

function passerCommande(id) {
    const userId = id;

    if (panier.length === 0) {
        alert("Votre panier est vide.");
    } else {
        console.log("ID Utilisateur :", userId);
        console.log("Panier :", panier);

        const vinylesIds = panier.map(item => {
            if (!item.id || !item.quantite) {
                console.error("Vinyle sans ID ou quantité:", item);
                alert("Un vinyle dans votre panier n'a pas d'ID ou de quantité.");
                return null;
            }
            return { id: item.id, titre: item.titre, quantite: item.quantite };
        }).filter(item => item !== null);

        if (vinylesIds.length === 0) {
            alert("Votre panier contient des éléments invalides.");
            return;
        }

        $.ajax({
            url: '../src/php/utils/passer_commande.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ user_id: userId, vinyles: vinylesIds }),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    alert('Commande passée avec succès!');
                    panier = [];
                    afficherPanier();
                } else {
                    alert('Erreur lors de la commande : ' + data.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur lors de la commande :', error);
                alert('Une erreur est survenue lors de la commande.');
            }
        });
    }
}
