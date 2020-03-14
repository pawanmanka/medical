var DetailFn = function(){
    
}

DetailFn.prototype.init = function(){
    this.bindElement();
    this.reviewHandelForm();
    this.questionHandelForm();
}

DetailFn.prototype.bindElement= function(){
      var self = this;

      self.questionList();
      self.reviewList();
     
    jQuery(document).on('click','.question_helpfull_status',function(e){
        e.preventDefault();
        var params = {};
        var id = jQuery(this).attr('data-id');
        var status = jQuery(this).attr('data-status');
        var parentEl = jQuery(this).parents('.question_panel');
        params.success = function(data){
          if(data.status == 'success')
          {
              parentEl.find('.question_helpfull').html(data.helpfull);
              parentEl.find('.question_nothelpfull').html(data.nothelpfull);
            
          }
        }
         App.sendRequest('/detail/'+currentUser+'/question-helpfull/'+id+"/"+status,params);
    });
    jQuery(document).on('change','#specification_doctor',function(){
             jQuery('.class-all-specification').hide();  
             jQuery('.'+jQuery(this).val()).show();  
    });
    jQuery(document).on('click','#reviewForm',function(){
               
             jQuery('#reviewFormModal').modal('show');  
    });
    jQuery(document).on('click','#get_questions',function(e){
        e.preventDefault();
        self.questionList();
    });
    jQuery(document).on('click','#get_reviews',function(e){
        e.preventDefault();
        self.reviewList();
    });
}

DetailFn.prototype.questionList= function(){
    var self = this;
    var params = {};
    var offset = jQuery('#question_list_div').attr('data-offset');
    offset = offset === undefined?0:offset;
    params.success = function(data){
    
      if(data.status == 'success')
      {
        if(questionsCount <= data.offset){
            jQuery('#get_questions').remove();

        }  
        jQuery('#question_list_div').append(data.output);
        jQuery('#question_list_div').attr('data-offset',data.offset);
      }
    }
     App.sendRequest('/detail/'+currentUser+'/question/'+offset, params);
}
DetailFn.prototype.reviewList= function(){
    var self = this;
    var params = {};
    var offset = jQuery('#review_list_div').attr('data-offset');
    offset = offset === undefined?0:offset;
    params.success = function(data){
    
      if(data.status == 'success')
      {
        if(questionsCount <= data.offset){
            jQuery('#get_reviews').remove();

        }  
        jQuery('#review_list_div').append(data.output);
        jQuery('#review_list_div').attr('data-offset',data.offset);
      }
    }
     App.sendRequest('/detail/'+currentUser+'/review/'+offset, params);
}

DetailFn.prototype.reviewHandelForm= function(){
    var self = this;
    var formHandle = "#review_form";
    var $frm = jQuery(formHandle);
    jQuery.validator.setDefaults({ ignore: ".ignore" });
    
    $frm.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'medical-field-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input     

        normalizer: function( value ) {
            return $.trim( value );
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            jQuery('.alert-error', $frm).show();
        },

        highlight: function (element) { // hightlight error inputs
            jQuery(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            var params = {};
            params.data = jQuery('#review_form').serializeArray();
            params.type="POST";
            params.success = function(data){
              App.showMessage(data.message,data.status);
              if(data.status == 'success')
              {
                jQuery('#reviewFormModal').modal('hide');
              }
            }
          
            App.sendRequest('/saveReview', params);
            return false;
        }
    });

    jQuery(formHandle+'input').keypress(function (e) {
        if (e.which == 13) {	            	
            if ($frm.validate().form()) {
                App.formSubmit($frm);
            }
            return false;
        }
    });
}
DetailFn.prototype.questionHandelForm= function(){
    var self = this;
    var formHandle = "#question_form";
    var $frm = jQuery(formHandle);
    jQuery.validator.setDefaults({ ignore: ".ignore" });
    
    $frm.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'medical-field-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input     

        normalizer: function( value ) {
            return $.trim( value );
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            jQuery('.alert-error', $frm).show();
        },

        highlight: function (element) { // hightlight error inputs
            jQuery(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            var params = {};
            params.data = jQuery('#question_form').serializeArray();
            params.type="POST";
            params.success = function(data){
              App.showMessage(data.message,data.status);
              if(data.status == 'success')
              {
                jQuery('#questionFormModal').modal('hide');
              }
            }
          
            App.sendRequest('/saveQuestion', params);
            return false;
        }
    });

    jQuery(formHandle+'input').keypress(function (e) {
        if (e.which == 13) {	            	
            if ($frm.validate().form()) {
                App.formSubmit($frm);
            }
            return false;
        }
    });
}