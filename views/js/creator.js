$(document).ready(function() {
    useCardEvent();
    tooltipEvent();
    pdEvent();
    calculatePriceEvent();
    calculatePrice();
});

function useCardEvent() {
    $('.kkglasses-card').on("click", function() {
        $('.kkglasses-card').removeClass('active');
        $(this).addClass('active');
    });
}

function tooltipEvent() {
    $('.tooltip-trigger').on("mouseover", function() {
        $(this).parent().find('.kkglasses-tooltip').fadeIn(200);
    });

    $('.tooltip-trigger').on('mouseleave', function() {
        $(this).parent().find('.kkglasses-tooltip').fadeOut(200);
    });
}

function pdEvent() {
    $('#same_spacing').on("click", function() {
        $('#different_spacing_container').hide();
        $('#same_spacing_container').show();
    });

    $('#different_spacing').on("click", function() {
        $('#different_spacing_container').show();
        $('#same_spacing_container').hide();
    });

    $('#pd_same').on('input', function() {
        let val = $(this).val();
        $('#pd_l').val(val);
        $('#pd_p').val(val);
    });
}

function calculatePriceEvent() {
    $('.type-radio').on("change", calculatePrice);
    $('.thin-radio').on("change", calculatePrice);
}

function calculatePrice() {
    let type_price = $('.type-container input:checked').data('price');
    let thin_price = $('.thin-container input:checked').data('price');

    let frame_price = Number($('#frame_price').data('price'));
    let lenses_price = Number(type_price + thin_price);
    let total_price = Number(lenses_price + frame_price);

    $('#lenses_price').html(formatPrice(lenses_price));
    $('#total_price').html(formatPrice(total_price));
}

function formatPrice(price) {
    let formatted_price = price.toFixed(2);
    formatted_price = formatted_price.toString();
    formatted_price = formatted_price.replace('.', ',');
    formatted_price += " " + prestashop.currency.sign; 
    return formatted_price;
}

