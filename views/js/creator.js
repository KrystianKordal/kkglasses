$(document).ready(function() {
    useCardEvent();
    tooltipEvent();
    pdEvent();
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