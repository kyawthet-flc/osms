
     "use strict";

     var ElementHelpers = {
        displayOverlay: function(msg) {
            var overlay = $('<div class="form-overlay" style="text-align: center;padding-top: 180px;top: 0;bottom: 0;left: 0;right: 0;background-color: rgba(255,255,255,0.7) !important;position: fixed;z-index: 30000;overflow: hidden;"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only"></span></div><br/><span style="font-size: 15px;">'+(msg?msg: 'Loading...')+'</span></div>');
            overlay.appendTo($('body'));
            $('body').addClass('hide-scroll-bar');
        },
        hideOverlay: function() {
            $('body').removeClass('hide-scroll-bar');
            $(document).find('.form-overlay').remove();
        },
        enableElement: function (element) {
            if ( $.isArray(element) ) {
                $.each(element, function(key, obj){
                    obj.removeAttr('disabled');       
                });
            }

            if ( typeof(element) === 'object' ) {
            element.removeAttr('disabled');                        
            }
            return;
        },
        disableElement: function (element) {
            
            if ( $.isArray(element) ) {
                $.each(element, function(key, obj){
                obj.attr('disabled', true);
                });
            }

            if ( typeof(element) === 'object' ) {
            element.attr('disabled', true);                  
            }
            return;
        },
        hideScrollbar: function() {
            $('body').css({overflow: "hidden !important"});
        },
        displayScrollbar: function() {
            $('body').css({overflow: "scroll !important"});
        },
        customToastr: function(type = 'success', title,msg) {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-center",
              "preventDuplicates": true,
              "onclick": null,
              "showDuration": "7000000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "7000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            
            if ( type === 'success' ) {
                toastr.success(msg, title);
            }
            if ( type === 'info') {
                toastr.info(msg, title);
            }
            if ( type === 'error' ) {
                toastr.error(msg, title);
            }
    
        }
    }

    function AjaxErrorHandler(err, xhr, text, element) {
        var validationMsg, validationTitle;

        if( err.status === 404 ) {
            validationTitle = 'ERROR!';
            validationMsg = 'URL NOT FOUND.';
        }

        if( err.status === 500 ) {
            validationTitle = 'Server went wrong!';
            validationMsg = 'Webmaster has trying to fix.';
        }

        if( err.status === 403 ) {
            validationTitle = "Please respect other's privacy!";
            validationMsg = 'You could only access your assets.';
        }

        if (422 === err.status) {

            $(document).find(".ajax-validation-error").remove();
            validationTitle = 'Validation Failed!';
            validationMsg = 'Plese fill the required fields.';

            for (var e in err.responseJSON.errors) {
                var l = e.split(".")[0];
                if (void 0 !== err.responseJSON.errors[e][0]) {
                    var B = $(document).find("#" + l).parents("div.seperate-validation-wrapper").children("div.validation-msg-holder");
                    var errMsg =  err.responseJSON.errors[e][0];
                    B.length > 0 ? $('<span style="display: block;" class="ajax-validation-error">' + errMsg + "</span>").appendTo(B) : $('<span style="display: block;" class="ajax-validation-error">' + errMsg + "</span>").appendTo($('[name="' + l + '"]').parent("div"))
                }
            }
        }
        
        ElementHelpers.enableElement(element);
        ElementHelpers.hideOverlay();
// base_url + 'images/khaby-lame/image-1.jpg'
        ElementHelpers.customToastr('error', validationMsg, validationTitle);

    }

    function AjaxSuccessHandler(response, element) {

        if ( 'success' === response.status ) {
            ElementHelpers.hideOverlay();
            Swal.fire({ html: response.msg, confirmButtonColor: '#3085d6', icon: 'success' }).then(function(result){
                if ( result.isConfirmed ) {
                    // window.location.href = response.redirectUrl;
                    setTimeout(function(){
                        document.location.href = response.redirectUrl;
                    },250);
                }
            });
        } else if ( 'error' === response.status ) {
            Swal.fire({html: response.msg, confirmButtonColor: '#3085d6', icon: 'error'});
            ElementHelpers.enableElement(element);
            ElementHelpers.hideOverlay();
        }
        
    }
 

$(function($){

    MicroModal.init({
        onShow: modal => console.info(`${modal.id} is shown`), // [1]
        onClose: modal => console.info(`${modal.id} is hidden`), // [2]
        openTrigger: 'data-custom-open', // [3]
        closeTrigger: 'data-custom-close', // [4]
        openClass: 'is-open', // [5]
        disableScroll: true, // [6]
        disableFocus: false, // [7]
        awaitOpenAnimation: true, // [8]
        awaitCloseAnimation: true, // [9]
        debugMode: false // [10]
    });

    
    $('.escaped-select').select2({
        escapeMarkup: function(data) {
            return data;
        }
    });

    function formatOrderCustomerSelection(state)
    {
     console.log(state)
     return  state.text;
    }

    $('.order-customer-selection').select2({
        escapeMarkup: function(markup) {
        return markup;
      },
       templateResult: function(state) {
        return state.text;
      }   });

    $(document).on('keyup', 'input[number="yes"]', function(){
        // if( document.readyState === 'complete' ) {
            if(!/^[0-9]*$/.test(this.value)){
                this.value = this.value.split(/[^0-9.]/).join('');
            }
            ElementHelpers.customToastr('error', 'Number only', '');
        // }
    });

    $('.magnific-popup-img').magnificPopup({
        type: 'image'
    });

    // $('.input-images').imageUploader();
    // $('.input-images').imageUploader({
    //     label: 'Drag & Drop files here or click to browse',
    //     imagesInputName: 'files'
    // });
     
    $('.close-modal-box').on('click', function(){
        // alert('s')
        // var id = $(this).parents('div.micromodal-slide').attr('id');
        // $('.modal.is-open').css({'display': 'none'});
        // window.reload();
        window.location.reload();
 
    });
    
    if( $('div[data-upload-id="myUniqueUploadId"]').length > 0 ) {
    // new FileUploadWithPreview("myUniqueUploadId");
     fileUpload = new FileUploadWithPreview("myUniqueUploadId", {
        showDeleteButtonOnImages: true,
        text: {
            chooseFile: "....",
            browse: "Browse",
            selectedCount: "....",
        },
        // images: {
        //     baseImage: importedBaseImage,
        // },
        presetFiles: existingImages || [],
    });
    }

})