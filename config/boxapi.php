<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Box Developer IDs
    |--------------------------------------------------------------------------
    |
    | Set these value based on this documentation
    | https://box-content.readme.io/docs/box-platform
    |
    */

    'au_client_id'     	=> '7r5xnth7d6ywr3jbtjvxqu105wmo4hic',
    'au_client_secret' 	=> 'x2JIgu6FUnIb4trIjgAkTGco4dAywfU2',
    'su_client_id'         => '',
    'su_client_secret'     => '',
    'redirect_uri'  	=> '',

    /*
    |--------------------------------------------------------------------------
    | Get Enterprise IDs
    |--------------------------------------------------------------------------
    |
    | Login into box.com and go to admin console menu on top left.
    | Click gear icon on top right, click Enterprise or Business Setting.
    | See the enterprise id on the screen
    |
    */

    'enterprise_id' 	=> '83165',

    /*
    |--------------------------------------------------------------------------
    | Set Username or User Id
    |--------------------------------------------------------------------------
    |
    | Set user name to use as App User in Enterprise. Usually need single user.
    | Set user id if you know exactly the user id of Enterprise user
    | to use this API.
    |
    */

    'app_user_name'     => 'Box Administration',
    'app_user_id'       => '196637832',

    /*
    |--------------------------------------------------------------------------
    | Expiration Time for Access Token
    |--------------------------------------------------------------------------
    |
    | Set expiration time in second after request token. Max 60 seconds.
    |
    */

    'expiration'    	=> 60,

    /*
    |--------------------------------------------------------------------------
    | Expiration Time for Access Token
    |--------------------------------------------------------------------------
    |
    | use this in terminal openssl genrsa -aes256 -out private_key.pem 2048
    | follow documentation here https://box-content.readme.io/docs/app-auth
    | copy this file in root folder of Laravel 5 project
    |
    */

    'public_key_id'     => 'i350v6nl',
    'private_key_file'  => base_path() . '/private_key.pem',
    'passphrase'        => '042101a1ca94dfb4e1c3b0b0e3e8da7a',

];
