// require( '@ckeditor/ckeditor5-build-classic' )

$(document).ready(function () {
    $('#open-friends-box').on('click', () => {
        if ($('#friends-box').hasClass('active')) {

            $('#friends-box').animate({
                'height': '0vh',
            }, 1000);
            $('#friends-box').removeClass('active')

        } else {

            $('#friends-box').animate({
                'height': '50vh',
            }, 1000);
            $('#friends-box').addClass('active')

        }
    })

    // Add New Friend

    $('#add-new-friend').on('click', function () {
        var add_friend = $(this).attr('data-url');
        var friend_id = $(this).attr('data-info');
        $.ajax({
            data: {'friend_id':friend_id},
            url: add_friend,
            success: function (data) {
                console.log(data)
            }
        })
    })

    // End Of Add New Friend


    // Create Online Status
    // var online_status = setInterval(() => {
    //     var urlstatus = $('#online_status').val()
    //     var status = 'ofline';

    //     if ($('body,hmtl').mouseover) {
    //         var status = 'online';
    //     }

    //     $.ajax({
    //         data: {'status': 'online'},
    //         url: 'http://investor.local/onlone_status',
    //         success: function (data) {
    //             // var mydata = JSON.parse(data);
    //             if (data.online_status == 1) {
    //                 $('#online_status_icon').addClass('text-success')
    //                 $('#online_status_icon').removeClass('text-danger')
    //             } else {
    //                 $('#online_status_icon').addClass('text-danger')
    //                 $('#online_status_icon').removeClass('text-success')
    //             }
    //         }
    //     });
    // }, 1000);




        // TAGS BOX
    // $(function(){
    //     $("#tags input").on({
    //         focusout : function() {
    //         var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
    //         if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
    //         this.value = "";
    //         },
    //         keyup : function(ev) {
    //         // if: comma|enter (delimit more keyCodes with | pipe)
    //         if(/(188|13)/.test(ev.which)) $(this).focusout();
    //         }
    //     });
    //     $('#tags').on('click', 'span', function() {
    //         // if(confirm("Remove "+ $(this).text() +"?"))
    //         $(this).remove();
    //     });

    // });

});
