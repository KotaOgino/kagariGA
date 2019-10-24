$(function() {
    // 改善項目の管理
    $('.persession').attr('data-content', 'ページ/セッションに課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/sessions/" target="_blank">改善方法をみる</a>');
    $('.pagetime').attr('data-content', '平均ページ滞在時間に課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/page-stay-time/" target="_blank">改善方法をみる</a>');
    $('.goodbye').attr('data-content', '直帰率に課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/bounce-rate/" target="_blank">改善方法をみる</a>');
    $('.click').attr('data-content', 'クリック数に課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/clicks/" target="_blank">改善方法をみる</a>');
    $('.ctr-td').attr('data-content', 'CTRに課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/ctr/" target="_blank">改善方法をみる</a>');
    $('.position').attr('data-content', '掲載順位に課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/position/" target="_blank">改善方法をみる</a>');
    $('.display-td').attr('data-content', '表示回数に課題があります。<br><br><a class="orange-color" href="https://kagari.ai/blog/impressions/" target="_blank">改善方法をみる</a>');

    // 課題ハイライト
    $('.scopeOn').on('click', function() { // on
        $(this).addClass('orange-back');
        if ($('.scopeOff').hasClass('orange-back')) {
            $('.scopeOff').removeClass('orange-back');
        }
        $('.alert-back').addClass('active');
    });
    $('.scopeOff').on('click', function() { // off
        $(this).addClass('orange-back');
        if ($('.scopeOn').hasClass('orange-back')) {
            $('.scopeOn').removeClass('orange-back');
        }
        $('td').removeClass('active');
    });
});