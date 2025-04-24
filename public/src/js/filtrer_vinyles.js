//JQUERY et AJAX//

$('#categorieSelect').on('change', function () {
    const categorieId = $(this).val();

    $.ajax({
        url: '../src/php/utils/filtrer_vinyles.php',
        type: 'POST',
        data: { categorie_id: categorieId },
        success: function (html) {
            $('#vinyles-container').html(html);
        },
        error: function (xhr, status, error) {
            console.error('Erreur lors du chargement des vinyles :', error);
        }
    });
});
