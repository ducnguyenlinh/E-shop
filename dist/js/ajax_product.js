$(document).ready(function () {
    $('.upload_image').change(function () {
        var link = $(this).val();
        var html = '<div class="form-group" id="uploaded_image"><img style="width:200px; height:200px" src="' + link + '"></div>';
        $('#uploaded_image').remove();
        $('.show_image_here').after(html);
    });

     
    $('#select_product').change(function () {
        var id = $(this).val();
        var url = 'product.php?id=' + id;
        window.location.replace(url);
    });


    $('.delete_product').click(function () {
        var id = $(this).attr('id');
        var data = 'id=' + id;
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this manipulation!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
                cleseOnCancel: false
            },

            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete_product.php',
                        data: data,
                        success: function () {
                            $('.row_category' + id).remove();
                            swal({
                                    title: "Deleted!",
                                    text: "This book has been deleted!",
                                    type: "success",
                                    confirmButtonText: 'OK',
                                },
                                function () {
                                    window.location.reload();
                                });
                        }
                    });
                }
                ;
            });
            

    });
});
