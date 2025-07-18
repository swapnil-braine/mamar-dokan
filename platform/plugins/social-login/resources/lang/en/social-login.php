<?php

return [
    'settings' => [
        'title' => 'Social Login settings',
        'description' => 'Configure social login options',
        'facebook' => [
            'enable' => 'Enable Facebook login',
            'app_id' => 'App ID',
            'app_secret' => 'App Secret',
            'helper' => 'Please go to https://developers.facebook.com to create new app update App ID, App Secret. Callback URL is :callback',
            'data_deletion_request_callback_url' => 'Set this URL :url as the Data Deletion Request URL in your Facebook app settings to allow users to request deletion of their data.',
        ],
        'google' => [
            'enable' => 'Enable Google login',
            'app_id' => 'App ID',
            'app_secret' => 'App Secret',
            'helper' => 'Please go to https://console.developers.google.com/apis/dashboard to create new app update App ID, App Secret. Callback URL is :callback',
            'use_google_button' => 'Use Google button',
            'use_google_button_helper' => 'If you enable this option, the Google button will be used instead of the default button.',
        ],
        'github' => [
            'enable' => 'Enable GitHub login',
            'app_id' => 'App ID',
            'app_secret' => 'App Secret',
            'helper' => 'Please go to https://github.com/settings/developers to create new app update App ID, App Secret. Callback URL is :callback',
        ],
        'linkedin' => [
            'enable' => 'Enable Linkedin login',
            'app_id' => 'App ID',
            'app_secret' => 'App Secret',
            'helper' => 'Please go to https://www.linkedin.com/developers/apps/new to create new app update App ID, App Secret. Callback URL is :callback',
        ],
        'linkedin-openid' => [
            'enable' => 'Enable Linkedin using OpenID Connect login',
            'app_id' => 'App ID',
            'app_secret' => 'App Secret',
            'helper' => 'Please go to https://www.linkedin.com/developers/apps/new to create new app update App ID, App Secret. Callback URL is :callback',
        ],
        'x' => [
            'enable' => 'Enable X (Twitter) login',
            'app_id' => 'Client ID',
            'app_secret' => 'Client Secret',
            'helper' => 'Please go to https://developer.x.com/en/portal/dashboard to create new app update Client ID, Client Secret. Callback URL is :callback',
        ],
        'enable' => 'Enable Social login?',
        'style' => 'Style',
        'minimal' => 'Minimal',
        'default' => 'Default',
        'basic' => 'Basic',
    ],
    'socials' => [
        'facebook' => 'Facebook',
        'google' => 'Google',
        'github' => 'GitHub',
        'linkedin' => 'Linkedin',
        'linkedin-openid' => 'Linkedin OpenID Connect',
        'x' => 'X (Twitter)',
    ],
    'menu' => 'Social Login',
    'description' => 'View and update your social login settings',
    'sign_in_with' => 'Sign in with :provider',
];
