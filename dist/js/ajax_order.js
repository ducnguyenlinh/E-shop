$(document).ready(function () {
    $('.order_sent').click(function () {
        var id = $(this).attr('name');
        var status = $(this).attr('value');
        var data = 'id=' + id + '&status=' + status;
        $.ajax({
            type: 'POST',
            url: 'order_sent.php',
            data: data,
            success: function () {
                if (status === "1")
                    swal({
                            title: "Success!",
                            text: 'this order sented!',
                            type: "success"
                        },
                        function () {
                            window.location.reload();
                        });
                if (status === "2")
                    swal({
                            title: "Success!",
                            text: 'this order has not sented!',
                            type: "success"
                        },
                        function () {
                            window.location.reload();
                        });
            }
        });
    });
});
	