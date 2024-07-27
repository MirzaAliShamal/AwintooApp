<?php

namespace App\Constants;

class FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This class basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){
        $data['default'] = [
            'path'      => 'assets/images/default.png',
        ];

        // Payment
        $data['proof_of_payment'] = [
            'path'      => 'assets/admin/proof_of_payment',
        ];
        // Client
        $data['clientPhoto'] = [
            'path'      => 'assets/admin/clientDocs/images/clientPhoto',
            'size'      => '354x472',
        ];
        $data['id_front'] = [
            'path'      => 'assets/admin/clientDocs/images/idFront',
            'size'      => '1011 x 638'
        ];
        $data['id_back'] = [
            'path'      => 'assets/admin/clientDocs/images/idBack',
            'size'      => '1011 x 638'
        ];
        $data['license_front'] = [
            'path'      => 'assets/admin/clientDocs/images/licenseFront',
            'size'      => '1011 x 638'
        ];
        $data['license_back'] = [
            'path'      => 'assets/admin/clientDocs/images/licenseBack',
            'size'      => '1011 x 638'
        ];
        $data['job_application_sign'] = [
            'path'      => 'assets/admin/clientDocs/job_application_sign',
        ];
        $data['passport_copy'] = [
            'path'      => 'assets/admin/clientDocs/passport_copy',
            'size'      => '1011 x 638'
        ];
        $data['police_certificate'] = [
            'path'      => 'assets/admin/clientDocs/police_certificate',
            'size'      => '1011 x 638'
        ];
        $data['school_certificate'] = [
            'path'      => 'assets/admin/clientDocs/school_certificate',
            'size'      => '1011 x 638'
        ];
        $data['bank_certificate'] = [
            'path'      => 'assets/admin/clientDocs/bank_certificate',
            'size'      => '1011 x 638'
        ];

        // Rest Information
        $data['five_minutes_work_video'] = [
            'path'      => 'assets/admin/clientDocs/clientRestInfo/five_minutes_work_video',
        ];
        $data['legalized_police_certificate'] = [
            'path'      => 'assets/admin/clientDocs/clientRestInfo/legalized_police_certificate',
            'size'      => '1011 x 638'
        ];
        $data['legalized_school_certificate'] = [
            'path'      => 'assets/admin/clientDocs/clientRestInfo/legalized_school_certificate',
            'size'      => '1011 x 638'
        ];
        $data['legalized_driver_license'] = [
            'path'      => 'assets/admin/clientDocs/clientRestInfo/legalized_driver_license',
            'size'      => '1011 x 638'
        ];

        // Admin Profile Pic 
        $data['adminProfilePic'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];
        return $data;
	}

}
