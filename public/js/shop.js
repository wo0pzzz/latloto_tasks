$(document).ready(function (){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart').on('click', function (){
        console.log($(this));
        let productId = $(this).data('product-id');
        let productItem = $(this).parents('.product-info');
        let cartCount = $('#cart .count');
        console.log('productId', productId);
        $.ajax({
            url: '/api/add_to_cart/' + productId,
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                console.log('data', data);
                let itemCount= cartCount.data('item-count');
                itemCount++;
                cartCount.data('item-count', itemCount);
                cartCount.text('('+ itemCount +')');
            },
            error: function () {
                console.log('Something wrong... try again later..');
            }
        });
    })
});
