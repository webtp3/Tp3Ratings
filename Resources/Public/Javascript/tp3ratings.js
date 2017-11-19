function tx_tp3ratings_submit(id, rating, ajaxData, check) {
    $('.tx_tp3ratings-vote-bar').hide();
    $('#tx_tp3ratings-wait-0').show();
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
    var base = $("base").length > 0 ? $("base").attr("href") : (window.location.protocol + "//" + window.location.host)
    var jqxhr = $.getJSON(  base + '/index.php?eID=rating&rating='+rating+'&ref=' + id,  'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check , update_rating)
        .done(function() {
            console.log( "second success" );
        })
        .fail(function() {
            console.log( "error" );
        })
        .always(function() {
            console.log( "complete" );
        });

// Perform other work here ...

// Set another completion function for the request above
    jqxhr.complete(function() {
        console.log( "second complete" );
    });
}
function update_rating(result) {
    $('.tx_tp3ratings-text').html(result.submittext);
    $('.tx_tp3ratings-vote-bar').show();
    $('#tx_tp3ratings-wait-0').hide();
}
$('#tx_tp3ratings-wait-0').hide();