<!-- PAGENO: OSMS-012 -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">Add Product Variations</h2>
          <button class="modal__close" data-custom-close="modal-1" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content w-100" id="modal-1-content">
       
        <x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
          <x-forms.select-with-value-value :attrs="[
              'class' => 'shop_id escaped-select', 
              'name' => 'size', 
              'selected' => $product->shop_id, 
              'label' => 'Size',
              'list' => ['a', 'b'], 
              'required' => 'required'
          ]" />
          <x-forms.select-with-value-value :attrs="[
              'class' => 'shop_id escaped-select', 
              'name' => 'color', 
              'selected' => $product->shop_id, 
              'label' => 'Color',
              'list' => ['a', 'b'], 
              'required' => 'required'
          ]" />
          <div class="form-group">
              <label>Quantity <span class="required-text-block">Required</span></label>
             <div class="row">
             <div class="col-md-4">
                 <label class="sub-label">Bought Quantity</label>
                <input id="quantity_bought" number="yes" name="quantity_bought" class="form-control" />
              </div>
              <div class="col-md-4">
                 <label class="sub-label">Avaiable Quantity</label>
                <input id="quantity_avaiable" number="yes" name="quantity_avaiable" class="form-control" />
              </div>
              <!-- <div class="col-md-6 mt-2">
                <label class="sub-label">Left Quantity</label>
                <input id="quantity_left" name="quantity_left" class="form-control" />
              </div> -->
              <div class="col-md-4">
                <label class="sub-label">Unit</label>
                <input id="unit" name="unit" class="form-control" placeholder="Box/ Item/ " />
              </div>
             </div>
          </div>

          <div class="form-group">
              <label for="">Price <span class="required-text-block">Required</span></label>
             <div class="row">
             <div class="col-md-4">
                 <label class="sub-label">Buying Price</label>
                <input id="" name="price_bought" number="yes" class="form-control" />
              </div>
              <div class="col-md-4">
              <label class="sub-label">Selling Price</label>
                <input id="" name="price_sold" number="yes" class="form-control" />
              </div>
              <div class="col-md-3">
              <label class="sub-label">Currency</label>
                <input id="currency" name="currency" value="MMK"  disabled class="form-control" />
              </div>
             </div>
          </div>

          <div class="input-field mb-4">
            <label class="active">Photos</label>
            <div class="input-images" style="padding-top: .5rem;"></div>
        </div>

          <x-forms.textarea :attrs="['name' => 'desc', 'value' => $product->desc, 'label' => 'Detail Description']" />
          <hr/>
          <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
          :attrs="['name' => 'submit', 'class'=> 'common-sb-btn', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
      </x-forms.form-tag>

          </main>
        <footer class="modal__footer">
          <button class="modal__btn" data-custom-close="modal-1" data-micromodal-close aria-label="Close this dialog window">Cancel</button>
        </footer>
      </div>
    </div>
  </div>