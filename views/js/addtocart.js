$(document).ready(function() {
    if($("#module-kkglasses-creator").length) {
        $("#add_to_cart").on("click", function(e) {
            $('.conditions-error').hide();
            if($('#conditions').prop('checked')) {
                addToCart();
            } else {
                $('.conditions-error').show();
            }
        });
    }
});

function addToCart() {
    let application_id = $('input[name="group[8]"]:checked').val();
    let type_id = $('input[name="group[9]"]:checked').val();
    let thickness_id = $('input[name="group[10]"]:checked').val();

    group = {
        8: application_id,
        9: type_id,
        10: thickness_id
    };

    $.ajax({
        'url': 'http://ps78.local/index.php?controller=cart',
        method: 'POST',
        dataType: 'json',
        data: {
            id_product: id_product,
            id_customization: 0,
            group: group,
            qty: 1,
            add: 1,
            action: 'update',
            token: $('input[name=token]').val()
        }
    });
}