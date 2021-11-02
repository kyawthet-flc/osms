<!-- PAGENO: OSMS-031 -->
<x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
    <input type="hidden" name="product_id" value="{{ $productId }}" />
    <x-forms.select-with-key-value :attrs="['class' => 'supplier_id', 'name' => 'supplier_id', 'selected' => $productSupplyment->supplier_id, 'label' => 'Supplier', 'required' => 'required', 'list' => $suppliers]" /> 
    
    <div class="form-group">
            <label for="">Price <span class="required-text-block">Required</span></label>
            <div class="row">
                <div class="col-md-4">
                    <label class="sub-label mt-2" for="total_amount">Total Amount</label>
                    <input id="total_amount" name="total_amount" value="{{ $productSupplyment->total_amount?? 0 }}" number="yes" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label class="sub-label mt-2" for="paid_amount">Paid Amount</label>
                    <input id="paid_amount" name="paid_amount" number="yes" value="{{ $productSupplyment->paid_amount?? 0 }}" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label class="sub-label mt-2" for="remaining_amount">Remaining Amount</label>
                    <input id="remaining_amount" name="remaining_amount" number="yes" value="{{ $productSupplyment->remaining_amount?? 0 }}" class="form-control" />
                </div>
             </div>
          </div>

    <x-forms.textarea :attrs="['name' => 'remark', 'value' => $productSupplyment->remark, 'label' => 'Remark']" />
   
  
    <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
     :attrs="['name' => 'submit', 'class'=> 'common-sb-btn', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
</x-forms.form-tag>