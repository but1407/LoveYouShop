
// import swal from 'App/public/sweetalert/sweetalert2/sweetalert2.js';
// window.Swal = swal;
function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that =$(this);
        // alert(urlRequest);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
                if (result.isConfirmed === true) {
                    $.ajax({
                        type: "get",
                        url: urlRequest,
                        success: function (data) {
                            if (data.status == 200) {
                                Swal.fire({ 
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                that.parent().parent().remove();
                            }
                        },
                        error: function (data) { 
                            
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                that.parent().parent().remove();
                            
                        }
                    });
                    
                }
            });
    }
$(function () {
    $(document).on('click', '.action_delete', actionDelete)});