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