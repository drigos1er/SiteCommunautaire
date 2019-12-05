/*
---Gestion des images----
 */

// Action de clique sur le bouton d'ajout de l'image
$('#trick_image').click(function () {
    // Recupération du  numéro du widget grâce à la valeur du champs hidden convertit en nombre grâce au +
    const index= +$('#cpt-widget').val();
    // Recuperation  le prototype  des entrées
    const proto= $('#tricks_image').data('prototype').replace(/_name_/g, index);



    // Ajout deu prototype dans la Div
    $('#tricks_image').append(proto);
    // incrementer la valeur du numéro du widget après la création d'un widget

    $('#cpt-widget').val(index + 1);
    //Gestion du bouton de suppression
    deleteBlocManagement();
});


//fonction de gestion de suppression de Bloc
function deleteBlocManagement()
{
    $('button[data-action="delete"]').click(function () {
        //Permet d'acceder à l'id  bloc avec le outton d'attribut data-target
        const target= this.dataset.target;

        //Suppression du bloc
        $(target).remove();
    });
}



//fonction de mise à jour du compteur de bloc
function updatecountbloc()
{

    const countbloc= +$('#trick_image div.form-group').length;

    //Mise à jour du compteur de  bloc
    $('#cpt-widget').val(countbloc);


}

//Appel du bouton de Mise à jour du comteur de Bloc

updatecountbloc();


//Appel du bouton de suppresion au chargement de la page

deleteBlocManagement();


/*
---Gestion des vidéos----
 */

// Action de clique sur le bouton d'ajout de vidéo
$('#trick_video').click(function () {
    // Recupération du  numéro du widget grâce à la valeur du champs hidden convertit en nombre grâce au +
    const indexvi= +$('#cpt-widgetvi').val();
    // Recuperation  le prototype  des entrées
    const protovi= $('#tricks_video').data('prototype').replace(/_name_/g, indexvi);



    // Ajout deu prototype dans la Div
    $('#tricks_video').append(protovi);
    // incrementer la valeur du numéro du widget après la création d'un widget

    $('#cpt-widgetvi').val(indexvi + 1);
    //Gestion du bouton de suppression
    deleteBlocviManagement();
});


//fonction de gestion de suppression de Bloc
function deleteBlocviManagement()
{
    $('button[data-action="deletevi"]').click(function () {
        //Permet d'acceder à l'id  bloc avec le outton d'attribut data-target
        const targetvi= this.dataset.target;

        //Suppression du bloc
        $(targetvi).remove();
    });
}



//fonction de mise à jour du compteur de bloc
function updatecountblocvi()
{

    const countblocvi= +$('#trick_video div.form-group').length;

    //Mise à jour du compteur de  bloc
    $('#cpt-widgetvi').val(countblocvi);


}

//Appel du bouton de Mise à jour du comteur de Bloc

updatecountblocvi();


//Appel du bouton de suppresion au chargement de la page

deleteBlocviManagement();