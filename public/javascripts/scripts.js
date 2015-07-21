//$(function(){
//    $("#category").change(function(){
//        alert('here');
//        var id = $('#category').val();
//        $.ajax({
//            type: 'get',
//            url: '/ajax/categories/' + id
//        }).done(function(result){
//            var product = $("#product");
//            product.find('option').remove();
//            var count = 0;
//            //product.append($('<option />')).val(0).text('-- Select --');
//            var obj = {};
//            obj.name = '-- Select --';
//            obj.price = '';
//            result[0] = obj;
//            var ids = Object.keys(result);
//            $.each(result, function() {
//                product.append($("<option />").val(ids[count]).text(result[ids[count]].name));
//                //$('.product-price').text(result[ids[count]].price);
//                count++;
//            });
//        });
//    });
//
//    $('#product').change(function(){
//       var id = $('#product').val();
//        $.ajax({
//            type: 'get',
//            url: '/ajax/products/' + id
//        }).done(function(result) {
//            console.log(result);
//            $('.product-price').text(result);
//        });
//    });
//});
$(function() {
    //$(".single-repeat:first").find('button').remove();
});

function addOrder() {
    var clone = $(".single-repeat:first").clone();
    clone.find('input:text').each(function () {
        $(this).val('');
    });

    clone.find('select').each(function () {
        $(this).val(0);
    });

    clone.find('div.remove-button').removeClass('hidden');

    clone.insertAfter("div.single-repeat:last");
}

function removeOrder(button) {
    var buttonObj = $(button);
    buttonObj.closest('div.single-repeat').remove();
}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}