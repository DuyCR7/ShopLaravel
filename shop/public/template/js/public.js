$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore()
{
    const page = parseInt($('#page').val());
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { page },
        url: '/service/load-product',
        success: function (result) {
            if(result.html !== ''){
                $('#loadProduct').append(result.html);
                $('#page').val(page + 1);
            }
            else{
                alert('Đã load xong sản phẩm!');
                $('#btn_loadMore').css('display', 'none');
            }
        }
    })
}
