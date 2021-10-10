<!-- <div class="actions-block-group" id="reject-block" style="display: none;">
</div> -->

<div class="modal fade director-decision-wrapper" id="director-decision-wrapper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="row" style="padding: 3px 10px;">
           <div class="col-md-12">
           <form action="" method="post" id="director-decision-form">         
                <input name="redirectUrl" type="hidden" value="">
                <input type="text" class="form-control subject mt-2 mb-2" name="subject" value="{{ '' }}" placeholder="Subject" />
                <textarea 
                placeholder="Comment" 
                require="no" 
                name="body" 
                class="body summernote-lib"></textarea>
                @csrf
                <div class="mt-2 text-right">
                    <input type="submit" class="btn btn-danger no-alert submit-action-btn" value="Submit">
                </div>
            </form>
           </div>
       </div>
    </div>
  </div>
</div>