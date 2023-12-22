$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url) {
    if (confirm('are you sure Delete')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: {id:id},
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message)
                    location.reload();
                }else {
                    alert('ERROR');
                    location.reload();

                }
            }
        })
    }
}
// Upload file
$('#upload').change(() => {
    const form = new FormData();
    form.append('thumb_1', $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/products/store',
        success: results => {
            if (results.error === false) {
                console.log("Product");
                $('#image_show_face').html('<a href= "' + results.url + '" target="_blank">' +
                    '<img src = "' + results.url + '"width ="100px"></a>')
                $('#thumb_1').val(results.url);
            } else {
                alert('upload file FAILED')
            }
        }
    })
});
