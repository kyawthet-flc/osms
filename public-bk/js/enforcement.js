var ElementHelpers = {
    displayOverlay: function(msg) {
        var overlay = $('<div class="form-overlay" style="text-align: center;padding-top: 180px;top: 0;bottom: 0;left: 0;right: 0;background-color: rgba(255,255,255,0.7) !important;position: fixed;z-index: 30000;overflow: hidden;"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only"></span></div><br/><span style="font-size: 19px;">'+(msg?msg: 'Loading...')+'</span></div>');
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
                console.log(">> ", obj)
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

    customToastr: function(msg, type = 'success') {
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "700",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "7000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        
        if ( type === 'success' ) {
            toastr.success(msg);
        }
        if ( type === 'info' ) {
            toastr.info(msg);
        }
        if ( type === 'error' ) {
            toastr.error(msg);
        }

    }
}

var OFFICER_ACTION = (function(){

    function _eachAction() {
        // Each Action For To-Approve and To-Reject
        $('.each-dg-action').on('click', function(e){

            e.preventDefault();
            var form = $('#each-form-action');
            var self = $(this);

            var url = $(this).attr('href');
            var caseId = $(this).attr('case-id');
            var caseText = $(this).attr('case-text');
            var caseType = $(this).attr('case-type');
            var actionType = $(this).attr('action-type');
            var redirectUrl = $(this).attr('redirect-url');
            var remark = $('textarea[comment-box="comment-box-'+caseId+'"]').val();

            Swal.fire({
                    title: "Are you sure " + caseText + '?',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    ElementHelpers.disableElement(self);
                    ElementHelpers.displayOverlay('Please wait...');

                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            comment: remark,
                            caseId: caseId,
                            caseType: caseType,
                            actionType: actionType,
                            redirectUrl: redirectUrl
                        },
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

                        ElementHelpers.enableElement( self );
                        ElementHelpers.hideOverlay();

                    }).catch(function(err, xhr, text) {

                            var validationMsgs;
                            if( err.status === 500 ) {
                                validationMsgs = 'Webmaster has trying to fix!';              
                            }

                            Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();
                    });
                }
            });

            });
    }

    var _dgHandlingController = (function(
            childrenInputCheckbox, parentInputCheckbox, approveAllWrapper, rejectAllWrapper
            ) {

            function toggleApproveAllWrapper(shouldDisplay) {
                approveAllWrapper.prop('disabled', !shouldDisplay);
            }

            function toggleRejectAllWrapper(shouldDisplay) {
                rejectAllWrapper.prop('disabled', !shouldDisplay);
            }

            parentInputCheckbox.on('change',function(){
                childrenInputCheckbox.prop('checked',$(this).prop('checked'));
                toggleApproveAllWrapper( $(this).is(':checked') );
                toggleRejectAllWrapper( $(this).is(':checked') );
            });

            childrenInputCheckbox.on('change',function(){

                var checkedCount = unCheckedCount = 0;
                $.each(childrenInputCheckbox, function(key, inpitObj) {
                    if ( $(inpitObj).is(':checked') ) {
                        checkedCount = checkedCount + 1;
                    } else {
                        unCheckedCount = unCheckedCount + 1;                    
                    }
                });

                if ( checkedCount === childrenInputCheckbox.length ) {
                    parentInputCheckbox.prop('checked', true);
                    toggleApproveAllWrapper(true);
                    toggleRejectAllWrapper(true);
                }

                if ( checkedCount < childrenInputCheckbox.length ) {
                    parentInputCheckbox.prop('checked', false);
                    toggleApproveAllWrapper(true);
                    toggleRejectAllWrapper(true);
                }

                if ( unCheckedCount === childrenInputCheckbox.length ) {
                    parentInputCheckbox.prop('checked', false);
                    toggleApproveAllWrapper(false);
                    toggleRejectAllWrapper(false);
                }

            });

    });

    _dgHandlingController($('.individual-case'), $('.select-all-cases'), $('.approve-all-button'), $('.reject-all-button'));

    function _groupAction() {
                // Group Action for Approve or Reject
            $('.group-action-button').on('click', function(e){

            var redirectUrl = $(this).attr('redirect-url');
            var actionType = $(this).val();
            var caseText = $(this).attr('case-text');
            var url = $(this).attr('url');

            var self = $(this);

            var dataArr = [];

            $.each($('.application-tr').find('input[type="checkbox"]'), function(key, checkInput){
                if( $(checkInput).is(":checked") ) {                    
                    dataArr.push({
                        caseId: $(checkInput).val(),
                        comment: $('textarea[comment-box="comment-box-'+($(checkInput).val())+'"]').val()
                    });
                }
            });

            if( dataArr.length > 0 ) {             

                Swal.fire({
                    title: "Are you sure " + caseText + "?",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        ElementHelpers.disableElement(self);
                        ElementHelpers.displayOverlay('Please wait...');
                        
                        $.ajax({
                            url: url,
                            method: 'post',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                caseType: 'multiple',
                                actionType: actionType,
                                redirectUrl: redirectUrl,
                                lists: dataArr
                            },
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
                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();

                        }).catch(function(err, xhr, text) {

                                var validationMsgs;
                                if( err.status === 500 ) {
                                    validationMsgs = 'Webmaster has trying to fix!';              
                                }

                                Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                                ElementHelpers.enableElement( self );
                                ElementHelpers.hideOverlay();
                        });
                        
                    }
                });
            } 

        });
    }
    
    function _togglingActionBoxByBtn()
    {
        /* 
        Toggling Action Boxes if respective button is triggered.
        */
        $(document).on('click', ".officer-action-btn",function(e){
            var actionName = $(this).attr('action-name');
            var activeBlock = $('#' + actionName );  
            $('.actions-block-group').hide(300);
            $('#' + actionName ).toggle(400);          
        });
    }

    function _submitActionBox()
    {
            // Auto Cancel Button
            $('.submit-action-btn').on('click', function(e){
                e.preventDefault();
                
                var form = $(this).parents('form');
                var self = $(this);

                // var formId = $(this).parents('form').attr('id');
                // var form = $('#' + formId );

                // if complete btn clickec,do the required collections
                var completeArray = [];
                if( form.attr('id') === 'incomplete-form' ) {

                    $.each($('.incompletes'), function(k, obj){
                        if ( $(obj).is(':checked') ) {
                            completeArray.push({
                                file_code: $(obj).val(), 
                                p_id: ($(obj).siblings('input:hidden').val())? $(obj).siblings('input:hidden').val(): '',
                                comment: ($(obj).parents('td').children('textarea').val())? $(obj).parents('td').children('textarea').val(): '',
                            });
                        }
                        
                    });
                    if( completeArray.length > 0 ) { 
                        $('input[name="incompleteAttachments"]').val(JSON.stringify(completeArray));
                    }
                }

                Swal.fire({
                    title: "Are you sure submit?",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        ElementHelpers.disableElement(self);
                        ElementHelpers.displayOverlay('Processing... Please wait!');

                        $.ajax({
                            method: form.attr('method'), 
                            url: form.attr('action'), 
                            data: new FormData(form[0]), 
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
        
                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();
        
                        }).catch(function(err, xhr, text) {
        
                            var validationMsgs = '';
        
                            if (err.status === 422) {
        
                                validationMsgs += '<b>Please Enter!</b>';
                                for(var fieldName in err.responseJSON.errors ) {
                                    if ( typeof(err.responseJSON.errors[fieldName][0]) !== 'undefined' ) {
                                    validationMsgs += "<br/>" + err.responseJSON.errors[fieldName][0];
                                    }
                                }
        
                            } else if( err.status === 500 ) {
                                validationMsgs += 'Webmaster has trying to fix!';              
                            }
        
                            Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();
                            
                        });
                    }
                });

            });
    } 

    function _init() {
        _eachAction();
        _groupAction();
    }


    return {
        togglingActionBoxByBtn: function(){
            _togglingActionBoxByBtn();
        },
        submitActionBox: function(){
            _submitActionBox();
        },
        eachAction: function(){
            _eachAction();
        },
        groupAction: function(){
            _groupAction();
        },
        init: function(){
            _init();
        }
    }

});

var MultiCheckboxSelection = (function(childInputSelection, parentInputCheckbox, intialPageLoad=false) {

    parentInputCheckbox.on('change',function(){
        childInputSelection.prop('checked', parentInputCheckbox.is(':checked'));
    });

    if ( intialPageLoad ) {
        if(childInputSelection.filter(':checked').length === childInputSelection.length) {
            parentInputCheckbox.prop('checked', true);
        }
    }      

    childInputSelection.on('change', initChecked);

    function initChecked(){

        var checkedCount = unCheckedCount = 0;
        $.each(childInputSelection, function(key, inpitObj) {
            if ( $(inpitObj).is(':checked') ) {
                checkedCount = checkedCount + 1;
            } else {
                unCheckedCount = unCheckedCount + 1;                    
            }
        });

        if ( checkedCount === childInputSelection.length ) {
            parentInputCheckbox.prop('checked', true);
        }

        if ( checkedCount < childInputSelection.length ) {
            parentInputCheckbox.prop('checked', false);
        }

        if ( unCheckedCount === childInputSelection.length ) {
            parentInputCheckbox.prop('checked', false);
        }

    }

});

$('input[drug-to-import="drug-to-import"]').click(function(e){

    var self = $(this);          
    // selected
    $.ajax({
    url: self.attr('list-action-url'),
    method: 'post',
    data: {
       _token: $('meta[name="csrf-token"]').attr('content'),
       selected: self.is(':checked')? 'yes': 'no',
        }         
    }).then(function (response) {
        if (response.status === 'success') {
            ElementHelpers.customToastr(response.msg ? response.msg : '', 'success');
            
        } else if ('error' === response.status) {
            self.prop('checked', !self.is(':checked'));
            ElementHelpers.customToastr(response.msg ? response.msg : 'Some error occurs.', 'error');
        }
    }).catch(function (err, xhr, text) { 
        self.prop('checked', !self.is(':checked'));
    });
}); 
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