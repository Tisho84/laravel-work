$(function(){
    $("#category").change(function(){
        var id = $('#category').val();
        $.ajax({
            type: 'get',
            url: 'categories/' + id
        }).done(function(result){
            var ids = Object.keys(result);
            var product = $("#product");
            product.find('option').remove();
            var count = 0;
            $.each(result, function() {
                product.append($("<option />").val(ids[count]).text(result[ids[count]]));
                count++;
            });
        });
    });

    $('#payment_type').change(function(){
        var id = $('#payment_type').val();
        $.ajax({
            type: 'get',
            url: 'type/' + id
        }).done(function(result){
            if(result == 1) {
                $('.more-info').show();
            } else {
                $('.more-info').hide();
            }
        });
    });
});

function addOrder(){
    var orderId = $('.order_id').val();
    var id = $('#product').val();
    var quantity = $('#quantity').val();
    if(id == '0') {
        alert('You must choose product');
        return;
    }
    if(!isNumeric(quantity)) {
        alert('Quantity must be number');
        return;
    }

    $.ajax({
        type: 'post',
        url: '/orders',
        data: { order: orderId, product: id, quantity: quantity, '_token': $('input[name=_token]').val()},
        dataType: 'json'
    }).done(function(result){
        alert(result.message);
    }).error(function(jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseJSON.message);
    });

}


function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}