// 横スクロール
$(function() {
    var div = $('.scrollLeft');
    var th = $('.scrollLeft #table thead tr:nth-child(2) th').eq(3).outerWidth();
    var th3 = th * 2;
    var seobtn = $(div).outerWidth() - th3;
    var snsbtn = $(div).outerWidth();

    $('.seoButton').on('click', function() {
        div.animate({
            scrollLeft: 0
        });
        $(this).addClass('orange-back');
        $('.access-th').removeAttr('style', '');
        $('.seo-th').css({
            'color': '#FC8C06',
            'background-color': '#fff9f0',
            'border-left': 'solid 2px #FC8C06'
        });
        $('.sns-th').removeAttr('style', '');
        if ($('.accessBotton').hasClass('orange-back')) {
            $('.accessBotton').removeClass('orange-back');
        }
        if ($('.snsButton').hasClass('orange-back')) {
            $('.snsButton').removeClass('orange-back');
        }
    });
    $('.snsButton').on('click', function() {
        div.animate({
            scrollLeft: seobtn
        });
        $(this).addClass('orange-back');
        $('.access-th').removeAttr('style', '');
        $('.seo-th').removeAttr('style', '');
        $('.sns-th').css({
            'color': '#FC8C06',
            'background-color': '#fff9f0',
            'border-left': 'solid 2px #FC8C06'
        });
        if ($('.accessBotton').hasClass('orange-back')) {
            $('.accessBotton').removeClass('orange-back');
        }
        if ($('.seoButton').hasClass('orange-back')) {
            $('.seoButton').removeClass('orange-back');
        }
    });
    $('.accessBotton').on('click', function() {
        div.animate({
            scrollLeft: snsbtn
        });
        $(this).addClass('orange-back');
        $('.access-th').css({
            'color': '#FC8C06',
            'background-color': '#fff9f0',
            'border-left': 'solid 2px #FC8C06'
        });
        $('.seo-th').removeAttr('style', '');
        $('.sns-th').removeAttr('style', '');
        if ($('.seoButton').hasClass('orange-back')) {
            $('.seoButton').removeClass('orange-back');
        }
        if ($('.snsButton').hasClass('orange-back')) {
            $('.snsButton').removeClass('orange-back');
        }
    });
});