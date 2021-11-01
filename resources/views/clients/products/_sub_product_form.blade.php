<!-- PAGENO: OSMS-012 -->
<div class="col-md-12 pt-5">

<div class="row">
        <div class="col-md-3">
            <x-forms.select-with-value-value :attrs="[
                'class' => 'shop_id', 
                'name' => 'size', 
                'selected' => $subProduct->size, 
                'label' => 'Size',
                'list' => $sizes, 
                'required' => 'required'
            ]" />
          </div>
        </div>
      
        <x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
       
        @foreach([1] as $k )
        <div class="row mt-1 mb-2 p-3" style="border:1px solid red;height: auto;border-radius: 5px;"> 
        
          <div class="col-md-2">
          <div class="form-group">
              <label></label>
           
            <input type="hidden" value="{{ $subProduct->size }}" name="size" />
             <x-forms.select-with-value-value :attrs="[
                  'class' => 'shop_id', 
                  'name' => 'color', 
                  'selected' => $subProduct->color, 
                  'label' => 'Color',
                  'list' => $colors, 
                  'required' => 'required'
              ]" />

             </div>
          </div> 

          <div class="col-md-4">
          <div class="form-group">
              <label>Quantity <span class="required-text-block">Required</span></label>
             <div class="row">
            
              <div class="col-md-6">
                 <label class="sub-label mt-2">Avaiable Quantity</label>
                <input id="quantity_avaiable" number="yes" value="{{ $subProduct->quantity_avaiable }}" name="quantity_avaiable" class="form-control" />
              </div>
             
              <div class="col-md-6">
                <label class="sub-label mt-2">Unit</label>
                <input id="unit" name="unit" class="form-control" value="{{ $subProduct->unit }}" placeholder="Box/ Item/ " />
              </div>
             </div>
          </div>
          </div>
          <div class="col-md-5">

          <div class="form-group">
              <label for="">Price <span class="required-text-block">Required</span></label>
             <div class="row">
             <div class="col-md-5">
                 <label class="sub-label mt-2">Buying Price</label>
                <input id="" name="price_bought" value="{{ $subProduct->price_bought }}" number="yes" class="form-control" />
              </div>
              <div class="col-md-5">
              <label class="sub-label mt-2">Selling Price</label>
                <input id="" name="price_sold" number="yes" value="{{ $subProduct->price_sold }}" class="form-control" />
              </div>
              <div class="col-md-2">
              <label class="sub-label mt-2">Currency</label>
                <input id="currency" name="currency" value="MMK" value="{{ $subProduct->currency }}" disabled class="form-control" />
              </div>
             </div>
          </div>
          </div>
          <!-- <div class="col-md-3">

          <x-forms.textarea :attrs="['name' => 'desc', 'value' => $subProduct->desc, 'label' => 'Detail Description']" />
          
          </div>  -->
          </div>
          @endforeach
          <x-forms.button confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
          :attrs="['name' => 'submit', 'class'=> 'common-sb-btn btn btn-success', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
      </x-forms.form-tag>
 
  </div>