/**
 * Created by alex on 21/03/2015.
 */
function orderDetails(event)
{
    event.preventDefault();
    orderDetailsContent();
}

function orderDetailsContent()
{
    var config = { url : base_url+'admin/indexAjax' };
    $.ajax(config).done(writeContent).fail(ajaxError);
}

function writeContent(data)
{

    $('#js-refresh-data').html('<div class="alert alert-info js-update">Mise à jour effectuée.</div><ul class="site-stats"><li><i class="fa fa-refresh"></i><strong>'+data["countUnvalidateOrders"]+'</strong> <small>Commandes à valider</small></li><li><i class="fa fa-truck"></i><strong>'+data["countUnsendOrders"]+'</strong> <small>Commandes à envoyer</small></li><li><i class="icon-user"></i> <strong>'+data["countUsers"]+'</strong> <small>Utilisateurs</small></li><li><i class="icon-arrow-right"></i> <strong>'+data["countUsersToday"]+'</strong> <small>Nouveaux utilisateurs (dernières 24h)</small></li><li><i class="icon-shopping-cart"></i> <strong>'+data["countOrdersToday"]+'</strong> <small>Commandes sur les derniers 24h</small></li><li><i class="icon-tag"></i> <strong>'+data["countOrders"]+'</strong> <small>Commandes au total</small></li></ul>');
    $('.js-update').fadeOut(2500);
}

function ajaxError()
{
    console.log("Erreur Ajax");
}

$(function(){

    $('#js-refresh').on('click', orderDetails);

});