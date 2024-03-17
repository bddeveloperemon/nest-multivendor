<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <!-- MAIN SLIDES -->
                            <img src="" id="pImage" alt="product image" />
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <h6 class="title-detail"><a href="" id="pName" class="text-heading"></a></h6>
                            <br>
                            <div class="attr-detail attr-size mb-30" id="size_area">
                                <strong class="mr-10" style="width: 60px">Size : </strong>
                                <select name="product_size" id="size" class="form-control">
                                </select>
                            </div>
                            <div class="attr-detail attr-size mb-30" id="color_area">
                                <strong class="mr-10" style="width: 60px">Color : </strong>
                                <select name="product_color" id="color" class="form-control">
                                </select>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="pPrice">ট</span>
                                    <span>
                                        <span class="old-price font-md ml-15" id="oldPrice">ট </span>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="qty" id="qty" class="qty-val" value="1"
                                        min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i
                                            class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Brand: <span class="text-brand" id="pBrand"></span>
                                            </li>
                                            <li class="mb-5">Category:<span class="text-brand" id="pCategory"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Product Code: <span class="text-brand"
                                                    id="pCode"></span></li>
                                            <li class="mb-5">Stock:<span class="badge badge-pill badge-success p-1"
                                                    id="available"
                                                    style="background-color: green; color:#fff;"></span><span
                                                    class="badge badge-pill badge-danger p-1" id="stockout"
                                                    style="background-color: red; color:#fff;"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
