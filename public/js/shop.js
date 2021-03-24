$(document).ready(function (){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart').on('click', function (){
        let productId = $(this).data('product-id');
        let productItem = $(this).parents('.product-info');
        let productCount = $(productItem).find('.item-count');
        let cartCount = $('#cart .count');
        let addToCartBtn = $(this);

        if (productCount.text() > 0) {
            $.ajax({
                url: '/api/add_to_cart/' + productId,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    let itemCount= cartCount.data('item-count');
                    itemCount++;
                    cartCount.data('item-count', itemCount);
                    cartCount.text('('+ itemCount +')');
                    productCount.text(productCount.text()-1);
                    if (productCount.text() == 0) {
                        $(addToCartBtn).removeClass('btn-success');
                        $(addToCartBtn).addClass('btn-danger');
                        $(addToCartBtn).attr('disabled', 'disabled');
                    }
                },
                error: function () {
                    console.log('Something wrong... try again later..');
                }
            });
        }
    })

    $('.payment-method').on('change', function (){
        let value = $(this).find(':selected').val();
        console.log('value', value);
        if ($(this).val()) {

            $('.payment-form').fadeIn();

            if (value == 'iban') {
                $('.iban').show();
                $('.creditcard').hide();
                $('.iban input').prop('disabled', false);
                $('.creditcard input').prop('disabled', true);
            } else if (value == 'card') {
                $('.iban').hide();
                $('.creditcard').show();
                $('.iban input').prop('disabled', true);
                $('.creditcard input').prop('disabled', false);
            }
        } else {
            $('.payment-form').fadeOut();
        }
    });

    $('.remove-product').on('click', function (){
        event.preventDefault();

        let productId = $(this).data('product-id');
        let productItem = $(this).parents('.p-checkout-item');
        let productPrice = $(productItem).find('.price').data('price');
        let totalPrice = $('.total-price').data('total-price');
        let newPrice;

        if (productId) {
            $.ajax({
                url: '/api/remove_from_cart/' + productId,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    $(productItem).hide();
                    newPrice = totalPrice - productPrice;
                    $('.total-price').text(newPrice.toFixed(2) + '€');
                    $('.total-price').data('total-price', newPrice.toFixed(2));

                    if (data.products == 0) {
                        $('.no-product-left').show();
                        $('.total-container').hide();
                    }
                },
                error: function () {
                    console.log('Something wrong... try again later..');
                }
            });
        }
    });

    $('.payment-form').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            iban: {
                required: true,
                minlength: 20
            },
            cardnumber: {
                required: true,
                minlength: 32
            },
            nameoncard: {
                required: true,
                minlength: 3
            },
            expirydate: {
                required: true,
                minlength: 4
            },
            securitycode: {
                required: true,
                minlength: 3
            }
        }
    });

});
