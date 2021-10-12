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
// OSMS-005  OSMS-004  OSMS-003
// OSMS-010  OSMS-009  OSMS-008
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

                    $(document).find('.sub-product-form-wrapper').html(res.data.form);
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