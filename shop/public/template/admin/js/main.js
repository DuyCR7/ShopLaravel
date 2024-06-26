$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if(confirm('Bạn có chắc xóa danh mục này không?')){
        $.ajax({
           type: 'DELETE',
           datatype: 'JSON',
           data: { id },
           url: url,
           success: function (result){
               if(result.error === false){
                   alert(result.message);
                   location.reload();
               }
               else{
                   alert('Xóa không thành công');
               }
           }
        });
    }
}


//Upload File
$('#upload').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results){
           console.log(results);
        }
    });
    // console.log(123);
});
