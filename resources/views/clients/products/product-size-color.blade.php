@if( isset($product->id) )
<div class="row p-1">
    <div class="col-md-12">
        <label for=""><b>Please create size and color code</b></label>
    </div>
    <div class="col-md-12">
        <!-- Loading size and color for initially -->
        <input type="hidden" name="shouldDisplaySizeColor"
            value="{{ route('product.size_color.initial_load',['productId' => $product->id]) }}" />
        <input type="hidden" name="product_id" value="{{ $product->id }}" />

        <div class="form-group mb-2"
            style="min-height: 10px;height: auto;padding: 10px;background-color: #;border:1px solid #d0d0d0;border-radius: 3px;">
            <label>Please create sizes for your product.[SIZE] <a class="btn-warning"
                    onClick="$('.size-form-wrapper').toggle()"><i class="mdi mdi-plus"></i></a></label>
            <div class="col-md-12 mb-1 p-0 size-form-wrapper"
                style="min-height: 10px;height: auto;background-color: #;display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="XL, S, M" name="size"
                            style="width: 70%;float: left;" />
                        <input type="button" class="btn btn-primary ml-1" target="size" style="float: left;"
                            target-display-container="ajax-size-wrapper" button-action="add-product-size-color"
                            action="{{ route('product.size_color.save') }}" value="Add" />
                    </div>
                </div>
                <textarea name="size_remark" rows="2" placeholder="Remark:" class="form-control clearfix mt-1" cols="30"
                    rows="10"></textarea>
            </div>
            <div class="col-md-12 mt-1 mb-3 ajax-size-wrapper" style="min-height: 0;height: auto;background-color: #;">
            </div>
        </div>
        <div class="form-group mb-1"
            style="min-height: 10px;height: auto;padding: 3px 10px;background-color: #;border:1px solid #d0d0d0;border-radius: 3px;">
            <label>Please create colors for your product.[COLOR] <a class="btn-warning"
                    onClick="$('.color-form-wrapper').toggle()"><i class="mdi mdi-plus"></i></a></label>
            <div class="col-md-12 mb-1 p-0 color-form-wrapper"
                style="min-height: 10px;height: auto;background-color: #;display: none;">
                <div class="row">
                    <div class="col-md-12">

                        <input type="hidden" class="form-control" name="color" value="NONE"
                            style="width: 70%;float: left;" />
                        <input type="file" accept="image/*" class="form-controls" name="colorId" id="colorId"
                            style="width: 70%;float: left;margin-lefy: 3px" />
                        <input type="button" class="btn btn-primary clearfix ml-1" target="color" style="float: left;"
                            target-display-container="ajax-color-wrapper" button-action="add-product-size-color"
                            action="{{ route('product.size_color.save') }}" value="Add" />
                    </div>
                </div>
                <textarea name="color_remark" rows="3" placeholder="Remark:"
                    class="form-control clearfix mt-1"></textarea>
            </div>
            <div class="col-md-12">
                <img style="width: 35px;height: 35px;border-radius: 5px;border:1px solid #d0d0d0;display: none;"
                    class="magnific-popup-img" id="color-image-preview" src="#" href="#" alt="." />
            </div>
            <div class="col-md-12 mt-1 mb-3 ajax-color-wrapper" style="min-height: 0;height: auto;background-color: #;">
            </div>
        </div>        
    </div>
</div>
@endif