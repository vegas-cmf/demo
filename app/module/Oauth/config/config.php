<?php
return array(
    'oauth' =>  array(
        'linkedin'  =>  array(
            'key'   =>  '77yxzhmmzdj0xg',
            'secret'    =>  'WgSxkb1I8yovu0T1',
            'redirect_uri' => '/oauth/linkedin',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_FULL_PROFILE,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_EMAIL_ADDRESS,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_NETWORK_UPDATES
            )
        ),
        'facebook'  =>  array(
            'key'   =>  '641315079294877',
            'secret'    =>  '149317069d91ad668831b3db8f65457e',
            'redirect_uri' => '/oauth/facebook',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_EMAIL,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PAGES,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PUBLISH_ACTIONS,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PUBLISH_STREAM,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_USER_ABOUT,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_USER_ACTIVITIES
            )
        ),
        'google'  =>  array(
            'key'    =>  '772598645983-djivugpe83m3og9rt87u3bfqooue9n7m.apps.googleusercontent.com',
            'secret'   =>  'krX1s6vsNTXAS-t0_FUIjDi6',
            'redirect_uri' => '/oauth/google',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Google::SCOPE_EMAIL,
                \Vegas\Security\OAuth\Service\Google::SCOPE_PROFILE
            )
        ),
    )
);