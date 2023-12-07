<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug'       => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security'    => [
        'salt' => env('SECURITY_SALT', '8f2dd499060bbc65d4e98dc577373db0a88316b1804794a196bb957ee03b525a'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => 'mysql',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',

            'username' => 'root',
            'password' => 'FmJkk<Bg=yL8{6Qr',

            'database' => 'calligo',
            /*
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /*
             * You can use a DSN string to set the entire configuration
             */
            'url'      => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test'    => [
            'host'     => 'mysql',
            //'port' => 'non_standard_port_number',
            'username' => 'root',
            'password' => 'FmJkk<Bg=yL8{6Qr',
            'database' => 'test_calligo',
            //'schema' => 'myapp',
            'url'      => env('DATABASE_TEST_URL', null),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    // 'EmailTransport' => [
    //     'default' => [
    //         'host' => 'smtp.kinghost.net',
    //         'port' => 587,
    //         'username' => 'noreply@mainserver.com.br',
    //         'password' => 'm4k4k0l0k0',
    //         'className' => 'Smtp',
    //         'tls' => true,
    //         'client' => null,
    //         'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
    //     ],
    // ],
    // 'Email' => [
    //     'default' => [
    //         'transport' => 'default',
    //         'from' => array('noreply@mainserver.com.br' => 'Noreply'),
    //         'charset' => 'utf-8',
    //         'headerCharset' => 'utf-8',
    //     ],
    // ],

    'Email'          => [
        'default'  =>
            [
                'transport'     => 'default',
                'from'          => array('contato@calligo.com.br' => 'Noreply'),
                'charset'       => 'utf-8',
                'headerCharset' => 'utf-8',
            ],
        'Sendgrid' =>
            [
                'transport' => 'SendgridEmail',
                'from'      => 'contato@calligo.com.br'
            ],
    ],
    'EmailTransport' => [
        'default'       =>
            [
                'host'      => 'smtp.mailtrap.io',
                'port'      => 2525,
                'username'  => '48979996d4d8d55a2',
                'password'  => '5e69fdecb33b2d',
                'className' => 'Smtp',
                'tls'       => true,
                'client'    => null,
                'url'       => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
            ],
        'SendgridEmail' =>
            [
                'className'      => 'SendgridEmail.Sendgrid',
                'api_key'        => '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',
                "click_tracking" => false,
                "open_tracking"  => false,
            ]
    ]
];
