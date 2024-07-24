<?php

use App\Mail\Email;
use App\Lib\FileManager;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Mail;

function gs() {
    try {
        $general = GeneralSetting::first();
        return $general;
    } catch (\Exception $e) {
        return null;
    }
}

function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1).'9';
    return random_int($min,$max);
}


function sendEmail($subject, $email, $template, $data = []) {
    $general = gs();
    $mailData = [
        'subject' => $subject,
        'site_title' => $general->site_title,
    ];
    $mailData = array_merge($mailData, $data);
    Mail::to($email)->send(new Email($mailData, $template));
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null) {
    $fileManager        = new FileManager($file);
    $fileManager->path  = $location;
    $fileManager->size  = $size;
    $fileManager->old   = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager() {
    return new FileManager();
}

function getFilePath($key) {
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getImage($image, $size = null) {
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    return asset('assets/images/default.png');
}

function menuActive($routeNames, $type = null, $param = null) {
    $class = ($type == 1) ? 'menu-open' : 'active';

    if (!is_array($routeNames)) {
        $routeNames = [$routeNames];
    }

    foreach ($routeNames as $routeName) {
        if (request()->routeIs($routeName)) {
            if ($param) {
                $routeParam = array_values(request()->route()->parameters());
                if (strtolower($routeParam[0]) == strtolower($param)) {
                    return $class;
                } else {
                    continue;
                }
            }
            return $class;
        }
    }
    return '';
}