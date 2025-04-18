function passerCommande(id) {
    const userId = id;

    if (panier.length === 0) {
        alert("Votre panier est vide.");
    } else {
        console.log("ID Utilisateur :", userId);
        console.log("Panier :", panier);

        // Ajouter la quantité pour chaque vinyle dans le panier
        const vinylesIds = panier.map(item => {
            if (!item.id || !item.quantite) {
                console.error("Vinyle sans ID ou quantité:", item);
                alert("Un vinyle dans votre panier n'a pas d'ID ou de quantité.");
                return null; // Retourne null si l'id ou la quantité est manquante
            }
            return { id: item.id, titre: item.titre, quantite: item.quantite }; // Envoie id, titre, et quantite
        }).filter(item => item !== null); // Filtrer les valeurs nulles

        if (vinylesIds.length === 0) {
            alert("Votre panier contient des éléments invalides.");
            return;
        }

        // Envoi des données au serveur
        fetch('../src/php/utils/passer_commande.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: userId, vinyles: vinylesIds })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Commande passée avec succès!');
                    panier = [];
                    afficherPanier();
                } else {
                    alert('Erreur lors de la commande : ' + data.error);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la commande :', error);
                alert('Une erreur est survenue lors de la commande.');
            });
    }
}
