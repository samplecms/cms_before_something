<?php
 

$c['git'] = [
			    'clientId'                => 'babc7570ab8c4dfb41d1', 
			    'clientSecret'            => '4d6e788b3084ed72cf418b2b2a29c969b6625226',
			    'redirectUri'             => host().url('oauth2/git/index'),
			    'urlAuthorize'            => 'https://github.com/login/oauth/authorize',
			    'urlAccessToken'          => 'https://github.com/login/oauth/access_token',
			    'urlResourceOwnerDetails' => 'https://api.github.com/user'
			];

$c['qq'] = [
			    'clientId'                => '101148582', 
			    'clientSecret'            => 'cbc1fe1d61fc578118c5ed05368b6e2c',
			    'redirectUri'             => host().url('oauth2/qq/index'),
			    'urlAuthorize'            => 'https://graph.qq.com/oauth2.0/authorize',
			    'urlAccessToken'          => 'https://graph.qq.com/oauth2.0/token',
			    'urlResourceOwnerDetails' => 'https://graph.qq.com/oauth2.0/me'
			];


return $c;