var ListingFn = function(){

}

ListingFn.prototype.init = function(){
        this.bindElement();
}

ListingFn.prototype.bindElement = function(){
    var self = this;
    jQuery('.filterElement').change(function(){
          jQuery('#filter_form_ele')[0].submit();
    });
    if(jQuery('.categoryType option:selected').val() > 0){
        self.selectCategory(jQuery('.categoryType option:selected').val());
    }
    jQuery(document).on('change','.categoryType',function(){
        var category = jQuery(this,'option:selected').val();
        self.selectCategory(category); 
    });
}

ListingFn.prototype.selectCategory = function(category) {
    var self = this;
    var slug = typeArr[category];
    jQuery('#search_form_ele').attr('action',SITE_URL+'/'+slug)
    var params = {};
    params.data = {'category':category};
    params.success = function(data){
       self.getSubCategory(data,'categoryListData');
    }
    App.sendRequest('/getCategory', params);
};
ListingFn.prototype.getSubCategory = function(categoryArr,id) {
        var selected = document.getElementById(id).getAttribute('selected_option');	 

        var citiesOptions = "<option value=''>Select Category</option>";
        for (categoryId in categoryArr) {
            if(selected == categoryId){
                citiesOptions += "<option selected='selected' value='"+categoryId+"'>" + categoryArr[categoryId] + "</option>";

            }else{
                citiesOptions += "<option value='"+categoryId+"'>" + categoryArr[categoryId] + "</option>";
            }
        document.getElementById(id).innerHTML = citiesOptions;
    }
}