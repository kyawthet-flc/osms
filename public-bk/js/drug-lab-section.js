var DrugLabsection = {
    getLabResultForm: function(labResultFormWrapper='.lab-result-form-wrapper'){
        $(document).on('click', '.get-lab-result-form', function(e){
       
            e.preventDefault();
            var headerTitle = $(this).attr('header-title');
            var labResultRequestFormContainer = $('.modal-container');
            
            $.ajax({
                url: $(this).attr('href'),
                data: {redirectUrl: $(this).attr('redirect-url')}
            }).then(function(response){
        
                if ( 'success' === response.status ) {
                  labResultRequestFormContainer.find('.header-title').html(headerTitle);
                  labResultRequestFormContainer.find(labResultFormWrapper).html(response.data.view);
                  labResultRequestFormContainer.modal("show");
                } else if ( 'error' === response.status ) {
                    Swal.fire({html: "Cannot load Result Request Form."/* response.msg */, confirmButtonColor: '#3085d6', icon: 'error'});
                } 
        
            }).catch(function(err, xhr, text) {
                var validationMsgs;
                if( err.status === 500 ) {
                    validationMsgs = 'Webmaster has trying to fix!';              
                }
                Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
            });
        
        });
    },
    sendLabResultButton: function(){
        $(document).on('click', '.send-lab-result-btn', function(e){
            e.preventDefault();
        
            var resultForm = $('#' + $(this).attr('form-id') );
            resultForm.find('input[name="actionType"]').val( $(this).attr('value') );
        
            Swal.fire({
                title: "Are you sure to send Lab Result to Enforcement Section?",
                icon: 'info',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
        
              if (result.isConfirmed) {
                 $.ajax({
                    method: 'post',
                    url: resultForm.attr('action'),
                    data: new FormData(resultForm[0]),
                    processData: false, 
                    contentType: false,
                }).then(function(response){
        
                    if ( 'success' === response.status ) {
                        Swal.fire({ html: response.msg, confirmButtonColor: '#3085d6', icon: 'success' }).then(function(result){
                        if ( result.isConfirmed ) {
                                window.location.href = response.redirectUrl
                            }
                        });
                    } else if ( 'error' === response.status ) {
                        Swal.fire({html: response.msg, confirmButtonColor: '#3085d6', icon: 'error'});
                    } 
        
                }).catch(function(err, xhr, text) {
                    var validationMsgs = 'Some Error Occured.';
                    if( err.status === 500 ) {
                        validationMsgs = 'Webmaster has trying to fix!';              
                    }
                    if( err.status === 422 ) {
                        validationMsgs = 'Please fill the required fileds!';              
                    }
                    Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                });  
        
              }  
            });
         });
    }
}

// Unescape HTML Tag in LAB
$(document).ready(function(e){
    $(".select2").select2({
        escapeMarkup: function(markup) {
        return markup;
    },
    templateResult: function(state) {
        return state.id;
    },
    });
});

  
$(document).ready(function(){
    /*  $(".select2-with-tag").select2({
   tags: true
 }); */

    $(".select2-with-tag").select2({
     tags: true,
        escapeMarkup: function(markup) {
        return markup;
    },
        templateResult: function(state) {
        return state.id;
    },
    });
 });