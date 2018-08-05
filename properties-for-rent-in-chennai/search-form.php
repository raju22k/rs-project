<!--Modal: Search Form-->
<div class="modal fade left" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-left" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header default-color-dark text-center">
                <h4 class="modal-title white-text w-100 font-bold py-2">Search Property</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified indigo" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#for-rent" role="tab">Rent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#for-sale" role="tab">Sale</a>
                    </li>
                </ul>
                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 1-->
                    <div class="tab-pane fade in show active" id="for-rent" role="tabpanel">
                        <br>
                        <form method="POST" action="properties-for-rent-in-chennai.php" name="searchfrm">

                          <!-- Locality -->
                          <div class="row">
                            <div class="col-md-12">
                            <select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Area" data-width="100%" name="property_locality">
                              <option value="" selected>Select Area</option>   
                            <?php  
                              $property_locality = $user->getRows("property_locality");
                                          if(!empty($property_locality)): $count = 0; foreach($property_locality as $property_local): $count++;
                                    ?>
                                      <option value="<?php echo $property_local['locality']; ?>"><?php echo $property_local['locality']; ?></option>
                                      <?php endforeach; else: 
                                      endif; 
                                      ?>
                            </select>
                          </div>
                          </div>

                        <!-- Row -->
                        <div class="row">
                          <!-- Type -->
                          <div class="col-md-12">
                            <select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Type" data-width="100%" name="property_type">
                              <option value="" selected>Select Property Type</option>   
                            <?php  
                               $prop_condition['where']['prop_status'] = '1'; //RENT 
                              $property_types = $user->getRows("property_types", $prop_condition);
                                          if(!empty($property_types)): $count = 0; foreach($property_types as $property_type): $count++;
                                    ?>
                                      <option value="<?php echo $property_type['id']; ?>"><?php echo $property_type['title']; ?></option>
                                      <?php endforeach; else: 
                                      endif; 
                                      ?>
                            </select>
                          </div>
                        </div>
                        <!-- Row / End -->



                        <label>Area Range (in Sqft.)</label>
                        <div class="row md-form">
                          <!-- Area Range -->
                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="area_min" name="area_min" value="" class="form-control">
                                        <label for="area_min" class="">Min Sqft.</label>
                                    </div>
                          </div>

                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="area_max" name="area_max" value="" class="form-control">
                                        <label for="area_max" class="">Max Sqft.</label>
                                    </div>
                          </div>

                        </div>

                        <label>Price Range (in INR)</label>
                        <div class="row md-form">
                          <!-- Area Range -->
                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="price_min" name="price_min" value="" class="form-control">
                                        <label for="price_min" class="">Min INR.</label>
                                    </div>
                          </div>

                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="price_max" name="price_max" value="" class="form-control">
                                        <label for="price_max" class="">Max INR.</label>
                                    </div>
                          </div>

                        </div>
                        <hr>
                        <div class="row md-form">
                          <div class="col-md-12"><center>
                            <button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
                            <button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('properties-for-rent-in-chennai.php')">List All</button></center>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--/.Panel 1-->

                    <!--Panel 2-->
                    <div class="tab-pane fade" id="for-sale" role="tabpanel">
                        <br>
                        <form method="POST" action="../properties-for-sale-in-chennai/properties-for-sale-in-chennai.php" name="searchfrm">

                          <!-- Locality -->
                          <div class="row">
                            <div class="col-md-12">
                            <select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Area" data-width="100%" name="property_locality">
                              <option value="" selected>Select Area</option>   
                            <?php  
                              $property_locality = $user->getRows("property_locality");
                                          if(!empty($property_locality)): $count = 0; foreach($property_locality as $property_local): $count++;
                                    ?>
                                      <option value="<?php echo $property_local['id']; ?>"><?php echo $property_local['locality']; ?></option>
                                      <?php endforeach; else: 
                                      endif; 
                                      ?>
                            </select>
                          </div>
                          </div>


                        <!-- Row -->
                        <div class="row">
                          <!-- Type -->
                          <div class="col-md-12">
                       <select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Type" data-width="100%" name="property_type">
                              <option value="" selected>Select Property Type</option>   
                            <?php  
                               $prop_condition['where']['prop_status'] = '2'; //SALE 
                              $property_types = $user->getRows("property_types", $prop_condition);
                                          if(!empty($property_types)): $count = 0; foreach($property_types as $property_type): $count++;
                                    ?>
                                      <option value="<?php echo $property_type['id']; ?>"><?php echo $property_type['title']; ?></option>
                                      <?php endforeach; else: 
                                      endif; 
                                      ?>
                            </select>
                          </div>
                        </div>
                        <!-- Row / End -->


                        <label>Area Range (in Sqft.)</label>
                        <div class="row md-form">
                          <!-- Area Range -->
                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="area_min" name="area_min" value="" class="form-control">
                                        <label for="area_min" class="">Min Sqft.</label>
                                    </div>
                          </div>

                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="area_max" name="area_max" value="" class="form-control">
                                        <label for="area_max" class="">Max Sqft.</label>
                                    </div>
                          </div>

                        </div>

                        <label>Price Range (in INR)</label>
                        <div class="row md-form">
                          <!-- Area Range -->
                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="price_min" name="price_min" value="" class="form-control">
                                        <label for="price_min" class="">Min INR.</label>
                                    </div>
                          </div>

                          <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" id="price_max" name="price_max" value="" class="form-control">
                                        <label for="price_max" class="">Max INR.</label>
                                    </div>
                          </div>

                        </div>
                        <hr>
                        <div class="row md-form">
                          <div class="col-md-12"><center>
                            <button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
                            <button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('properties-for-rent-in-chennai.php')">List All</button></center>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--/.Panel 2-->
                </div>
       
              </div>


            </div>
            <!--Body-->

        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Search Form-->
