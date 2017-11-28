function tx_tp3ratings_submit(id, rating, ajaxData, check) {
    $('.tx_tp3ratings-vote-bar').hide();
    $('.tx-tp3ratings-display-wrap').show();
    /*new Ajax.Updater('tx-ratings-' + id, 'index.php?eID=rating', {
        asynchronous: true,
        method: 'post',
        parameters: 'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check
    });*/
    /*  $.ajax({
          type: 'POST',
          dataType: "json",
          url: 'index.php?eID=rating&rating='+rating+'&ref=' + id,
          data:  'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check ,
          success: update_rating,
          error:function (result) {
              $('.tx_tp3ratings-text').html(result);
          }
      });*/
    // Assign handlers immediately after making the request,
// and remember the jqxhr object for this request
    var e,data;
    var base = $("base").length > 0 ? $("base").attr("href") : (window.location.protocol + "//" + window.location.host)
    var jqxhr = $.getJSON(  base + '/index.php?eID=rating&rating='+rating+'&ref=' + id,  'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check , update_rating)
        .done(update_rating)
        .fail(function() {
            console.log( "error" );
            e=true;

        })
        .always(function(result)  {
            if(e){
                //Fix for bad encoding by vhs viewhelper
                var errorContainer = $( '<div/>' );
              try{
                  errorContainer.html( result.responseText );
                  errorContainer.appendTo( $( 'body' ) ).hide();
                  data =  jQuery.parseJSON(errorContainer.text().replace("&quot;","'"));//
                  update_rating(data);
              }
              catch (e)
              {
                  console.log(e)
              }

             }
        });

}
function update_rating(result) {
    console.log(result);
    try{
        $('.tx_tp3ratings-text').html(result.submittext);
    }
    catch (e)
    {
        console.log(e)
    }
    $('.tx_tp3ratings-vote-bar').show();
    $('.tx-tp3ratings-display-wrap').hide();
}
$('.tx-tp3ratings-display-wrap').hide();