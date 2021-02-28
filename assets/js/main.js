$(document).ready(function () {
    $('[data-confirm]').on('click', function(e) {
        e.preventDefault(); //Annuler l'action par défaut
        //Récupérer la valeur de l'attribut href
        var href = $(this).attr('href');
        //Récupérer la valeur de l'attribut data-confirm
        var message = $(this).data('confirm');
        //On aurait pu écrire aussi
        //var message = $(this).attr('data-confirm');
        //Afficher la popup SweetAlert
        swal({
            title: "Êtes-vous sûre?",
            text: message, //Utiliser la valeur de data-confirm comme text
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Non",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Oui",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }

        })
            .then((willDelete) => {
            if (willDelete) {
            window.location.href = href;
        } else {
            swal({
                text:"Votre publication n'a pas été supprimée!",
                icon: "info",
                buttons: false
            });
        }
    });
});
var url = 'ajax/search.php';
$('input#searchbox').on('keyup', function () {
    var query = $(this).val();
    if (query.length > 0) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                query: query
            },
            beforeSend:function(){
                $("#spinner").show();
            },
            success: function (html) {
                $("#spinner").hide();
                $("#display-results").html(html).show();
            }
        });
    }else{
        $("#display-results").hide();
    }
});
});



