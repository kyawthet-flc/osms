<!-- PAGENO: OSMS-012 -->
<div class="col-md-10 offset-md-1 pt-5">
       
        <x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
          <x-forms.select-with-value-value :attrs="[
              'class' => 'shop_id escaped-select', 
              'name' => 'size', 
              'selected' => $subProduct->size, 
              'label' => 'Size',
              'list' => ['XL', 'X', 'M', 'S', 'X', 'XL'], 
              'required' => 'required'
          ]" />
          <x-forms.select-with-value-value :attrs="[
              'class' => 'shop_id escaped-select', 
              'name' => 'color', 
              'selected' => $subProduct->color, 
              'label' => 'Color',
              'list' => ['Red', 'Green', 'Yellow'], 
              'required' => 'required'
          ]" />
          <div class="form-group">
              <label>Quantity <span class="required-text-block">Required</span></label>
             <div class="row">
            
              <div class="col-md-4">
                 <label class="sub-label mt-2">Avaiable Quantity</label>
                <input id="quantity_avaiable" number="yes" value="{{ $subProduct->quantity_avaiable }}" name="quantity_avaiable" class="form-control" />
              </div>
             
              <div class="col-md-4">
                <label class="sub-label mt-2">Unit</label>
                <input id="unit" name="unit" class="form-control" value="{{ $subProduct->unit }}" placeholder="Box/ Item/ " />
              </div>
             </div>
          </div>

          <div class="form-group">
              <label for="">Price <span class="required-text-block">Required</span></label>
             <div class="row">
             <div class="col-md-4">
                 <label class="sub-label mt-2">Buying Price</label>
                <input id="" name="price_bought" value="{{ $subProduct->price_bought }}" number="yes" class="form-control" />
              </div>
              <div class="col-md-4">
              <label class="sub-label mt-2">Selling Price</label>
                <input id="" name="price_sold" number="yes" value="{{ $subProduct->price_sold }}" class="form-control" />
              </div>
              <div class="col-md-3">
              <label class="sub-label mt-2">Currency</label>
                <input id="currency" name="currency" value="MMK" value="{{ $subProduct->currency }}" disabled class="form-control" />
              </div>
             </div>
          </div>

          <div class="custom-file-container mb-3" data-upload-id="myUniqueUploadId">
              <label
                  >Upload File
                  <a
                      href="javascript:void(0)"
                      class="custom-file-container__image-clear"
                      title="Clear Image"
                      >&times;</a
                  ></label
              >
              <label class="custom-file-container__custom-file">
                  <input
                      type="file"
                      class="custom-file-container__custom-file__custom-file-input"
                      accept="*"
                      multiple 
                      aria-label="Choose File"
                   />
                  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                  <span
                      class="custom-file-container__custom-file__custom-file-control"
                  ></span>
              </label>
              <div class="custom-file-container__image-preview"></div>
        </div>
        @if( $subProduct->subProductImages()->count() > 0 )
        <div class="form-group exiting-file-wrapper" style="clear: both;mb-3">
            @php
              $subProduct->load(['subProductImages.image']);
            @endphp
            @foreach($subProduct->subProductImages??[] as $k => $subProductImage)
               @if( $subProductImage->image )
                @php 
                  $encrptedImg = base64_encode($subProductImage->image->decryptFile());
                @endphp
                <div class="existing-sub-product_image sub-product-image-{{ $k }} col-md-12">
                <a style="font-size: 14px;text-align:center;" href="data:image/png;base64,{!! $encrptedImg !!}" class="text-success magnific-popup-img">View</a>
                 <a style="font-size: 14px;text-align:center;" class="text-danger mt-1" delete-by-link="yes" 
                 confirmationText="Are you sure to delete?" remove-element=".sub-product-image-{{ $k }}" 
                 del-redirect-url="{{ url()->full() }}" 
                 href="{{ route('product.sub_product_image.delete', $subProductImage) }}">Delete</a>  
              </div>
              @endif
            @endforeach 
        </div>
        @endif

          <x-forms.textarea :attrs="['name' => 'desc', 'value' => $subProduct->desc, 'label' => 'Detail Description']" />
          <hr/>
          <x-forms.button confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
          :attrs="['name' => 'submit', 'class'=> 'common-sb-btn btn btn-success', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
      </x-forms.form-tag>
 
  </div>