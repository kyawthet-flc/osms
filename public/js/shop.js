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
    $('.common-sb-btn').on('click', function(e){
        e.preventDefault();        
        var form = $(this).parents('form'), self = $(this), confirmationText;
        confirmationText = $(this).attr('confirmationText');

        function callApi() {
            
            ElementHelpers.disableElement(self);
            ElementHelpers.displayOverlay('Please wait...');

            $.ajax({
                method: form.attr('method'), 
                url: form.attr('action'), 
                data: new FormData(form[0]), 
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