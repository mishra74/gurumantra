<?php

use Illuminate\Support\Facades\Auth;

/*
 * CKFinder Configuration File (Laravel Integration)
 */

$config = [];

/*============================ General Settings =======================================*/

$config['loadRoutes'] = false;

// 👇 Authentication Fix
// Agar sabko allow karna ho:
$config['authentication'] = function () {
    return true;
};

// Agar sirf logged-in users ko allow karna ho:
// $config['authentication'] = function () {
//     return Auth::check();
// };

/*============================ License Key ============================================*/

$config['licenseName'] = '';
$config['licenseKey']  = '';

/*============================ CKFinder Internal Directory ============================*/

$config['privateDir'] = [
    'backend' => 'laravel_cache',
    'tags'    => 'ckfinder/tags',
    'cache'   => 'ckfinder/cache',
    'thumbs'  => 'ckfinder/cache/thumbs',
    'logs'    => [
        'backend' => 'laravel_logs',
        'path'    => 'ckfinder/logs'
    ]
];

/*============================ Images and Thumbnails ==================================*/

$config['images'] = [
    'maxWidth'  => 1600,
    'maxHeight' => 1200,
    'quality'   => 80,
    'sizes'     => [
        'small'  => ['width' => 480, 'height' => 320, 'quality' => 80],
        'medium' => ['width' => 600, 'height' => 480, 'quality' => 80],
        'large'  => ['width' => 800, 'height' => 600, 'quality' => 80],
    ]
];

/*=================================== Backends ========================================*/

$config['backends']['laravel_cache'] = [
    'name'    => 'laravel_cache',
    'adapter' => 'local',
    'root'    => storage_path('framework/cache')
];

$config['backends']['laravel_logs'] = [
    'name'    => 'laravel_logs',
    'adapter' => 'local',
    'root'    => storage_path('logs')
];

// ✅ Files will be uploaded to public/userfiles
$config['backends']['default'] = [
    'name'         => 'default',
    'adapter'      => 'local',
    'baseUrl'      => config('app.url').'/userfiles/',
    'root'         => public_path('userfiles/'),
    'chmodFiles'   => 0777,
    'chmodFolders' => 0755,
    'filesystemEncoding' => 'UTF-8'
];

/*================================ Resource Types =====================================*/

$config['defaultResourceTypes'] = '';

$config['resourceTypes'][] = [
    'name'              => 'Files',
    'directory'         => 'files',
    'maxSize'           => 0,
    'allowedExtensions' => '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,webp,wma,wmv,xls,xlsx,zip',
    'deniedExtensions'  => '',
    'backend'           => 'default'
];

$config['resourceTypes'][] = [
    'name'              => 'Images',
    'directory'         => 'images',
    'maxSize'           => 0,
    'allowedExtensions' => 'bmp,gif,jpeg,jpg,png,webp',
    'deniedExtensions'  => '',
    'backend'           => 'default'
];

/*================================ Access Control =====================================*/

$config['roleSessionVar'] = 'CKFinder_UserRole';

$config['accessControl'][] = [
    'role'                => '*',
    'resourceType'        => '*',
    'folder'              => '/',

    'FOLDER_VIEW'         => true,
    'FOLDER_CREATE'       => true,
    'FOLDER_RENAME'       => true,
    'FOLDER_DELETE'       => true,

    'FILE_VIEW'           => true,
    'FILE_UPLOAD'         => true,
    'FILE_RENAME'         => true,
    'FILE_DELETE'         => true,

    'IMAGE_RESIZE'        => true,
    'IMAGE_RESIZE_CUSTOM' => true
];

/*================================ Other Settings =====================================*/

$config['overwriteOnUpload'] = false;
$config['checkDoubleExtension'] = true;
$config['disallowUnsafeCharacters'] = false;
$config['secureImageUploads'] = true;
$config['checkSizeAfterScaling'] = true;
$config['htmlExtensions'] = ['html', 'htm', 'xml', 'js'];
$config['hideFolders'] = ['.*', 'CVS', '__thumbs'];
$config['hideFiles'] = ['.*'];
$config['forceAscii'] = false;
$config['xSendfile'] = false;
$config['debug'] = false;

/*================================ Cache settings =====================================*/

$config['cache'] = [
    'imagePreview' => 24 * 3600,
    'thumbnails'   => 24 * 3600 * 365
];

/*============================ Temp Directory settings ================================*/

$config['tempDirectory'] = sys_get_temp_dir();

/*============================ Session Cause Performance Issues =======================*/

$config['sessionWriteClose'] = true;

/*================================= CSRF protection ===================================*/

$config['csrfProtection'] = true;

/*============================== End of Configuration =================================*/

return $config;
