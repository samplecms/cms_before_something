<?php
namespace app\modules\oauth2;
use app\models\oauth;
class base{
	public $type;
	public $uid;
	public $is_admin;
	public function insert_user($arr){
		$model = new oauth;
		$one = $model->findOne(['oauth_id'=>$arr['id'],'type'=>$this->type]);
		if(!$one){
			$arr['oauth_id'] = $arr['id'];
			$arr['type'] = $this->type;
			unset($arr['id']);
			if(!$model->findOne([])){
				$arr['is_admin'] = 1;
				$this->is_admin = true;
			}
			$arr['created'] = new \MongoDate();
			$uid =  (string)$model->insert($arr);


		}else{
			unset($arr['id']);
			$model->update(['oauth_id'=>$arr['id'],'type'=>$this->type],$arr);
			$uid = (string)$one['_id'];
			if($one['is_admin']){
				$this->is_admin = true;
			}
		}
		$this->uid = $uid;

	}

	function config($type='git'){
			$this->type = $type;
			
			/*
			[
			    'clientId'                => 'demoapp',    // The client ID assigned to you by the provider
			    'clientSecret'            => 'demopass',   // The client password assigned to you by the provider
			    'redirectUri'             => 'http://example.com/your-redirect-url/',
			    'urlAuthorize'            => 'http://brentertainment.com/oauth2/lockdin/authorize',
			    'urlAccessToken'          => 'http://brentertainment.com/oauth2/lockdin/token',
			    'urlResourceOwnerDetails' => 'http://brentertainment.com/oauth2/lockdin/resource'
			]
			*/
			$provider = new \League\OAuth2\Client\Provider\GenericProvider(config('oauth2.'.$type));

			// If we don't have an authorization code then get one
			if (!isset($_GET['code'])) {

			    // Fetch the authorization URL from the provider; this returns the
			    // urlAuthorize option and generates and applies any necessary parameters
			    // (e.g. state).
			    $authorizationUrl = $provider->getAuthorizationUrl();

			    // Get the state generated for you and store it to the session.
			    $_SESSION['oauth2state'] = $provider->getState();

			    // Redirect the user to the authorization URL.
			    header('Location: ' . $authorizationUrl);
			    exit;

			// Check given state against previously stored one to mitigate CSRF attack
			} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

			    unset($_SESSION['oauth2state']);
			    exit('Invalid state');

			} else {

			    try {

			        // Try to get an access token using the authorization code grant.
			        $accessToken = $provider->getAccessToken('authorization_code', [
			            'code' => $_GET['code']
			        ]);

			       
			        $resourceOwner = $provider->getResourceOwner($accessToken);

			        return  $user = $resourceOwner->toArray();
  

			    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
 
			        exit($e->getMessage());

			    }

			}

	}
}