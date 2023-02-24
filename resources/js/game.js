$(function () {
    $('.new_round').click(function(){
        $.ajax({
            url: 'game',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            dataType: 'json',
            success: function (data) {
                $('.player').text('-')
                $('.status').text('-')
                $('.round').text(data.data.RoundID);
                $.each(data.data.Board, function (xAxis, xValue) {
                    $.each(xValue, function (yAxis, status) {
                        var statusName = '-'
                        if (status == 1) {
                            statusName = '黑'
                        }
                        if (status == 2) {
                            statusName = '白'
                        }
                        $('#nine_'+xAxis+'_'+yAxis).text(statusName)
                    })
                })
            },
            error: function (xhr, ajaxOptions, thrownError) {}
        });
    })

    $('.nine').click(function(){
        const location = $(this).attr('id')
        const locationArray = location.split("_")
        const x = locationArray[1]
        const y = locationArray[2]
        const round_id = $('.round').text()
        $.ajax({
            url: 'game',
            method: 'put',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            data: {
                'x': x,
                'y': y,
                'round_id': round_id
            },
            dataType: 'json',
            success: function (data) {
                $('.player').text(data.status.Player)
                $('.status').text(data.status.Status)
                $.each(data.data.board, function (xAxis, xValue) {
                    $.each(xValue, function (yAxis, status) {
                        var statusName = '-'
                        if (status == 1) {
                            statusName = '黑'
                        }
                        if (status == 2) {
                            statusName = '白'
                        }
                        $('#nine_'+xAxis+'_'+yAxis).text(statusName)
                    })
                })
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("請先開始新局")
            }
        });

    })
})