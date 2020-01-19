var ProfileFn = function(){

}


ProfileFn.prototype.init = function(){
        this.handleForm('#profile_form');
}
ProfileFn.prototype.initExtraInfo = function(){
        this.handleForm('#profile_form');
        this.bindElement();
        this.dataPickerElement();
}

ProfileFn.prototype.dataPickerFn = function(className){
    var id =className+'_1';
    var id1 =className+'_2';
    jQuery('#'+id).datetimepicker({format: 'LT'});
    jQuery('#'+id1).datetimepicker({
        format: 'LT',
        useCurrent: false //Important! See issue #1075
    });
    jQuery("#"+id).on("dp.change", function (e) {
        jQuery('#'+id1).data("DateTimePicker").minDate(e.date);
    });
    jQuery("#"+id1).on("dp.change", function (e) {
        jQuery('#'+id).data("DateTimePicker").maxDate(e.date);
    });
}
ProfileFn.prototype.dataPickerElement = function(){
  
    this.dataPickerFn('m_s_datetimepicker_m');
    this.dataPickerFn('m_s_datetimepicker_e');
    this.dataPickerFn('s_datetimepicker_m');
    this.dataPickerFn('h_s_m_datetimepicker_m');
    this.dataPickerFn('h_s_m_datetimepicker_e');
    this.dataPickerFn('h_s_datetimepicker_m');
}
ProfileFn.prototype.bindElement = function(){
     jQuery('#home_visit').click(function(){
          if(jQuery(this).is(':checked')){
              jQuery('#home_visit_div').show();
            }
            else{
                jQuery('#home_visit_div').hide();
          }
          
        });
        jQuery('.chosen-select').chosen({width: "100%"});

     jQuery('#add_doctor').click(function(){
            var ele = jQuery('#doctors_list').find('tr').clone();
            ele.find('input').attr('value','');
            ele.find('img').remove();
            jQuery('#doctors_list tbody').after('<tr>'+jQuery(ele).html()+'</tr>');
     });
     jQuery('#add_certificates').click(function(){
        
            var ele = jQuery('#certificates_list').find('tr').clone();
            ele.find('input').attr('value','');
            ele.find('img').remove();
            jQuery('#certificates_list tbody').after('<tr>'+jQuery(ele).html()+'</tr>');
     });

     jQuery(document).on('click','.delete_certificate',function(){
        if(jQuery('#certificates_list').find('tr').length > 1){
            jQuery(this).parents('tr').remove();
        }
        else{
            App.showMessage('add at least one','error');
        }
 });

     jQuery(document).on('click','.delete_doctor',function(){
            if(jQuery('#doctors_list').find('tr').length > 1){
                jQuery(this).parents('tr').remove();
            }
            else{
                App.showMessage('add at least one','error');
            }
     });
}
ProfileFn.prototype.categorySubCategory = function(categoryArr){
    App.getSubCategory(categoryArr,jQuery('#category_id option:selected').val(),'subcategory_id') 
    jQuery(document).on('change','#category_id',function(){
        App.getSubCategory(categoryArr,jQuery(this).val(),'subcategory_id') 
    });

}

ProfileFn.prototype.handleForm = function(formHandle){
    var self = this;
  
	var $frm = jQuery(formHandle);
	jQuery.validator.setDefaults({ ignore: ".ignore" });
	
	$frm.validate({
        // errorElement: 'span', //default input error message container
        // errorClass: 'medical-field-error', // default input error message class
        // focusInvalid: false, // do not focus the last invalid input     

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
        	App.formSubmit(form);
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

ProfileFn.prototype.initFeedback = function(){
    this.feedbackGridUrl = SITE_URL+'/my-feedback/grid'; 
    this.feedbackTable = jQuery('#feedback_table');
    this.feedbackGrid();
 
    this.qaGridUrl = SITE_URL+'/my-qa/grid'; 
    this.qaTable = jQuery('#qa_table');
    this.qaGrid();
    this.bindFeedbackElement();
    this.answerHandelForm();
}
ProfileFn.prototype.bindFeedbackElement = function(){
    var self = this;
    jQuery(document).on('click','.readMoreMessage',function(){
            jQuery('#reviewMessageShowModal').find('#messageTag').html(jQuery(this).attr('data-message'));
            jQuery('#reviewMessageShowModal').modal('show');
    });
    jQuery(document).on('click','.editAnswer',function(){
            jQuery('#editAnswerShowModal').find('#answer').val(jQuery(this).attr('data-answer'));
            jQuery('#editAnswerShowModal').find('#question').html(jQuery(this).attr('data-question'));
            jQuery('#editAnswerShowModal').find('input[name="id"]').val(jQuery(this).attr('data-id'));
            jQuery('#editAnswerShowModal').modal('show');
    });

    jQuery(document).on('click','.feedbackStatus',function(e){
        e.preventDefault();
        var id = jQuery(this).attr('data-id');
        var data = {};
        data.success = function(){
        var params = {};
        params.data = {
            'id':id,
            '_token':jQuery('[name="csrf_token"]').attr('content')            
          };
        params.type = 'post';
        params.success = function(data){
          App.showMessage(data.message,data.status);
          if(data.status == 'success')
          {
              self.feedbackTable.fnDraw();
          }
        }
        App.sendRequest('/my-feedback/statusChange', params);
 
      }
        App.showConfirm(jQuery(this),e,data);
    });

    jQuery(document).on('click','.qaStatus',function(e){
        e.preventDefault();
        var id = jQuery(this).attr('data-id');
        var data = {};
        data.success = function(){
        var params = {};
        params.data = {
            'id':id,
            '_token':jQuery('[name="csrf_token"]').attr('content')            
          };
        params.type = 'post';
        params.success = function(data){
          App.showMessage(data.message,data.status);
          if(data.status == 'success')
          {
              self.qaTable.fnDraw();
          }
        }
        App.sendRequest('/my-qa/statusChange', params);
 
      }
        App.showConfirm(jQuery(this),e,data);
    });
 
}

ProfileFn.prototype.answerHandelForm= function(){
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
                jQuery('#editAnswerShowModal').modal('hide');
                self.qaTable.fnDraw();
              }
            }
          
            App.sendRequest('/saveAnswer', params);
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
ProfileFn.prototype.feedbackGrid = function(){
    var self = this;
    var params = {};
    params.order = [ [ 0, 'desc' ] ];
    params.searching = false;

    params.columnDefs = [{
        'targets' : [-1,0],
        'orderable'	: false,
        'searchable':false
    },
    ];
    params.fnRowCallback =function (nRow, aData, iDisplayIndex) {
        jQuery("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
        return nRow;
    }
    self.feedbackTable = App.showDataTable(this.feedbackTable,this.feedbackGridUrl, params);
}

ProfileFn.prototype.qaGrid = function(){
    var self = this;
    var params = {};
    params.order = [ [ 0, 'desc' ] ];
    params.searching = false;
    params.columnDefs = [{
        'targets' : [-1,0],
        'orderable'	: false,
        'searchable':false
    },
    ];
    params.fnRowCallback =function (nRow, aData, iDisplayIndex) {
        jQuery("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
        return nRow;
    }
    self.qaTable = App.showDataTable(this.qaTable,this.qaGridUrl, params);
}