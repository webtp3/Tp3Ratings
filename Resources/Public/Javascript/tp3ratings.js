var  tp3ratings = tp3ratings || {
    base : $("base").length > 0 ? $("base").attr("href") +"/" : (window.location.protocol + "//" + window.location.host +"/" ),
        ratingRequest:{
            rating: undefined,
            ref : undefined,
        },
    tx_tp3ratings_submit:function(id, rating, ajaxData, check) {
        $('.tx_tp3ratings-vote-bar').hide();
        $('.tx-tp3ratings-display-wrap').show();
        this.ratingRequest.rating = rating;
        this.ratingRequest.ref = id;

        var e,data;
        var jqxhr = $.getJSON(  this.base + 'index.php?eID=rating&rating='+rating+'&ref=' + id,  'ref=' + id + '&rating=' + rating + '&ratingdata=' + ajaxData + '&check=' + check , tp3ratings.update_rating)
            .done(tp3ratings.update_rating)
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
                        tp3ratings.update_rating(data);
                    }
                    catch (e)
                    {
                        console.log(e)
                    }

                }
            });

    },
    reviewhandler:function(){
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

            var jqxhr = $.getJSON(tp3ratings.base + 'index.php?eID=review&' + values)
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
            return false;

        });
        if($('#tp3review').find('.tx_tp3ratings-vote-bar').length == 0 ){
            $('.tx_tp3ratings-vote-bar').clone(true).appendTo($('#tp3review').find('.tp3review-rating')).css({position:"relative",width:"50%"});

        }
        $('#tp3review').find('.tx_tp3ratings-vote-bar a').each(function(i,e) {
              if(i < tp3ratings.ratingRequest.rating)  $(this).addClass("voted")
              else $(this).removeClass("voted")
            })
        $('#tp3review').on('show.bs.modal', function (event) {
            var button = $(tp3ratings.relatedTarget) // Button that triggered the modal

            var modal = $(this);

            //modal.find('.modal-title').text("Review")
            //  modal.find('.modal-content')
        })
        $('#tp3review').modal('show')
    },
    update_rating:function(result) {
        //console.log(result);
        //look if disabled in config
        if ($('#tp3review').length > 0) {
            tp3ratings.reviewhandler()
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

}




$('.tx-tp3ratings-display-wrap').hide();