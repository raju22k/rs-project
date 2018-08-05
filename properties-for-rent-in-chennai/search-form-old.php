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

             <div class="card">
              <div class="card-body">
              <form method="POST" action="list-all.php" name="searchfrm">

              <!-- Row -->
              <div class="row md-form">
                <!-- Status -->
                <div class="col-md-12">
                  <select class="cs-select cs-skin-border" name="property_status">
                  <?php  
                    $property_status = $user->getRows("property_status");
                                if(!empty($property_status)): $count = 0; foreach($property_status as $propertystatus): $count++;
                          ?>
                            <option value="<?php echo $propertystatus['id']; ?>"><?php echo $propertystatus['status']; ?></option>
                            <?php endforeach; else: 
                            endif; 
                            ?>
                  </select>
                </div>
              </div>
              <!-- Row / End -->



                <!-- Locality -->
                <div class="row md-form">
                  <div class="col-md-12">
                  <select class="cs-select cs-skin-border" name="property_locality">
                    <option value="" selected>List All</option>   
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
              <div class="row md-form">
                <!-- Type -->
                <div class="col-md-12">
                  <select class="cs-select cs-skin-border" name="property_type">
                    <option value="" selected>Any Type</option>   
                  <?php  
                    $property_types = $user->getRows("property_types");
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

            </form>


              </div>
            </div>






            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <br>
              <div class="row md-form">
                <div class="col-md-12">
                  <button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
                  <button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('index.php?reset=true')">List All</button>
                </div>
              </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Search Form-->
