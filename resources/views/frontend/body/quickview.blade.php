<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                               <!--   
                              <input type="hidden" id="vendor_id" value="{{-- $product->vendor_id --}}">
                               -->
                    <img src="" alt="product image"  id="pimage" style="width:50%; height:auto;" />
                            </div>
                        
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                              
                                <h5 class="title-detail"><a href=" " class="text-heading" id="pname"></a></h5>
                                <br>

                            <!--        

                           <div class="attr-detail attr-size mb-30" id="sizeArea">
                             <strong class="mr-10" style="width:60px;">Méret : </strong>
                             <select class="form-control unicase-form-control" id="size" name="size" required>
                                <option selected="" disabled="">--Válassz méretet--</option>
                     
                              
                             </select>
                            </div>                
                            <div class="attr-detail attr-size mb-30" id="colorArea">
                            <strong class="mr-10" style="width:60px;">Szín : </strong>
                             <select class="form-control unicase-form-control" id="color" name="color" required>  
                             
                             </select>
                            </div>
                        -->




                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand" id="pprice" style="font-size: 30px;"> </span>
                                        <span class="current-price text-brand">  </span>
                                        <span>
                                         
                                            <span class="old-price font-md ml-15" id="oldprice"style="font-size: 30px;"> </span>
                                            <span class="old-price font-md ml-15" > </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <input type="hidden"  id="product_id">
                                        <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shopping-cart"></i>Kosárba</button>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                      <div class="font-xs">
                                         <ul>
                                       
                                            <li class="mb-5">Kategória:<span class="text-brand" id="pcategory"> </span></li> 
                                        
                                        </ul>
                                </div>
                                    </div>

                                 <div class="col-md-6">
                                      <div class="font-xs">
                                         <ul>
                                       
                                       
                                        </ul>
                                </div>
                                    </div>
                                </div>


                    
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>