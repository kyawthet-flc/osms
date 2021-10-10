$(function(){ 
    var EnforcementLabSection = {
        
        getLabResultRequestForm: function(btn) {
            $(document).on('click', btn, function(e){        
                e.preventDefault();
                var headerTitle = $(this).attr('header-title');
                var labResultRequestFormContainer = $('.modal-container');
                
                $.ajax({
                    url: $(this).attr('href'),
                    data: {redirectUrl: $(this).attr('redirect-url')}
                }).then(function(response){

                    if ( 'success' === response.status ) {
                    labResultRequestFormContainer.find('.header-title').html(headerTitle);
                    labResultRequestFormContainer.find('.lab-result-request-form-wrapper').html(response.data.view);
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
        sendLabResultRequestBtn: function(btn) {

            $(document).on('click', btn, function(e){
                e.preventDefault();

                var requestForm = $('#' + $(this).attr('form-id') );
                requestForm.find('input[name="actionType"]').val( $(this).attr('value') );

                Swal.fire({
                    title: "Are you sure?",
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
                        url: requestForm.attr('action'),
                        data: new FormData(requestForm[0]), 
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
                        var validationMsgs;
                        if( err.status === 500 ) {
                            validationMsgs = 'Webmaster has trying to fix!';              
                        }
                        if( err.status === 422 ) {
                            validationMsgs = 'Please check some fields!';              
                        }
                        Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                    });  

                }  
                });
            });

        },
        LabDecisionForm: function(btn) {

                 $(document).on('click', btn, function(e){
                    e.preventDefault();
                    
                    var labAction = $(this).attr('action');
                    var href = $(this).attr('href');
                    var title = "Are you sure to " +(labAction=='make-pass'? 'pass this lab': 'fail this lab')+ "?";
               
                    Swal.fire({
                        title: title,
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
                                url: href,
                                data: {
                                    labAction: labAction,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                }
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
                                var validationMsgs;
                                if( err.status === 500 ) {
                                    validationMsgs = 'Webmaster has trying to fix!';              
                                }
                                if( err.status === 422 ) {
                                    validationMsgs = 'Please check some fields!';              
                                }
                                Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                            });  

                        }  
                    });
                }); 
               /*  $(document).on('click', '.set-lab-result-request-form', function(e){
                    e.preventDefault();
                    
                    var labAction = $(this).attr('action');
                    var href = $(this).attr('href');
                    var redirectUrl = $(this).attr('redirect-url');
                    var title = "Are you sure to " +(labAction=='make-pass'? 'pass this lab': 'fail this lab')+ "?";
                     
                    var modalWrapper = $('.modal-container');
                    
                    $.ajax({
                        url: $(this).attr('href'),
                        data: {redirectUrl: $(this).attr('redirect-url')}
                    }).then(function(response){

                        if ( 'success' === response.status ) {
                         labResultRequestFormContainer.find('.header-title').html(headerTitle);
                        modalWrapper.find('.lab-result-request-form-wrapper').html(response.data.view);
                        modalWrapper.modal("show");
                        } else if ( 'error' === response.status ) {
                            Swal.fire({html: "Cannot load Result Request Form.", confirmButtonColor: '#3085d6', icon: 'error'});
                        } 

                    }).catch(function(err, xhr, text) {
                        var validationMsgs;
                        if( err.status === 500 ) {
                            validationMsgs = 'Webmaster has trying to fix!';              
                        }
                        Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                    });
                }); */

            }
    }

    EnforcementLabSection.getLabResultRequestForm('.get-lab-result-request-form');
    EnforcementLabSection.sendLabResultRequestBtn('.send-lab-result-request-btn');
    EnforcementLabSection.LabDecisionForm('.set-lab-result-request-form');

   
  });