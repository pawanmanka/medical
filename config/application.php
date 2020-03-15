<?php 
 $experienceArr = array_map(function($value){ return "$value Year"; },array_combine(range(1,100),range(1,100)));
 $starArr = array_map(function($value){ return "$value Star"; },array_combine(range(1,5),range(1,5)));
 $priceArr = array_combine(range(50,1000,50),range(50,1000,50));
 $timeRangeArr = array_combine(range(1,24),range(1,24));
return [
    "siteEmail"=>"admin@admin.com",
    'siteVersion'=>0.3441,
    'genderArr'=>array(
        1=>'Male',
        2=>'Female',
        3=>'Other'
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
    'rez_api_key'=>'rzp_test_xAzxbAGPEoQ0Hd',
    'hospital_doctor_image_path'=>'uploads/hospital_doctor',
    'certificate_image_path'=>'uploads/certificates',
    'user_photos_path'=>'uploads/photos',
    'patient_term_and_condition_url'=>url('terms-and-condition'),
    'doctor_term_and_condition_url'=>url('terms-and-condition'),
    'admin_role'=>'admin',
    'patient_role'=>'patient',
    'hospital_role'=>'hospital',
    'doctor_role'=>'doctor',
    'resent_opt_content'=>'OTP is ',
    'register_sms_content'=>'Welcome to Arogyarth. Your Registration OTP is ',
    'booking_patient_sms_content'=>'Your appointment has been done. Appointment No. is ',
    'cancel_booking_patient_sms_content'=>'Your Appointment has beed cancelled by you. Required charges will be charged from your wallet. ',
    'subadmin_role'=>'subadmin',
    'lab_role'=>'lab',
    'hospital_subadmin_role'=>'hospital subadmin',
    'doctor_subadmin_role'=>'doctor subadmin',
    'lab_subadmin_role'=>'lab subadmin',
    'user_active_status'=>0,
    'minimum_withdrawal_amount'=>100,
    'listing_item_limit'=>20,
    'question_feedback_item_limit'=>20,
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
    'role_slug'=>array(
        'doctors'=>'doctor',
        'hospitals'=>'hospital',
        'labs'=>'lab'
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
    'priceArr'=>array(
        'asc'=>'Low to high',
        'desc'=>'High to low'
    ),
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
        'plans'=>array(
            'add'=>'add',
            'edit'=>'edit',
            'delete'=>'delete'
        ),
        'category'=>array(
            'add'=>'add',
            'edit'=>'edit',
            'delete'=>'delete'
        ),
    ),
    'symbol_content'=>'( Use this | symbol for multiple entries )',
    'map_key'=>'AIzaSyCREIdHZBD5RWhB63e58_CYXcat_-MFraQ',

    ];