<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */

    'projects' => [
        'app' => [

            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */

            'credentials' => [
                "type" => "service_account",
                "project_id" => "kuli-it-a6633",
                "private_key_id" => "42a923b421dde75fe990645fd2f81dc1cd3ac96f",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDGswCxnwSaMBwG\nehMZzI2yfiLPXvbjjvvzAQTLs2fcIsucbPNHLglUrNKBm0oocEvDE4WX65CQFvQU\n3ZG/+4b6dMSKEes1zYmkTxbJ2PIVCI+BuN+1Lp7SI88sJ+vQIfrbmxJFR/FU8+y1\n2FBvTRGnbKR+y/rugtoZkOZlZm+PTT3JW8r6EaA11j7Sl3m7n/McK2utdogGocF6\n1JqlXzMNIObrvmMmdNpyj3h+ssZFEv26w4saKEPu9lPOhfBTdgui6cr+qgheXuLg\nvB13ml/lEeFrcfvbFIfVHDZZkDZaJ8lzONgloxtjMHiNwXqpD2NgNfwmWsuXpue5\n8XJ/U8ntAgMBAAECggEAS6+Yho/3XVIRAsiSKQQZP1G7qbjXGzP2NYiATqVOXPRm\nEXYQrt7S0A2qe5LuyvuHaE2x1/3zSWds3tvNLk89iX5b9OnBafOaR9uWZxl7kNZ7\nb2K/19Bjz9CzE/M66ENhPjBR49D1FLJ7SoMUlGjLXjZMbD3/ncV7FTzz/dDokrEh\nlZ/XPReP4um/k4WjSCee/rJEKAu9tcorQeYj9+Yr4Mc06XbJPdjytn08e1gffQRW\nQpW2OHp1U07k1HFmlig4GXlsPWEk/sFyUHXQ87nQR3/CbUeRDZ1MRScGVLFYdAeu\nAbmq1M5RkXwuX/YDvo706Cc4beImcp+mX32hMWN+gwKBgQDzQcZpPgyUM5hNTdSw\ngDJHCq9BWyaNwXwt+Md7RCplzsaKJgtmtjUJokBIaK8q+wtqQ4deHKBn1pZfXsoi\nWR4DGB6TFvtK+a2+Jgd0ualqtQaW5274n3xiIxbEFZ2e2BPf4WvDATPX4/Pp7vcc\n3D98Ilj5qikz/2O5tCcC39zNfwKBgQDRG6504uSqxCgwB7b1fqaXQKkMNwElIBTY\nQGPEqKAl32gNAzDqP/oofT6caI93M1OuM4binT1j4OnnPr+VUD8kVMaI5+tsxl8F\nXD2dfegOb/Uz306FjmZN3AhqU2paX9cW+sJLNPGPO2RozGku3L8MsmJWwRnnqFya\nFTwXCk82kwKBgC0WLONGx+gUJA939Ir+R9NZDKCtd1jg2tZefQLA4KbcC3qBkK1p\n6iyt8QI6vPTXcQcyGv37ilOUt2xX0llJcUGbj9ctdEgyPNy4ibs9ykPn55/Cp5PX\nY6OA43BWnU9at1xQmLudFnHWY1ghnZWw0Od+KkWkH1zu4hoCZRSoT3GbAoGBAKr6\numxCtfzXhZC4TiZv16GnMlKViy8jC0hDZhCAXOp6wOaa7F0t0MtYlWBosp4h7tNq\nuGkFbxQC7N6zVQ2u3uJDG08Ia1y22y1T3eGv+JYNf25ZsifMZuRU/OCLslOROBtH\nEKVT9gxK4PA76+lwgBrOpVAQdrEP3h/zKv4f5ONXAoGAXTHB9saRr6oSO/gnP1UQ\nnAzrgnsf4Ls/yhD0Rf5r/nfrFz8nLyz1zg1RztEgO2Gfcih7s1Q4nz5xnZwxtT8v\nEvgHy+H/BLMzTBdVLG7IaBAj1r+ZiJ5MUsGhhMCf7msKU/vCyL1aWiudHazCQ0YS\nAoBhWBAA8pzVY9j7FY3inGE=\n-----END PRIVATE KEY-----\n",
                "client_email" => "firebase-adminsdk-fbsvc@kuli-it-a6633.iam.gserviceaccount.com",
                "client_id" => "110437786140023331078",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40kuli-it-a6633.iam.gserviceaccount.com",
                "universe_domain" => "googleapis.com"
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firestore Component
             * ------------------------------------------------------------------------
             */

            'firestore' => [

                /*
                 * If you want to access a Firestore database other than the default database,
                 * enter its name here.
                 *
                 * By default, the Firestore client will connect to the `(default)` database.
                 *
                 * https://firebase.google.com/docs/firestore/manage-databases
                 */

                // 'database' => env('FIREBASE_FIRESTORE_DATABASE'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [

                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */

                'url' => env('FIREBASE_DATABASE_URL'),

                /*
                 * As a best practice, a service should have access to only the resources it needs.
                 * To get more fine-grained control over the resources a Firebase app instance can access,
                 * use a unique identifier in your Security Rules to represent your service.
                 *
                 * https://firebase.google.com/docs/database/admin/start#authenticate-with-limited-privileges
                 */

                // 'auth_variable_override' => [
                //     'uid' => 'my-service-worker'
                // ],

            ],

            'dynamic_links' => [

                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */

                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [

                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),

            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */

            'http_client_options' => [

                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */

                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 *
                 * The default time out can be reviewed at
                 * https://github.com/kreait/firebase-php/blob/6.x/src/Firebase/Http/HttpClientOptions.php
                 */

                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),

                'guzzle_middlewares' => [],
            ],
        ],
    ],
];
