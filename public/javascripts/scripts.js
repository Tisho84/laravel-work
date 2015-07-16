$(function(){
    $("#category").change(function(){
        var id = $('#category').val();
        $.ajax({
            type: 'get',
            url: '/ajax/categories/' + id
        }).done(function(result){
            var product = $("#product");
            product.find('option').remove();
            var count = 0;
            //product.append($('<option />')).val(0).text('-- Select --');
            var obj = {};
            obj.name = '-- Select --';
            obj.price = '';
            result[0] = obj;
            var ids = Object.keys(result);
            $.each(result, function() {
                product.append($("<option />").val(ids[count]).text(result[ids[count]].name));
                //$('.product-price').text(result[ids[count]].price);
                count++;
            });
        });
    });

    $('#product').change(function(){
       var id = $('#product').val();
        $.ajax({
            type: 'get',
            url: '/ajax/products/' + id
        }).done(function(result) {
            console.log(result);
            $('.product-price').text(result);
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