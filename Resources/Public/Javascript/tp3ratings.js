var base = $("base").length > 0 ? $("base").attr("href") : (window.location.protocol + "//" + window.location.host +"/" );
//if(window.location.host == "localhost.tp3.de" ) base +="/tp_8";
function tx_tp3ratings_submit(id, rating, ajaxData, check) {
    $('.tx_tp3ratings-vote-bar').hide();
    $('.tx-tp3ratings-display-wrap').show();

    // Assign handlers immediately after making the request,
// and remember the jqxhr object for this request
    var e,data;
    var jqxhr = $.getJSON(  base + 'index.php?eID=rating&rating='+rating+'&ref=' + id,  'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check , update_rating)
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
$('#tp3reviewRequest').on("submit",function(event) {
    var form = $(this);

    var values = $(form).find('select')
        .add(  $(form).find('input[type!=checkbox]') )
        .add(  $(form).find('textarea') )
        .serialize();
    // add values for checked and unchecked checkboxes fields
    $(form).find('input[type=checkbox]').each(function() {
        var chkVal = $(this).is(':checked') ? $(this).val() : "0";
        values += "&" + $(this).attr('name') + "=" + chkVal;
    });
    $(form).find('input[type="file"]').each(function() {	 values += "&" + $(this).attr('name') + "=" + $(this).val()})

    var jqxhr = $.getJSON(base + 'index.php?eID=review&' + values)
        .done(function () {
            console.log("done")
        })
        .fail(function () {
            console.log("error");
        })
        .always(function (result) {
            $('#tp3review').modal('hide')
        });

    event.preventDefault();
});
function update_rating(result) {
    console.log(result);

    if ($('#tp3review').length > 0) {

        $('.tx_tp3ratings-vote-bar').clone(true).appendTo($('#tp3review').find('.tp3review-rating'));
        $('#tp3review').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            var modal = $(this);

            //modal.find('.modal-title').text("Review")
            //  modal.find('.modal-content')
        })
        $('#tp3review').modal('show')
       /* $('#SubmitReview').click(function (e) {
            e.preventDefault();
            var jqxhr = $.getJSON(base + 'index.php?eID=review&' + $('#tp3reviewRequest').serialize())
                .done(function () {
                    console.log("done")
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function (result) {
                    $('#tp3review').modal('hide')
                });
        });*/
    }
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