"use strict";
// For OSMS-001  OSMS-006
$(function(){

    var enableConfirmation = true;
    $('a[del-attr="delete-item"]').on('click', function(e){
        e.preventDefault();        
        var form = $(this).parents('form'), self = $(this), confirmationText;
        confirmationText = $(this).attr('confirmationText');

        function callApi() {            
            ElementHelpers.disableElement(self);
            ElementHelpers.displayOverlay('Please wait...');
            $.ajax({
                method: 'post', 
                url: self.attr('href'), 
                data: {
                    redirectUrl: self.attr('del-redirect-url'),
                    _method: 'delete',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
            }).then(function(res){
                AjaxSuccessHandler(res, self);
            }).catch(function(err, xhr, text){
                AjaxErrorHandler(err, xhr, text, self);
            });
        }

        if ( enableConfirmation ) {
            Swal.fire({
                title: (confirmationText != ''?confirmationText: "Are you sure submit?") + '<br/><br/>It cannot be undone!',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    callApi();
                }
            });
        } else {
            callApi();
        }        
    });
});

// For following Page Number(shop,product update and create)
// OSMS-005
// OSMS-004
// OSMS-003
// OSMS-010
// OSMS-009
//OSMS-008
$(function(){

    var enableConfirmation = true;
    // $(document).find('.common-sb-btn').on('click', function(e){
        $('.common-sb-btn').on('click', function(e){
        e.preventDefault();        
        var form = $(this).parents('form'), 
            self = $(this), 
            confirmationText = $(this).attr('confirmationText');

        function callApi() {
            
            ElementHelpers.disableElement(self);
            ElementHelpers.displayOverlay('Please wait...');

            var formData = new FormData(form[0]);

            if ( fileUpload ) {
                for (var index = 0; index < fileUpload.cachedFileArray.length; index++) {
                    formData.append('files[]', fileUpload.cachedFileArray[index])
                }
            }

            $.ajax({
                method: form.attr('method'), 
                url: form.attr('action'), 
                data: formData,
                processData: false, 
                contentType: false, 
            }).then(function(res){
                AjaxSuccessHandler(res, self);
            }).catch(function(err, xhr, text){
                AjaxErrorHandler(err, xhr, text, self);
            });

        }

        if ( enableConfirmation ) {
            Swal.fire({
                title: confirmationText != ''?confirmationText: "Are you sure submit?",
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    callApi();
                }
            });
        } else {
            callApi();
        }        
    });
});

// PAGENO: OSMS-012
$(function(){

    // Delete Image file
    var enableConfirmation = true;
    $('a[delete-by-link="yes"]').on('click', function(e){
        e.preventDefault();        
        var self = $(this), 
            confirmationText = $(this).attr('confirmationText');

        function callApi() {
            
            ElementHelpers.disableElement(self);
            ElementHelpers.displayOverlay('Please wait...');

            $.ajax({
                url: self.attr('href'),
                method: 'post',
                data: {
                    redirectUrl: self.attr('del-redirect-url'),
                    _method: 'delete',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
            }).then(function(res){

                if( 'success' === res.status) {
                    $(self.attr('remove-element')).remove();
                    ElementHelpers.customToastr('success', res.msg);
                } else {
                    ElementHelpers.customToastr('error', res.msg);
                }
                
                ElementHelpers.enableElement(self);
                ElementHelpers.hideOverlay();
            }).catch(function(err, xhr, text){
                ElementHelpers.customToastr('error', "Unable to delete", "Error!");
                ElementHelpers.enableElement(self);
                ElementHelpers.hideOverlay();
            });

        }

        if ( enableConfirmation ) {
            Swal.fire({
                title: confirmationText != ''?confirmationText: "Are you sure submit?",
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    callApi();
                }
            });
        } else {
            callApi();
        }        
    });
});

$(function(){

    var enableConfirmation = true;
    $('a[edit-attr="edit-sub-product"]').on('click', function(e){
        e.preventDefault();        
        var self = $(this), 
            confirmationText = $(this).attr('confirmationText');

        function callApi() {
            
            ElementHelpers.disableElement(self);
            ElementHelpers.displayOverlay('Please wait...');

            $.ajax({
                url: self.attr('href'),
                // async: false
            }).then(function(res){

                if( 'success' === res.status) {
                    ElementHelpers.enableElement(self);
                    ElementHelpers.hideOverlay();

                    $(document).find('.display-detail-on-xhr').html(res.data.form);
                    $('script[loaded="initial"]').remove();
                    $('script[loaded="secondary"]').remove();
                    $(document).find('.micromodal-slide').addClass('is-open');
                    $('head').append(res.data.assets.js);
                }
                // AjaxSuccessHandler(res, self);
            }).catch(function(err, xhr, text){
                // AjaxErrorHandler(err, xhr, text, self);
            });

        }

        if ( enableConfirmation ) {
            Swal.fire({
                title: confirmationText != ''?confirmationText: "Are you sure submit?",
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    callApi();
                }
            });
        } else {
            callApi();
        }        
    });
});

// PAGENO: OSMS-022 - order create page
// $(function(){
//     $('select.order-product-id').on('change', function(e){
//         if( $(this).val() === 0 ) {
//             return false;
//         }

//         var self = $(this);

//         $.ajax({
//             url: self.attr('request-url'),
//             data: {
//                 productId: self.val(),
//                 redirectUrl: self.attr('redirect-url')
//             }
//         }).then(function(res){

//             if( 'success' === res.status) {
//                 // ElementHelpers.enableElement(self);
//                 // ElementHelpers.hideOverlay();

//                 // $(document).find('.sub-product-form-wrapper').html(res.data.form);
//                 // $('script[loaded="initial"]').remove();
//                 // $('script[loaded="secondary"]').remove();
//                 // $(document).find('.micromodal-slide').addClass('is-open');
//                 // $('head').append(res.data.assets.js);
//             }
//             // AjaxSuccessHandler(res, self);
//         }).catch(function(err, xhr, text){
//         });
        
//     });
// });

function OrderProductVariation(ajaxUrl) {
    this.ajaxUrl = ajaxUrl;
    this.init = function() {

        $(document).on('change', 'select[name="size"]', function(e){
            handleSizeBoxAndGenerateColor($(this));
        });

        $(document).on('change', 'select[name="color"]', function(e){
            handleColorBox($(this));
        });

        $(document).on('click', '.save-product-variation', function(e){
            e.preventDefault();
            var self = $(this);
            var code = $(document).find('input[name="code"]').val();
            var quantityLeft = $('.quantity-counter').html();
            var size = $(document).find('select[name="size"]').val();
            var color = $(document).find('select[name="color"]').val();
            var quantity = $(document).find('input[name="quantity"]').val();
            var subProductId = $(document).find('input[name="sub_product_id"]').val();

            var customerId = $(document).find('select[name="customer_id"]').val();
            var productId = $(document).find('select[name="product_id"]').val();
 
            if ( customerId == '' ) {
                ElementHelpers.customToastr('error', '', 'Please Choose Customer Name.');
                return false;
            } else if ( productId == '' ) {
                ElementHelpers.customToastr('error', '', 'Please Choose Product Name.');
                return false;
            } else if ( size == '' ) {
                ElementHelpers.customToastr('error', '', 'Please Choose Size.');
                return false;
            } else if ( color == '' ) {
                ElementHelpers.customToastr('error', '', 'Please Choose Color.');
                return false;
            } else if ( quantity == '' || quantity < 1) {
                ElementHelpers.customToastr('error', '', 'Please Choose Quantity.');
                return false;
            } else if ( parseInt(quantity) > parseInt(quantityLeft) ) {
                ElementHelpers.customToastr('error', '', 'Unknown Quantity.');
            } else {

                ElementHelpers.disableElement(self);
                ElementHelpers.displayOverlay('Please wait...');

                $.ajax({
                    url: ajaxUrl,
                    method: 'post',
                    data: {
                        customerId: customerId,
                        productId: productId,
                        subProductId: subProductId,
                        code: code,
                        variations: {
                            size: size,
                            color: color,
                            quantity: quantity
                        },
                        redirectUrl: self.attr('redirect-url'),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function(res){

                    if( 'success' === res.status) {
                        window.location.href = res.redirectUrl;
                    } else {
                        ElementHelpers.customToastr('error', '', res.msg);
                    }

                    ElementHelpers.enableElement(self);
                    ElementHelpers.hideOverlay();

                }).catch(function(err, xhr, text){
                    ElementHelpers.customToastr('error', '', "Error Occured.Please try again!");
                    ElementHelpers.enableElement(self);
                    ElementHelpers.hideOverlay();
                });
            }
            return false;
        });

        function generateSizeSelection()
        {
            var colorSelect = '<option value="">Please Select</option>'
            $.each(colors,function(color, obj){
                colorSelect += "<option value='"+color+"' varition-ral‌ation='"+ JSON.stringify(obj)+"'>"+color+ "</option>";
            });
            colorSelectBox.prop('disabled', false).html(colorSelect);
        }

        function handleSizeBoxAndGenerateColor(element)
        {
            var colorSelectBox = $(document).find('select[name="color"]');

            if ( element.val() ) {
                
                var colors = $(':selected', element).attr("color-relation");
                colors = JSON.parse(colors) || {};

                colorSelectBox.prop('disabled', false).html('');
                toggleQuantityBox();
                handleSubProductId('');

                var colorSelect = '<option value="">Please Select</option>'
                $.each(colors,function(color, obj){
                    colorSelect += "<option value='"+color+"' varition-ral‌ation='"+ JSON.stringify(obj)+"'>"+color+ "</option>";
                });
                colorSelectBox.prop('disabled', false).html(colorSelect);

            }
        }

        function handleColorBox(element)
        {
            if ( element.val() ) {
                var variations = $(':selected', element).attr("varition-ral‌ation");
                var variationsObj = JSON.parse(variations) || {};
                toggleQuantiryLeft(variationsObj.quantity_left);
                toggleQuantityBox(0)
                handleSubProductId(variationsObj.id);
            }
        }

        function toggleQuantityBox(quantity='')
        {
            var quantityBox = $(document).find('input[name="quantity"]');

            if ( quantity ) {
                quantityBox.attr('max', quantity).prop('disabled', false).val(quantity);
            } else {
                quantityBox.prop('disabled', false).val(0);
            }
        }

        function toggleQuantiryLeft(counter='')
        {
            $(document).find('.quantity-counter').html(counter);
        }

        function handleSubProductId(subProductId)
        {
            $(document).find('input[name="sub_product_id"]').val(subProductId);
        }

    }            
}



// PAGENO: OSMS-019
$(function(){
 
    $('a[view-attr="view-item"]').on('click', function(e){
        e.preventDefault();        
        var form = $(this).parents('form'), self = $(this);
            
        ElementHelpers.disableElement(self);
        ElementHelpers.displayOverlay('Please wait...');
        $.ajax({
            url: self.attr('href'), 
            data: {
                redirectUrl: self.attr('del-redirect-url'),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
        }).then(function(res){
            if( res.status === 'success') {
                $('.display-detail-on-xhr').html(res.data.template);
            } else {
                Swal.fire({html: response.msg, confirmButtonColor: '#3085d6', icon: 'error'});
            }
            ElementHelpers.enableElement(self);
            ElementHelpers.hideOverlay();
            // $('.display-order-detail')
        }).catch(function(err, xhr, text){
            AjaxErrorHandler(err, xhr, text, self);
        });
      
    });
});