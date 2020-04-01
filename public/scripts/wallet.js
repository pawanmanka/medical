var WalletFn = function(){
    var slotIndex;
   }
   
   
   WalletFn.prototype.init = function() {
       this.gridUrl = SITE_URL+'/my-wallet/grid'; 
       this.table = jQuery('#wallet_table');
       this.grid();
       this.bindListElement();
       this.handleForm();
   }
   
   WalletFn.prototype.bindListElement = function(){
       var self = this;
       jQuery(document).on('click','#addWalletMoneyShow',function(){
              jQuery('#addWalletMoneyShowModal').modal('show');
       });
   }
   
  

   
   WalletFn.prototype.handleForm = function() {
       var self = this;
       var formHandle = "#add_wallet_money_form";
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

            var totalAmount =jQuery('#money').val();
            var product_id = Math.random();
            var options = {
            "key":ApiKey,
            "amount": (totalAmount*100),
            "handler": function (response){
                  $.ajax({
                    url: SITEURL + '/wallet/pay-success',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      '_token': jQuery('meta[name="csrf_token"]').attr('content'),
                      payPaymentId:response.razorpay_payment_id , 
                      totalAmount :totalAmount ,
                      productId :product_id,
                    }, 
                    success: function (data) {
                        App.showMessage(data.message,data.status);
                        if(data.status == 'success')
                        {   //wallet_grand_total_amount
                        jQuery('#wallet_grand_total_amount').html(data.total);
                            walletObj.table.fnDraw();
                            jQuery('#addWalletMoneyShowModal').modal('hide');
                        }

                    }
                });
              
            },
           "prefill": {
                "contact": Phone,
                "email":   Email,
            }
          };
          var rzp1 = new Razorpay(options);
          rzp1.open();
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
   };
     
   WalletFn.prototype.grid = function(){
       var self = this;
       var params = {};
       params.order = [ [ 0, 'desc' ] ];
       params.columnDefs = [{
           'targets' : -1,
           'orderable'	: false,
           'searchable':false
       },
       ];
       self.table = App.showDataTable(this.table,this.gridUrl, params);
   }

   WalletFn.prototype.initLabFrom = function(){
    var self = this;
    this.labHandleForm();
}

WalletFn.prototype.labHandleForm = function() {
    var self = this;
    var formHandle = "#add_edit_lab_from";
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
            App.formSubmit($frm);
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
};

   