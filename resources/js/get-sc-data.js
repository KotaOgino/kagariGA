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
