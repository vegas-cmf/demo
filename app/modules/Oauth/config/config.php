<?php
return array(
    'oauth' =>  array(
        'linkedin'  =>  array(
            'key'   =>  'put your key',
            'secret'    =>  'put your secret key',
            'redirect_uri' => '/oauth/linkedin',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_FULL_PROFILE,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_EMAIL_ADDRESS,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_NETWORK_UPDATES
            )
        ),
        'facebook'  =>  array(
            'key'   =>  'put your key',
            'secret'    =>  'put your secret key',
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
            'key'   =>  'put your key',
            'secret'    =>  'put your secret key',
            'redirect_uri' => '/oauth/google',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Google::SCOPE_EMAIL,
                \Vegas\Security\OAuth\Service\Google::SCOPE_PROFILE
            )
        ),
    )
);