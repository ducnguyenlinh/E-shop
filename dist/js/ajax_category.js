$(document).ready(function () {
    $('.edit_category').click(function () {
        var category = $(this).attr('name');
        var id = $(this).attr('value');
        swal({
                title: "Edit category",
                type: 'input',
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputValue: category,
            },
            function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("you need write name of category!");
                    return false;
                }
                inputValue = trimSpace(inputValue);
                category = trimSpace(category);
                var data = 'id=' + id + '&new_name=' + inputValue;
                if (inputValue === category) {
                    swal("notification", "the name of category do not change!");
                }
                else {

                    $.ajax({
                        type: 'POST',
                        url: 'edit_category.php',
                        data: data,
                        success: function () {
                            swal({
                                    title: "Success!",
                                    text: 'You edited "' + category + '" to "' + inputValue + '"',
                                    type: "success"
                                },
                                function () {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });
    });


    $('.add_category').click(function () {
        swal({
                title: "Insert category",
                text: 'Write name of category:',
                type: 'input',
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write name of category",
            },
            function (inputValue) {
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("You need to write name of category!");
                    return false;
                }
                inputValue = trimSpace(inputValue);
                var data = 'name=' + inputValue;
                $.ajax({
                    type: 'POST',
                    url: 'add_category.php',
                    data: data,
                    success: function () {
                        swal({
                                title: "Success!",
                                text: 'You inserted "' + inputValue + '" to list category.',
                                type: "success"
                            },
                            function () {
                                window.location.reload();
                            });
                    }
                });
            });
    });

    $('.delete_category').click(function () {
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
                        url: 'delete_category.php',
                        data: data,
                        success: function () {
                            $('.row_category' + id).remove();
                            swal({
                                    title: "Deleted!",
                                    text: "this category has been deleted!",
                                    type: "success",
                                    confirmButtonText: 'OK',
                                },
                                function () {
                                    window.location.reload();
                                });
                        }
                    });
                };
            });
    });
    function trimSpace(str) {
        return str.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g, "").replace(/\s+/g, " ");
    }
});