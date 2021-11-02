<div class="col-md-12">
    <x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
        @foreach($colors as $key => $valColor )
        @php
        $subProduct = $product->SubProducts()->whereColor($valColor)->whereSize($selectedSize)->first()?? $subProduct
        @endphp
        <div class="row mt-1 mb-2 p-3" style="border-bottom:1px solid #d0d0d0;height: auto;border-radius: 5px;">
            <div class="col-md-4">
                <div class="form-group variation-list-form-group">
                    <label>Size and Color/ {{ $selectedSize }} - {{ $valColor }}/ {{ $subProduct->color }}</label>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="sub-label mt-2">Size</label>
                            <input id="color" name="variations[{{$key}}][size]" nameHolder="variations.{{$key}}.size"
                                value="{{ $selectedSize }}" readOnly="readOnly" class="form-control" />
                        </div>
                        <div class="col-md-8">
                            <label class="sub-label mt-2">Color Code</label>
                            <input id="color" name="variations[{{$key}}][color]" nameHolder="variations.{{$key}}.color"
                                value="{{ $valColor }}" readOnly="readOnly" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pr-1">
                <div class="form-group variation-list-form-group">
                    <label>Quantity <span class="required-text-block">Required</span></label>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="sub-label mt-2">Avaiable Quantity</label>
                            <input id="quantity_avaiable" number="yes" value="{{ $subProduct->quantity_avaiable }}"
                                name="variations[{{$key}}][quantity_avaiable]"
                                nameHolder="variations.{{$key}}.quantity_avaiable" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="sub-label mt-2">Unit</label>
                            <input id="unit" name="variations[{{$key}}][unit]" class="form-control"
                                value="{{ $subProduct->unit }}" placeholder="Box/ Item/ "
                                nameHolder="variations.{{$key}}.unit" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group variation-list-form-group">
                    <label for="">Price <span class="required-text-block">Required</span></label>
                    <div class="row">
                        <div class="col-md-5">
                            <label class="sub-label mt-2">Buying Price</label>
                            <input id="" name="variations[{{$key}}][price_bought]"
                                nameHolder="variations.{{$key}}.price_bought" value="{{ $subProduct->price_bought }}"
                                number="yes" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <label class="sub-label mt-2">Selling Price</label>
                            <input id="" nameHolder="variations.{{$key}}.price_sold"
                                name="variations[{{$key}}][price_sold]" number="yes"
                                value="{{ $subProduct->price_sold }}" class="form-control" />
                        </div>
                        <div class="col-md-3">
                            <label class="sub-label mt-2">Currency</label>
                            <input id="currency" name="variations[{{$key}}][currency]" value="MMK"
                                value="{{ $subProduct->currency }}" disabled class="form-control"
                                nameHolder="variations.{{$key}}.currency" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
          <x-forms.textarea :attrs="['name' => 'desc', 'value' => $subProduct->desc, 'label' => 'Detail Description']" />
          </div>  -->
        </div>
        @endforeach
        <div class="col-md-12 text-center">
            <x-forms.button confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
                :attrs="['name' => 'submit', 'class'=> 'common-sb-btn btn btn-success', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
        </div>
    </x-forms.form-tag>
</div>