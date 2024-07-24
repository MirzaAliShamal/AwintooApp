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
        $data['logoIcon'] = [
            'path'      => 'assets/images/logoIcon',
        ];
        $data['favIcon'] = [
            'size'      => '128x128',
        ];
        $data['documentPath'] = [
            'path'      => 'assets/document_files',
        ];
        $data['restInfoPhoto'] = [
            'path'      => 'assets/images/restInfoPhoto',
            'size'      => '400x400',
        ];
        $data['adminProfilePic'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];
        return $data;
	}

}
