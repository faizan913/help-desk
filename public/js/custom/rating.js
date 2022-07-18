$(document).on('change', '*.reply', function() {
            $("#msg").show();
            $.ajax({
                method: 'POST',
                url: '/storeCommentRating',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: "&rating= " + $(this).attr('value') + "&comment_id= " + $(this).attr('data'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $("#msg").html(res['rating']);
                    $("#msg").fadeOut(3000);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                    return false;
                },
                error: function(error) {

                }
            });
        });

        $(document).on('click', '.rating', function() {
            $("#msg").show();
            $.ajax({
                method: 'POST',
                url: '/storeRating',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: $('#rating').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $("#msg").html(res['rating']);
                    $("#msg").fadeOut(3000);
                },
                error: function(error) {}
            });
        });