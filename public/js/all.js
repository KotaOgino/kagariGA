$(function() {
    $('.modal-open').on('click', function() {
        $('.modal').fadeIn();
    });
    $('.modal-close').on('click', function() {
        $('.modal').fadeOut();
    });

    // 解析ページのモーダル
    $('.seoTitle').on('click', function() {
        $('.seoModal').fadeIn();
    });
    $('.seoModal-close').on('click', function() {
        $('.seoModal').fadeOut();
    });

    //サイト管理画面のプラン変更（有料へ）
    $('.kagari-btn-ad').on('click', function() {
        $('.modal-plan-edit-free').fadeIn();
    });
    $('.yen-edit-free').on('click', function() {
        $('.modal-plan-edit-free').fadeIn();
        var id = $(this).attr('kagari-id');
        var url = 'https://analysis.kagari.ai/' + id + '/payment';
        $('.change-plan-go').attr('href', url);
    });
    $('.change-plan-free-cancel').on('click', function() {
        $('.modal-plan-edit-free').fadeOut();
    });

    // サイト管理画面のプラン変更（無料）
    $('.yen-edit').on('click', function() {
        $('.modal-plan-edit').fadeIn();
        $('.plan-edit-form [name="id"]').val($(this).attr('kagari-id'));
    });
    $('.change-plan-cancel').on('click', function() {
        $('.modal-plan-edit').fadeOut();
    });
});