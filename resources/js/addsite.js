$(function() {

    // サイト追加
    $('.pulldown-a>span').on('click', function() {
        $(this).next('form').slideToggle('fast');
    });

    // Search Consoleのサイト情報取得
    $('.kagari-btn-sm').on('click', function() {
        // event.preventDefault();
        // const limit = $(this).attr('limit');
        // const start = $(this).attr('start');
        // const end = $(this).attr('end');
        // const url = $(this).attr('url');
        // const content_url = $(this).attr('content_url');
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //         url: $(this).attr('action'),
        //         type: 'GET',
        //         datatype: 'json',
        //
        //         data: {
        //             limit: limit,
        //             start: start,
        //             end: end,
        //             url: url,
        //             content_url: content_url,
        //         }
        //     })
        //     .done(function(data) {
        //         if (url == data) {
        //             $('.result_url span').text(data);
        //             $('.result_url span').addClass('orange-color');
        //             $('.kagari-btn-md').css('background-color', '#e6830b');
        //             $("#kagari-btn-md").attr('disabled', false);
        //         } else {
        //             $('.result_url span').text('Search Consoleが設定されていないようです。');
        //             $('.result_url span').removeClass('orange-color');
        //         }
        //     })
        //     .fail(function(data) {
        //         console.log('通信エラーが発生しました');
        //     });
        $('.kagari-btn-md').css('background-color', '#e6830b');
        $("#kagari-btn-md").attr('disabled', false);
        var siteName = $(this).parent().find('#site-name').val();
        var genre = $(this).parent().find('#site_genre').val();
        var view_id = $(this).parent().find('#view_id').val();
        var plan = $(this).parent().find('#plan').val();
        var url = $(this).attr('url');
        $('input[name="site_name"]').val(siteName);
        $('input[name="genre"]').val(genre);
        $('input[name="view_id"]').val(view_id);
        $('input[name="url"]').val(url);
        $('input[name="plan"]').val(plan);
    });

    var $searchInput = $('#ga-search');
    var $searchElem = $('.site-account li');
    var excludedClass = 'is-excluded';

    function extraction() {
        var keywordArr = $searchInput.val().toLowerCase().replace('　', ' ').split(' ');
        $searchElem.removeClass(excludedClass).show();
        for (var i = 0; i < keywordArr.length; i++) {
            for (var j = 0; j < $searchElem.length; j++) {
                var thisString = $searchElem.eq(j).text().toLowerCase();
                if (thisString.indexOf(keywordArr[i]) == -1) {
                    $searchElem.eq(j).addClass(excludedClass);
                }
            }
        }
        $('.' + excludedClass).hide();
    }
    $searchInput.on('load keyup blur', function() {
        extraction();
    });
});
