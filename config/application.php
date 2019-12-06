<?php 

return [
    "siteEmail"=>"admin@admin.com",
    'siteVersion'=>0.1,
    'genderArr'=>array(
        1=>'Male',
        2=>'Female'
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
    'certificate_image_path'=>'uploads/certificates',
    'admin_role'=>'admin',
    'patient_role'=>'patient',
    'hospital_role'=>'hospital',
    'doctor_role'=>'doctor',
    'lab_role'=>'lab',
    'hospital_subadmin_role'=>'hospital subadmin',
    'doctor_subadmin_role'=>'doctor subadmin',
    'lab_subadmin_role'=>'lab subadmin',
    'user_active_status'=>0,
    'listing_item_limit'=>1,
    'super_categories'=>array(
        1=>'Doctor',
        2=>'Hospital',
        3=>'Test Lab'
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
    'front_end_roles'=>'patient|hospital|doctor|lab',
    'extra_info_roles'=>'hospital|doctor|lab'
];

