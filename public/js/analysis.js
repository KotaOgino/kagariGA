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
$(function() {
    // テーブルソート
    var table_sort = $('#table').tablesorter();

    // ページごとのSEOデータ取得
    $('button.reportExport, .scopeOn, .comparOn').css({
        'cursor': 'wait',
        'background-color': '#eee',
    });
    $('button.reportExport').attr('disabled');
    var content_url = $('#json_kagari').val().replace('[', '').replace(']', '').split(',');
    let url = $('#json_kagari').attr('kagariUrl');
    let start = $('#json_kagari').attr('kagari_start');
    let end = $('#json_kagari').attr('kagari_end');
    let action = $('#json_kagari').attr('action');
    let number = 0;
    $.each(content_url, function(n, value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                url: action,
                type: 'GET',
                datatype: 'json',
                data: {
                    value: value,
                    url: url,
                    start: start,
                    end: end,
                }
            })
            .done(function(data) {
                number = n + 1;
                $('#keyword-' + number).text(data[0]);
                if (data[1] < 5 && data[4] != '') {
                    $('#click-' + number).addClass('alert-back');
                } else {
                    $('#click-' + number).removeAttr('data-toggle');
                }
                $('#click-' + number).text(data[1]);
                $('#display-' + number).text(data[2]);
                $('#ctr-' + number).text((data[3] * 100).toFixed(1));
                if (data[2] < 11) {
                    $('#display-' + number).addClass('alert-back');
                } else {
                    $('#display-' + number).removeAttr('data-toggle');
                }
                if (data[3] * 100 < 10) {
                    $('#ctr-' + number).addClass('alert-back');
                } else {
                    $('#ctr-' + number).removeAttr('data-toggle');
                }
                if (data[4] > 80) {
                    $('#position-' + number).addClass('alert-back');
                } else {
                    $('#position-' + number).removeAttr('data-toggle');
                }
                $('#position-' + number).text(data[4]);
            })
            .fail(function(data) {});
    });

    // 個別ページのSEOデータ取得
    $('.seoTitle').on('click', function() {
        $('.seoModal button.reportExport').css({
            'cursor': 'wait',
            'background-color': '#eee',
        });
        $('.seoModal td').text('');
        $('#0').text('データ取得中…');
        const site_name = $(this).attr('site_name');
        $('.seoModal .modalTxt span').text(site_name);
        const url = $(this).attr('url');
        const content_url = $(this).attr('content_url');
        const site_id = $(this).attr('site_id');
        const start = $(this).attr('start');
        const end = $(this).attr('end');
        $('#seoTitle').text(site_name);
        $('#siteUrlModal a').text(content_url);
        $('#siteUrlModal a').attr('href', content_url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                type: 'GET',
                datatype: 'json',
                url: '/' + site_id + '/seo',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    site_name: $(this).attr('site_name'),
                    url: $(this).attr('url'),
                    content_url: $(this).attr('content_url'),
                    start: $(this).attr('start'),
                    end: $(this).attr('end'),
                }
            })
            .done(function(data) {
                if (data.length == 0) {
                    $('#0').text('データがありませんでした。');
                    for (var i = 1; i < 95; i++) {
                        $('#' + i).text('');
                    }
                } else {
                    var one = data[0];
                    var two = data[1];
                    var three = data[2];
                    var four = data[3];
                    var five = data[4];
                    var six = data[5];
                    var seven = data[6];
                    var eight = data[7];
                    var nine = data[8];
                    var ten = data[9];
                    $.each(one, function(i, value) {
                        if (i == 3) {
                            $('#' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#' + i).text(value);
                        }
                    });
                    $.each(two, function(i, value) {
                        if (i == 3) {
                            $('#1' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#1' + i).text(value);
                        }
                    });
                    $.each(three, function(i, value) {
                        if (i == 3) {
                            $('#2' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#2' + i).text(value);
                        }
                    });
                    $.each(four, function(i, value) {
                        if (i == 3) {
                            $('#3' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#3' + i).text(value);
                        }
                    });
                    $.each(five, function(i, value) {
                        if (i == 3) {
                            $('#4' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#4' + i).text(value);
                        }
                    });
                    $.each(six, function(i, value) {
                        if (i == 3) {
                            $('#5' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#5' + i).text(value);
                        }
                    });
                    $.each(seven, function(i, value) {
                        if (i == 3) {
                            $('#6' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#6' + i).text(value);
                        }
                    });
                    $.each(eight, function(i, value) {
                        if (i == 3) {
                            $('#7' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#7' + i).text(value);
                        }
                    });
                    $.each(nine, function(i, value) {
                        if (i == 3) {
                            $('#8' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#8' + i).text(value);
                        }
                    });
                    $.each(ten, function(i, value) {
                        if (i == 3) {
                            $('#9' + i).text((value * 100).toFixed(1));
                        } else {
                            $('#9' + i).text(value);
                        }
                    });
                }
            })
            .fail(function(data) {});
    });

    // ajaxstop
    $(document).ajaxStop(function() {
        console.log('ajaxstop');
        table_sort.trigger('update', true); // テーブルソートの更新
        $('button.reportExport').attr('disabled', false);
        $('button.reportExport, .scopeOn, .comparOn').attr('style', '');
        $('.alert-back').popover({
            html: true,
            trigger: 'manual',
        }).on('mouseenter', function() {
            if ($(this).hasClass('active')) {
                var _this = this;
                $(this).popover('show');
                $('.popover').on('mouseleave', function() {
                    $(_this).popover('hide');
                });
            }
        }).on('mouseleave', function() {
            var _this = this;
            setTimeout(function() {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide')
                }
            }, 100);
        });
    });
});

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
$(function() {
  $('.comparOn').on('click',function(){
    if($('.comparData').hasClass('none')){
      $('.comparData').removeClass('none');
    }
    $(this).addClass('orange-back');
    $('.comparOff').removeClass('orange-back');
  });
  $('.comparOff').on('click',function(){
    $(this).addClass('orange-back');
    $('.comparOn').removeClass('orange-back');
    $('.comparData').addClass('none');
  });

  $('.comparOn').on('click',function(){
  var content_url = $('#json_kagari').val().replace("[", "").replace("]", "").split(",");
  let url = $('#json_kagari').attr('kagariUrl');
  let start = $('#compar_kagari').attr('startcompar');
  let end = $('#compar_kagari').attr('endcompar');
  let action = $('#compar_kagari').attr('action');
  let view_id = $('#json_kagari').attr('VIEW_ID');
  let number = 0;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      url: action,
      type: 'GET',
      datatype: 'json',
      data: {
        start: start,
        end: end,
        view_id: view_id,
      }
    })
    .done(function(data) {
      $.each(content_url, function(n, value){
        var value = value.slice( 1, -1 );
        var value = value.replace(/\\/g, "");
        $.each(data,function(n,result){
          function roundFloat( number, n ) {
            var _pow = Math.pow( 10 , n );
            return Math.round( number * _pow ) / _pow;
          }
          var urlMatch = url + result[1].replace(/\s+/g, "");
          if(value == urlMatch){
            var content_url_js = urlMatch.replace( /\//g , "" );
            var content_url_js = content_url_js.replace( /:/g , "" );
            var content_url_js = content_url_js.replace( /\./g , "" );
            var session = $('#'+content_url_js+'-3-origin').text();
            var pv = $('#'+content_url_js+'-4-origin').text();
            var pp = $('#'+content_url_js+'-5-origin').text();
            var user = $('#'+content_url_js+'-6-origin').text();
            var time = $('#'+content_url_js+'-7-origin').text();
            var bounce = $('#'+content_url_js+'-8-origin').text();
            var pvalue = $('#'+content_url_js+'-9-origin').text();
            var cv = $('#'+content_url_js+'-10-origin').text();
            console.log(session);
            console.log(result[2]);
            console.log(isNaN(session));
            console.log(isNaN(result[2]));
            function roundFloat( number, n ) {
                        var _pow = Math.pow( 10 , n );
                        return Math.round( number * _pow ) / _pow;
                      }
            function propData(origin,number){
                var divData = number/origin;
                var propAnswer = divData - 1;
                var propAnswer = propAnswer*100;
                var propAnswer = Math.round(propAnswer);
                return propAnswer;
              }
              $('#'+content_url_js+'-3').text(result[2]);
              // if(result[2] < session){
              //   $('#'+content_url_js+'-3-rate').text(propData(result[2],session)+'%').css('color','green').addClass('rateUp');
              // }else if (result[2] == session){
              //   $('#'+content_url_js+'-3-rate').text('0%').css('color','green').addClass('rateUp');
              // }else{
              //   $('#'+content_url_js+'-3-rate').text(propData(result[2],session)+'%').css('color','red').addClass('rateDown');
              // }
              if(result[2] < session){
                $('#'+content_url_js+'-3-rate').text(propData(result[2],session)+'%').css('color','green').addClass('rateUp');
              }
              if (result[2] > session){
                $('#'+content_url_js+'-3-rate').text(propData(result[2],session)+'%').css('color','red').addClass('rateDown');
              }
              if (result[2] == session){
                $('#'+content_url_js+'-3-rate').text('0%').css('color','green').addClass('rateUp');
              }
              $('#'+content_url_js+'-4').text(result[3]);
              if(result[3] < pv){
                $('#'+content_url_js+'-4-rate').text(propData(result[3],pv)+'%').css('color','green').addClass('rateUp');
              }else if (result[3] == pv){
                $('#'+content_url_js+'-4-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-4-rate').text(propData(result[3],pv)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-5').text(roundFloat(result[4],2));
              if(roundFloat(result[4],2) < pp){
                $('#'+content_url_js+'-5-rate').text(propData(result[4],pp)+'%').css('color','green').addClass('rateUp');
              }else if (roundFloat(result[4],2) == pp){
                $('#'+content_url_js+'-5-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-5-rate').text(propData(result[4],pp)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-6').text(result[5]);
              if(result[5] < user){
                $('#'+content_url_js+'-6-rate').text(propData(result[5],user)+'%').css('color','green').addClass('rateUp');
              }else if (result[5] == user){
                $('#'+content_url_js+'-6-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-6-rate').text(propData(result[5],user)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-7').text(roundFloat(result[6],2));
              if(roundFloat(result[6],2) < time){
                $('#'+content_url_js+'-7-rate').text(propData(result[6],time)+'%').css('color','green').addClass('rateUp');
              }else if (roundFloat(result[6],2) == time){
                $('#'+content_url_js+'-7-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-7-rate').text(propData(result[6],time)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-8').text(roundFloat(result[7],2));
              if(roundFloat(result[7],2) < bounce){
                $('#'+content_url_js+'-8-rate').text(propData(result[7],bounce)+'%').css('color','green').addClass('rateUp');
              }else if (roundFloat(result[7],2) == bounce){
                $('#'+content_url_js+'-8-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-8-rate').text(propData(result[7],bounce)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-9').text(Math.floor(result[8]));
              if(Math.floor(result[8]) < pvalue){
                $('#'+content_url_js+'-9-rate').text(propData(result[8],pvalue)+'%').css('color','green').addClass('rateUp');
              }else if(Math.floor(result[8]) == pvalue){
                $('#'+content_url_js+'-9-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-9-rate').text(propData(result[8],pvalue)+'%').css('color','red').addClass('rateDown');
              }
              $('#'+content_url_js+'-10').text(result[9]);
              if(result[9] < cv){
                $('#'+content_url_js+'-10-rate').text(propData(result[9],cv)+'%').css('color','green').addClass('rateUp');
              }else if (result[9] == cv){
                $('#'+content_url_js+'-10-rate').text('0%').css('color','green').addClass('rateUp');
              }else{
                $('#'+content_url_js+'-10-rate').text(propData(result[9],cv)+'%').css('color','red').addClass('rateDown');
              }
            }
        });
      });
    })
    .fail(function(data) {
      console.log('error-sc-ajax');
    });
});
$('.comparOn').on('click',function(){
  var content_url = $('#json_kagari').val().replace("[", "").replace("]", "").split(",");
  let url = $('#json_kagari').attr('kagariUrl');
  let start = $('#compar_kagari').attr('startcompar');
  let end = $('#compar_kagari').attr('endcompar');
  let action = $('#json_kagari').attr('action');
  let number = 0;
  $.each(content_url, function(n, value) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url: action,
        type: 'GET',
        datatype: 'json',
        data: {
          value: value,
          url: url,
          start: start,
          end: end,
        }
      })
      .done(function(data) {

      })
      .fail(function(data) {
        console.log('error-sc-ajax');
      });
  });
});

});
