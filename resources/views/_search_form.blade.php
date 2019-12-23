<section id="about-1" class="about-section division">
    <div class="container">
        <div class="row d-flex align-items-center">

            <!-- ABOUT BOX #3 -->
            <div id="abox-3" >
                <div class="abox-1 white-color">
                    <form id="search_form_ele" >
                        <div class="row d-flex">
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <input type="text" name="location" value="{{ isset($search['location'])?$search['location']:'' }}" id="autocomplete" placeholder="Enter Location" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 ">
                                <div class="form-group">
                                    <label for="">Doctor/Hospital/Test Lab</label>
                                    {!! selectBox('type',config('application.super_categories'),isset($search['type'])?$search['type']:'',array('class'=>'form-control categoryType required','id'=>'category_id'),'Select Category') !!}
                                </div>											
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Category/sub-category</label>
                                    <select name="category"  class="form-control" selected_option="{{isset($search['category'])?$search['category']:''}}" id="categoryListData" placeholder="Select Category">
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mar-btn">
                                    <div class="form-group">
                                    <button  type="submit" class="btn btn-blue blue-hover" >Search</button>
                                    </div>
                            </div>

                        </div>	
                        
                </form>
                </div>
            </div>
        </div>    <!-- End row -->
    </div>	   <!-- End container -->	
</section>	<!-- END ABOUT-1 -->
