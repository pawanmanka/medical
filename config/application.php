<?php 
 $experienceArr = array_map(function($value){ return "$value Year"; },array_combine(range(1,100),range(1,100)));
 $starArr = array_map(function($value){ return "$value Star"; },array_combine(range(1,5),range(1,5)));
 $priceArr = array_combine(range(50,1000,50),range(50,1000,50));
 $timeRangeArr = array_combine(range(1,24),range(1,24));
return [
    "siteEmail"=>"admin@admin.com",
    'siteVersion'=>0.1,
    'genderArr'=>array(
        1=>'Male',
        2=>'Female'
    ),
    'yesNoArr'=>array(
        0=>'No',
        1=>'Yes'
    ),
    'idProofTypes'=>array(
        1=>'Aadhaar card',
        2=>'Identity Card ',
        3=>'passport'
    ),
    'pageNavigationPlace'=>array(
        1=>'Top',
        2=>'Bottom',
        3=>'Both',
        4=>'None'
    ),
    'valid_image_mimes'=>'jpeg,png,jpg',
    'default_image_path'=>'images/default.png',
    'category_image_path'=>'uploads/category',
    'users_image_path'=>'uploads/users',
    'hospital_doctor_image_path'=>'uploads/hospital_doctor',
    'certificate_image_path'=>'uploads/certificates',
    'admin_role'=>'admin',
    'patient_role'=>'patient',
    'hospital_role'=>'hospital',
    'doctor_role'=>'doctor',
    'subadmin_role'=>'subadmin',
    'lab_role'=>'lab',
    'hospital_subadmin_role'=>'hospital subadmin',
    'doctor_subadmin_role'=>'doctor subadmin',
    'lab_subadmin_role'=>'lab subadmin',
    'user_active_status'=>0,
    'listing_item_limit'=>1,
    'default_percentage'=>0.10,
    'super_categories'=>array(
        1=>'Doctor',
        2=>'Hospital',
        3=>'Test Lab'
    ),
    'super_categories_slug'=>array(
        1=>'doctors',
        2=>'hospitals',
        3=>'labs'
    ),
    'role_wih_category'=>array(
        1=>'doctor',
        2=>'hospital',
        3=>'lab'
    ),
    'timeArr'=>array(
        1=>'morning',
        2=>'evening'
    ),
    'slotArr'=>array(
        1=>'booked',
        2=>'available',
        3=>'not available'
    ),
    'experienceArr'=>$experienceArr,
    'starArr'=>$starArr,
    'priceArr'=>$priceArr,
    'timeRangeArr'=>$timeRangeArr,
    'availabilityArr'=>array(
        1=>'Busy',
        2=>'Availability'
    ),
    'front_end_roles'=>'patient|hospital|doctor|lab',
    'extra_info_roles'=>'hospital|doctor|lab',
    'wallet_add_roles'=>'doctor|patient',
    'rolePermissionArr'=>array(
        'doctor'=>array(
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'patient'=>array(
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'hospital'=>array(
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'lab'=>array(
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'page'=>array(
            'add'=>'add',
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'amenities'=>array(
            'add'=>'add',
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'category'=>array(
            'add'=>'add',
            'edit'=>'edit',
            'delete'=>'delete'
        ),
    )

    ];