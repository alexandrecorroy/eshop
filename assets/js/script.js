function orderDetails(event)
{
    event.preventDefault();
    var url = $(this).attr('href');
    orderDetailsContent(url);
}

function orderDetailsContent(content)
{
    var config = { url : content };
    $.ajax(config).done(writeContent).fail(ajaxError);
}

function writeContent(data)
{

    var show = '<h4>Détail de votre commande #'+data['items'][0]['id_order']+'</h4><table class="table table-bordered"><thead><tr><th>Désignation</th><th>Prix Unitaire TTC</th><th>Quantité</th><th>Prix Total</th></tr></thead><tbody>';

    for(i=0;i<data['items'].length;i++)
    {

        var price = 0;

        price = data['items'][i]['quantity']*data['items'][i]['price_product'];

        show += '<tr><td>'+data['items'][i]['name_product']+'</td><td>'+data['items'][i]['price_product']+'€</td><td>'+data['items'][i]['quantity']+'</td><td>'+price.toFixed(2)+'€</td></tr>';

    }

    show += '</tbody></table>';

    $('#js-order-detail').html(show);

    var adress = '<h5>Adresse de livraison :</h5><p>'+data['adress']['nom']+' '+data['adress']['prenom']+'<br/><br/>'+data['adress']['adresse']+'<br/>'+data['adress']['code_postal']+' '+data['adress']['ville']+'<br>Téléphone :  '+data['adress']['telephone']+'<br/></p>';

    if(data['adress']['shipping_info']!='')
    {
        var shipping = '<p>Lien de suivi : <a href="'+data['adress']['shipping_info']+'">'+data['adress']['shipping_info']+'</a></p>';
        adress = adress+shipping;
    }

    $('#js-order-detail').append(adress);

}

function ajaxError()
{
    console.log("Erreur Ajax");
}

function showProductsBySort()
{

    var sort = $(this).val();
    var cat = $('#js-cat-number').val();
    var page = $('#js-page-number').val();

    if(page == 0)
    {
        window.location = base_url+'view/category/'+cat+'/'+sort;
    }
    else
    {
        window.location = base_url+'view/category/'+cat+'/'+sort+'?page='+page;
    }
}


$(function(){

    $('.quantityForm').change(function()
    {
        $(this).submit();
    });

    $('#js-sort').change(showProductsBySort);

    $("#search").autocomplete({
        source: base_url+"view/ajax_search/",
        select: function(event, ui)
        {
            window.location = base_url+'view/item/'+ui.item.id_product;
        }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    return $( "<li class='searchList'>" )
        .append('<img src="'+base_url+item.path+'"/><span><strong>'+item.name_product+'</strong><p>'+item.name_categorie+'</p></span>')
        .appendTo( ul )
    };

    $('.js-link').on('click', orderDetails);


});