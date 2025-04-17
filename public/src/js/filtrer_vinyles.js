
document.getElementById('categorieSelect').addEventListener('change', function () {
    const categorieId = this.value;

    fetch('../src/php/utils/filtrer_vinyles.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'categorie_id=' + encodeURIComponent(categorieId)
    })
        .then(response => response.text())
        .then(html => {
            document.getElementById('vinyles-container').innerHTML = html;
        })
        .catch(error => {
            console.error('Erreur lors du chargement des vinyles:', error);
        });
});

