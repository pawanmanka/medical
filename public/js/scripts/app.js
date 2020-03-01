var App = function() {};
App.LOADING_IMAGE = SITE_URL+'assets/images/loader.gif';
App.prevAjaxObject = null;
App.prevAjax = "";
App.ajaxPool = {};

App.getQueryString = function(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
};

App.strReplace = function(from,what,to){
	
	return from.replace(what,to);
	
};

App.abortRequest = function(key){
	if(App.ajaxPool[key]){
		
		App.ajaxPool[key].abort();
		delete App.ajaxPool[key];
	}
	
};

App.abortAllRequest = function(){	
	for(var key in App.ajaxPool){
		App.ajaxPool[key].abort();
		delete App.ajaxPool[key];
	}	
};

App.getSubCategory = function(categoryArr,value,id) {
	var selected = document.getElementById(id).getAttribute('selected_option');	
    if (value.length == 0)
     document.getElementById(id).innerHTML = "<option></option>";
    else {
        var citiesOptions = "<option value=''>Select Category</option>";
        for (categoryId in categoryArr[value]) {
			if(selected == categoryId){
				citiesOptions += "<option selected='selected' value='"+categoryId+"'>" + categoryArr[value][categoryId] + "</option>";
			}
			else{
				citiesOptions += "<option value='"+categoryId+"'>" + categoryArr[value][categoryId] + "</option>";
			}
        }
        document.getElementById(id).innerHTML = citiesOptions;
    }
}

App.showCustomLoader =  function(){
	   var html = "<div id='custom_loading_view'>"
	   html += '<div class="loader-ellips infinite-scroll-request" style="/! display: none; /">';
	   html += '<span class="loader-ellips__dot"></span>';
	   html += '<span class="loader-ellips__dot"></span>'
	   html += ' <span class="loader-ellips__dot"></span>'
	   html += '<span class="loader-ellips__dot"></span></div>';
	   html += '</div>';
        jQuery('#main_product_list').after(html);
}
App.showLoader =  function(){
	jQuery('.ibox').children('.ibox-content').addClass('sk-loading');    
}

App.hideCustomLoader =  function(){
	var current_page = jQuery("#main_product_list").attr('current_page');
	var total_page_count = jQuery("#main_product_list").attr('total_page_count');

	jQuery('#custom_loading_view').remove();
	if((Number(current_page)+2)==total_page_count){
		if(!jQuery('div').hasClass('end_contend_div')){
			var html = "<div id='custom_loading_view' class='end_contend_div'>End of content"
			html += '</div>';
			 jQuery('#main_product_list').after(html);

		}
	}
}
App.hideLoader =  function(){
	jQuery('.ibox').children('.ibox-content').removeClass('sk-loading');

}

App.sendRequest =  function(end_point,params){
//	jQuery.blockUI.defaults = { 
//		fadeOut: 1000
//	};
	
	var ajax_key = end_point;
	if(params.ajaxKey){
		ajax_key = params.ajaxKey;
	};
	
	if(App.ajaxPool[ajax_key]){
		
		App.ajaxPool[ajax_key].abort();
		delete App.ajaxPool[ajax_key];
	};
	
	
	params.beforeSend = params.beforeSend || function() {};
	
	var reference = this;
	
	var data = params.data ? params.data: {}; 
	
//	jQuery("body").block({
//		message: ''
//	});
    if(data.custom_loader){
		App.showCustomLoader();
    }
	else if(!data.hide_loader){
		App.showLoader();
	}
	
	
	App.ajaxPool[ajax_key] = jQuery.ajax({
		type: params.type?params.type:'GET',
		url: SITE_URL+end_point,
		dataType: params.dataType?params.dataType:'json',
		cache: params.cache?params.cache:false,
		data: data,
		beforeSend : params.beforeSend,
		success: function(response){
			
			delete App.ajaxPool[ajax_key];
			if(data.custom_loader){
				App.hideCustomLoader();
			}
			else if(!data.hide_loader){
				App.hideLoader();
			}
			
			if(response!=undefined && response['error_type']!=undefined && response['error_type']=="TOKEN_EXPIRED")
			{ 
				alert(response['message']!=undefined?response['message']:response['message']);
				window.location.href=response['redirect']!=undefined?response['redirect']:SITE_URL+"/logout";
			}	

		//	jQuery("body").unblock();
			if(response!=undefined && response['logout']!=undefined && response['logout']=="Y")
			{
				alert(response['message']!=undefined?response['message']:"Session Logout");
				window.location.href=response['redirect']!=undefined?response['redirect']:SITE_URL;
			}		
		    if(jQuery.isFunction(params.success)){
		    	params.success(response);
		    }
		},
		error: function(jqXHR, exception){
		
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
				msg = 'Time out error.';
			} else if (exception === 'abort') {
				msg = 'Ajax request aborted.';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseJSON.message;
			}
			App.showMessage(msg,'error');
			App.hideCustomLoader();
			App.hideLoader();
		
			delete App.ajaxPool[ajax_key];
			//jQuery("body").unblock();
			
			if(jQuery.isFunction(params.error)){
		    	params.error();
		    }
		}
	});

};

App.previewImage = function (input,targetId) {
	if (input.files && input.files[0]) {
	  var reader = new FileReader();
	  reader.onload = function(e) {
		jQuery('#'+targetId).show();
		jQuery('#'+targetId).attr('src', e.target.result);
	  }
	  reader.readAsDataURL(input.files[0]);
	}
  }

App.validFileType = function(file,type=null,message = "Not an image"){
	file.on('change', function (e) {
		var reader = new FileReader();
	 
		

		reader.onload = function() {
			var data = reader.result;
			if (data.match(type === null?/^data:image\//:type)) {
			
			} else {
				App.showMessage(message);
			}
		};
	
		reader.readAsDataURL(file.prop('files')[0]);
	});
}  

App.showMessage = function(message,status){
	toastr.clear();
	toastr.options = {
			  "closeButton": false,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": 0,
			  "hideDuration": 0,
			  "timeOut": 10000,
			  "extendedTimeOut": 0,
			  "showEasing": "swing",
//			  "hideEasing": "",
//			  "showMethod": "",
//			  "hideMethod": ""
			}
	
	if(status == "warning")
		{
	       toastr.warning(message);
		}
	else if(status == "success")
		{
		toastr.success(message);
		}
	else{
		toastr.error(message);
	}
};


App.postToUrl = function(path, params, method,target) {
    method = method || "post"; // Set method to post by default if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", SITE_URL+path);
    if(target!=undefined)
    {
    	form.setAttribute("target", target);
    }

    for(var key in params) {
        if(params.hasOwnProperty(key)) 
         {
        	if(typeof params[key]=="string") 
            {
        		var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]); 
		        form.appendChild(hiddenField);  
            }
        	else
        	{
        		for(var innerkey in params[key])
	        	{
        			if(typeof params[key][innerkey]=="string") 
                    {
		        		var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key+"["+innerkey+"]");
			            hiddenField.setAttribute("value", params[key][innerkey]);
				        form.appendChild(hiddenField);
                    }
        			else
        			{
        				for(var subinnerkey in params[key][innerkey])
        	        	{	
    		        		var hiddenField = document.createElement("input");
    			            hiddenField.setAttribute("type", "hidden");
    			            hiddenField.setAttribute("name", key+"["+innerkey+"]["+subinnerkey+"]");
    			            hiddenField.setAttribute("value", params[key][innerkey][subinnerkey]);
    				        form.appendChild(hiddenField);
        	        	}
        			}
	        	}
        	}
         }
    }

    document.body.appendChild(form);
    form.submit();
};


App.blockElement = function(element){
	
	 jQuery(element).block({ message: null }); 
};

App.unBlockElement = function(element){
	
	 jQuery(element).unblock(); 
};

App.showDataTable = function(element,url,params){
	var columnDefs =[
		{
			'targets' : [-1],
			'orderable'	: false,
			'searchable':false
		}
	];
	if(jQuery('.delete_all').length > 0){
		var columnDefs =[
			{
				'targets' : [-1],
				'orderable'	: false,
				'searchable':false
			},
			{
				'targets': 0,
				'searchable':false,
				'orderable':false,
				'className': 'dt-body-center',
				'render': function (data, type, full, meta){
					var checkboxHtml = element.find('.termsbox').clone();
					var ele = jQuery(checkboxHtml);
					ele.find('input').removeClass('checkbox_type');
					ele.find('input').attr('value',data);
					// ele.find('input').attr('name','checkAll['+data+']');
					ele.find('input').attr('id','checkAll'+data);
					ele.find('label').attr('for','checkAll'+data);
					ele.find('input').addClass('otherCheckBox');
					return jQuery(ele).html();
				}
			 }
		
		];

	} 

	var options = {
		"responsive" : true,
		"LengthMenu" : [25,50,100],
		"PagingType" : "full_numbers",
		"processing" : true,
		"serverSide" : true,
		"ajax" : {
			'url':url,
			'type':params.ajaxType!=undefined?params.ajaxType:'GET',
			'data':params.data!=undefined?params.data:undefined,
			'dataSrc':function(response){
				if(response.logout == 'Y'){
					swal({title:'Session out, login again'},function(){
						window.location.reload();
					});
				}
				else{
					return response.data;
				}
			}
		},
		"fnRowCallback" : function(nRow, aData, iDisplayIndex){
			$("td:first", nRow).html(iDisplayIndex +1);
		   return nRow;
		},
		"drawCallback": function( settings ) {
			//App.show_tooltip();
			if(jQuery('.delete_all').length > 0){
					jQuery(document).on('change','.checkbox_type',function(){
						if(jQuery(this).is(':checked')){
							jQuery('.otherCheckBox').attr('checked','checked');
						}
						else{
							jQuery('.otherCheckBox').removeAttr('checked');

						}
					})

					jQuery(document).on('click','.delete_all',function(e){
						e.preventDefault();
						var total_check=jQuery(".otherCheckBox:checked").length;
						if(total_check == 0){
							swal('Please check atleast one checkbox.');
							return false;
						}
						var arr=[];
						jQuery.each(jQuery(".otherCheckBox:checked"),function(key,value){
							var id=jQuery(value).val();
							arr.push(id);
						});
						var hrefurl=$(location).attr("href");
                        var last_part=hrefurl.substr(hrefurl.lastIndexOf('/') + 1);
						if(arr.length > 0){

							var data = {};
							data.success = function(){
									var _token = jQuery('[name="csrf-token"]').attr('content');
									var url =  "/"+last_part+"/deleteAll";
									var params = {};
									params.type = 'POST';
									params.data = {ids:arr,_token:_token};
									params.success = function(output){
										if (output.status == 'success') {               
											App.alert(output.message,"success");
											table.fnDraw();
										} else {
											App.alert(output.message,"error");
										}
									}
									App.sendRequest(url,params);
							};
							data.text = "You will not be able to recover this file!";
							data.confirmButtonColor = "#3085d6";
							data.fail = function(){
								//App.alert("Cancelled","error");
							};
							App.showConfirm(jQuery(this),event,data);

						
						}
				})
			}
	    },
	    "autoWidth": false,
		"pageLength" : 25,
		'stateSave'  : false,
		'searching'	 : true,
		'order'		 : [],
		'destroy'    : true,
		'columnDefs' :columnDefs,
	};

	jQuery.extend(options,params);
	
	$.fn.dataTable.ext.errMode = 'none';var table = element.dataTable(options);
	jQuery('.dataTables_filter input').unbind();
	jQuery('.dataTables_filter input').bind('keyup', function(e) {
		if(e.keyCode == 13) {
			table.fnFilter(this.value);
		}
	});
	return table;
};

App.showConfirm = function(element,e,data){
	if(e!=undefined)
	e.preventDefault();
	
	var options = {
			title: "Are you sure?",
			text:"",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#ED5262",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: true,
			closeOnCancel: true
	};
	jQuery.extend(options,data);
	
	swal(options, function (isConfirm) {
		if (isConfirm) {
        	if(data && jQuery.isFunction(data.success)){
        		data.success();
        	}else{
        		window.location = element.getAttribute('href');
        	}
        } else {
        	if(data && jQuery.isFunction(data.fail)){
        		data.fail();
        	}else{
        		return false;
        	}
        }
    });
	
};

App.formSubmit = function(form){
	if(jQuery(form).length>0){
		 if(jQuery(form).data('submitted') === true) {
			 return false;
		 }
		 else{          
			 jQuery(form).data('submitted',true);
			 jQuery(form)[0].submit();  
		 }
	}
}

App.roundNumber = function(number, digits = 2){
	return (number).toFixed(digits);
};



App.imageAction = function(url, data){
	var params = {};
	
	params.type = 'POST';
	params.data = data.data;
	params.processData = false;
	params.contentType = false;
	params.dataType = 'json';
	params.enctype = 'multipart/form-data';
	params.cache = false;
	params.success = data.success;
	params.url = SITE_URL+url;
	jQuery.ajax(params);
};