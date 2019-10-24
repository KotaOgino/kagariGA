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
