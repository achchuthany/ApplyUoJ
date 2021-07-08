<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        // 'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,

    ],
    'programme_type' => [
        'Undergraduate Degree',
        'Postgraduate Degree',
        'Diploma',
        'External Degree'
    ],
    'student_ugc_header' => [
        'application_year',
        'al_index_number',
        'title',
        'name_initials',
        'full_name',
        'al_z_score',
        'district_no',
        'district',
        'race' ,
        'gender',
        'medium',
        'address_no' ,
        'address_street','address_city','address_4' ,
        'mobile','nic','al_english_mark','email','mobile_home','parent_mobile','parent_landline'
    ],
    'enroll_status'=>[
        'in'=>'Invited',
        'dp'=>'Documents Pending',
        'ps'=>'Processing',
        'ap'=>'Accepted',
        'rg'=>'Registered',
        'tr'=>'Transferred',
        'dr'=>'Dropout',
        're'=>'Rejected',
        'de'=>'Deleted',
    ],
    'countries'=>[
        'Afghanistan',
        'Albania',
        'Algeria',
        'American Samoa',
        'Andorra',
        'Angola',
        'Anguilla',
        'Antarctica',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Aruba',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bermuda',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegowina',
        'Botswana',
        'Bouvet Island',
        'Brazil',
        'British Indian Ocean Territory',
        'Brunei Darussalam',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Cape Verde',
        'Cayman Islands',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Christmas Island',
        'Cocos (Keeling) Islands',
        'Colombia',
        'Comoros',
        'Congo',
        'Congo, the Democratic Republic of the',
        'Cook Islands',
        'Costa Rica',
        'Cote d\'Ivoire',
        'Croatia (Hrvatska)',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'East Timor',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Ethiopia',
        'Falkland Islands (Malvinas)',
        'Faroe Islands',
        'Fiji',
        'Finland',
        'France',
        'France Metropolitan',
        'French Guiana',
        'French Polynesia',
        'French Southern Territories',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Gibraltar',
        'Greece',
        'Greenland',
        'Grenada',
        'Guadeloupe',
        'Guam',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Heard and Mc Donald Islands',
        'Holy See (Vatican City State)',
        'Honduras',
        'Hong Kong',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran (Islamic Republic of)',
        'Iraq',
        'Ireland',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Korea, Democratic People\'s Republic of',
        'Korea, Republic of',
        'Kuwait',
        'Kyrgyzstan',
        'Lao, People\'s Democratic Republic',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libyan Arab Jamahiriya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Macau',
        'Macedonia, The Former Yugoslav Republic of',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Martinique',
        'Mauritania',
        'Mauritius',
        'Mayotte',
        'Mexico',
        'Micronesia, Federated States of',
        'Moldova, Republic of',
        'Monaco',
        'Mongolia',
        'Montserrat',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'Netherlands Antilles',
        'New Caledonia',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'Niue',
        'Norfolk Island',
        'Northern Mariana Islands',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Pitcairn',
        'Poland',
        'Portugal',
        'Puerto Rico',
        'Qatar',
        'Reunion',
        'Romania',
        'Russian Federation',
        'Rwanda',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Vincent and the Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia (Slovak Republic)',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Georgia and the South Sandwich Islands',
        'Spain',
        'Sri Lanka',
        'St. Helena',
        'St. Pierre and Miquelon',
        'Sudan',
        'Suriname',
        'Svalbard and Jan Mayen Islands',
        'Swaziland',
        'Sweden',
        'Switzerland',
        'Syrian Arab Republic',
        'Taiwan, Province of China',
        'Tajikistan',
        'Tanzania, United Republic of',
        'Thailand',
        'Togo',
        'Tokelau',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Turks and Caicos Islands',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States',
        'United States Minor Outlying Islands',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Venezuela',
        'Vietnam',
        'Virgin Islands (British)',
        'Virgin Islands (U.S.)',
        'Wallis and Futuna Islands',
        'Western Sahara',
        'Yemen',
        'Yugoslavia',
        'Zambia',
        'Zimbabwe'
    ],
    'al_subjects'=>[
        'Physics'=>'Physics (01)',
        'Chemistry'=>'Chemistry (02)',
        'Mathematics'=>'Mathematics (07)',
        'Agricultural Science'=>'Agricultural Science (08)',
        'Biology'=>'Biology (09)',
        'Combined Mathematics'=>'Combined Mathematics (10)',
        'Higher Mathematics'=>'Higher Mathematics (11)',
        'Common General Test'=>'Common General Test (12)',
        'General English'=>'General English (13)',
        'Civil Technology'=>'Civil Technology (14)',
        'Mechanical Technology'=>'Mechanical Technology (15)',
        'Electrical, Electronic and Information Technology'=>'Electrical, Electronic and Information Technology (16)',
        'Food Technology'=>'Food Technology (17)',
        'Agriculture Technology'=>'Agriculture Technology (18)',
        'Bio Resource Technology'=>'Bio Resource Technology (19)',
        'Information & Communication Technology'=>'Information & Communication Technology (20)',
        'Economics'=>'Economics (21)',
        'Geography'=>'Geography (22)',
        'Political Science'=>'Political Science (23)',
        'Logic and Scientific Method'=>'Logic and Scientific Method (24)',
        'History of Sri Lanka'=>'History of Sri Lanka (25)',
        'History of India'=>'History of India (25A)',
        'History of Europe'=>'History of Europe (25B)',
        'Modern World History'=>'Modern World History (25C)',
        'Home Economics'=>'Home Economics (28)',
        'Communication & Media Studies'=>'Communication & Media Studies (29)',
        'Business Statistics'=>'Business Statistics (31)',
        'Business Studies'=>'Business Studies (32)',
        'Accountancy'=>'Accountancy (33)',
        'Buddhism'=>'Buddhism (41)',
        'Hinduism'=>'Hinduism (42)',
        'Christianity'=>'Christianity (43)',
        'Islam'=>'Islam (44)',
        'Buddhist Civilization'=>'Buddhist Civilization (45)',
        'Hindu Civilization'=>'Hindu Civilization (46)',
        'Islam Civilization'=>'Islam Civilization (47)',
        'Greek and Roman Civilization'=>'Greek and Roman Civilization (48)',
        'Christian Civilization'=>'Christian Civilization (49)',
        'Art (51)'=>'Art (51)',
        'Dancing (Indigenous)'=>'Dancing (Indigenous) (52)',
        'Dancing (Bharatha)'=>'Dancing (Bharatha) (53)',
        'Music (Oriental)'=>'Music (Oriental) (54)',
        'Music (Carnatic)'=>'Music (Carnatic) (55)',
        'Music (Western)'=>'Music (Western) (56)',
        'Drama and Theatre (Sinhala)'=>'Drama and Theatre (Sinhala) (57)',
        'Drama and Theatre (Tamil)'=>'Drama and Theatre (Tamil) (58)',
        'Drama and Theatre (English)'=>'Drama and Theatre (English) (59)',
        'Engineering Technology'=>'Engineering Technology (65)',
        'Biosystems Technology'=>'Biosystems Technology (66)',
        'Science for Technology'=>'Science for Technology (67)',
        'Sinhala'=>'Sinhala (71)',
        'Tamil'=>'Tamil (72)',
        'English'=>'English (73)',
        'Pali'=>'Pali (74)',
        'Sanskrit'=>'Sanskrit (75)',
        'Arabic'=>'Arabic (78)',
        'Malay'=>'Malay (79)',
        'French'=>'French (81)',
        'German'=>'German (82)',
        'Russian'=>'Russian (83)',
        'Hindi'=>'Hindi (84)',
        'Chinese'=>'Chinese (86)',
        'Japanese'=>'Japanese (87)'
    ],
    'grades'=>[
        'A'=>'Distinction Pass',
        'B'=>'Very Good Pass',
        'C'=>'Credit Pass',
        'S'=>'Ordinary Pass',
        'F'=>'Fail'
    ],
    'districts'=>[
        1=>'Colombo',
        2=>'Kandy',
        3=>'Galle',
        4=>'Ampara',
        5=>'Anuradhapura',
        6=>'Badulla',
        7=>'Batticaloa',
        8=>'Gampaha',
        9=>'Hambantota',
        10=>'Jaffna',
        11=>'Kalutara',
        12=>'Kegalle',
        13=>'Kilinochchi',
        14=>'Kurunegala',
        15=>'Mannar',
        16=>'Matale',
        17=>'Matara',
        18=>'Moneragala',
        19=>'Mullativu',
        20=>'Nuwara Eliya',
        21=>'Polonnaruwa',
        22=>'Puttalam',
        23=>'Ratnapura',
        24=>'Trincomalee',
        25=>'Vavuniya'
    ],
    'race'=>[
        'S'=>'Sinhala',
        'T'=>'Tamil',
        'M'=>'Muslim'
    ],
    'gender'=>[
        'M'=>'Male',
        'F'=>'Female'
    ],
    'civil_status'=>[
        'S'=>'Single',
        'M'=>'Married'
    ],
    'religion'=>[
        'B'=>'Buddhist',
        'H'=>'Hindu',
        'C'=>'Christian',
        'I'=>'Islam'
    ],
    'provinces'=>[
        1=>'Central',
        2=>'Eastern',
        3=>'North Central',
        4=>'Northern',
        5=>'North Western',
        6=>'Sabaragamuwa',
        7=>'Southern',
        8=>'Uva',
        9=>'Western'
    ]

];
