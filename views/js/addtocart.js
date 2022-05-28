$(document).ready(function() {
    if($("#module-kkglasses-creator").length) {
        $("#add_to_cart").on("click", function(e) {
            createCustomization().then(res => {
                getCustomizationId().then(res => {
                    addToCart(res.id_customization);
                })
            })
        });
    }
});

function addToCart(id_customization) {
    if(validateForm()) {
        let data = getAddToCartData(id_customization);
        $.ajax({
            method: 'POST',
            url: prestashop.urls.pages.cart,
            data: data
        }).done(function(){
            window.location.href = prestashop.urls.pages.cart;
        });
    }
}

function validateForm() {
    let validForm = true;

    $('.error-msg').hide();
    if(!$('#conditions').prop('checked')) {
        $('.conditions-error').show();
        validForm = false;
    }

    if(!$('.type-radio:checked').length) {
        $('.type-error').show();
        validForm = false;
    }  

    if(!$('.use-radio:checked').length) {
        $('.use-error').show();
        validForm = false;
    }  

    if(!$('.thin-radio:checked').length) {
        $('.thin-error').show();
        validForm = false;
    }  

    $('.correction-input').each(function() {
        if($(this).val() == '') {
            $('.correction-error').show();
            validForm = false;
        }
    })

    if($('#pd_l').val() == '' || $('#pd_p').val() == '') {
        $('.spacing-error').show();
        validForm = false;
    }

    if(!validForm) {
        $('.all-error').show();
    }

    return validForm;
}

function getAddToCartData(id_customization) {
        let application_id = $('input[name="group[8]"]:checked').val();
        let type_id = $('input[name="group[9]"]:checked').val();
        let thickness_id = $('input[name="group[10]"]:checked').val();
    
        let group = {
            8: application_id,
            9: type_id,
            10: thickness_id
        };

        return {
            id_product: id_product,
            id_customization: id_customization,
            group: group,
            qty: 1,
            add: 1,
            action: 'update',
            token: $('input[name=token]').val(),
        };
}

function createCustomization() {
    return new Promise((resolve) => {
        $.ajax({
            method: 'POST',
            url: prestashop.urls.pages.product,
            data: getCreateCustomizationData(),
        }).always(function(res) {
            resolve(res);
        });
    });
}

function getCustomizationId() {
    return new Promise( resolve => {
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: customization_ajax,
            data: {
                id_product: id_product
            }
        }).done(function(res) {
            resolve(res.id_customization);
        });
    });
}

function getCreateCustomizationData() {
    let data = {
        id_product: id_product,
        id_product_attribute: 0,   
        submitCustomizedData: 1,
        token: $('input[name=token]').val(),
        ajax: 1
    }

    let correction_str = getCorrectionStr();
    let spacing_str = getSpacingStr();

    data[`textField${customization_fields.correction}`] = correction_str;
    data[`textField${customization_fields.spacing}`] = spacing_str;

    return data;
}

function getCorrectionStr() {
    let strength_r = $("#strength_r").val();
    let cylinder_r = $("#cylinder_r").val();
    let axis_r = $("#axis_r").val();
    let strength_l = $("#strength_l").val();
    let cylinder_l = $("#cylinder_l").val();
    let axis_l = $("#axis_l").val();

    return `
        Oko prawe - moc: ${strength_r}, cylinder: ${cylinder_r}, oś: ${axis_r}
        Oko lewe - moc: ${strength_l}, cylinder: ${cylinder_l}, oś: ${axis_l}
    `;
}

function getSpacingStr() {
    let spacing_r = $('#pd_p').val();
    let spacing_l = $('#pd_l').val();

    return `Oko prawe: ${spacing_r}, Oko lewe: ${spacing_l}`;
}