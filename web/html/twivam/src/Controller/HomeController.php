<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Abraham\TwitterOAuth\TwitterOAuth;

class HomeController extends AppController {
	public function index() {
	}

	public function oauth() {
		// configロード
		Configure::load('tweet');
		$consumer_key = Configure::read('consumer_key');
		$consumer_secret = Configure::read('consumer_secret');

		$connection = new TwitterOAuth($consumer_key, $consumer_secret);

		// コールバックの設定
		$request_token = $connection->oauth('oauth/request_token', [
			'oauth_callback' => 'http:://192.168.33.3:50000/home/view/'
		]);

		// Request_Token, Request_Token_Secretをセッションに保存
		$session = $this->request->session();
		$session->write('oauth_token', $request_token['oauth_token']);
		$session->write('oauth_token_secret', $request_token['oauth_token_secret']);

		// Twitter認証ページへリダイレクト
		$url = $connection->url('oauth/authenticate', [
			'oauth_token' => $request_token['oauth_token']
		]);
		$this->redirect($url);
	}

	public function view() {
		// configロード
		Configure::load('tweet');
		$consumer_key = Configure::read('consumer_key');
		$consumer_secret = Configure::read('consumer_secret');

		// セッションに保存したRequest_Token, Request_Token_Secretを取得
		$session = $this->request->session();
		$request_token = array();
		$request_token['oauth_token'] = $session->read('oauth_token');
		$request_token['oauth_token_secret'] = $session->read('oauth_token_secret');

		// Request_Tokenが正しいかチェック
		if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $this->request->query['oauth_token']) {
			echo 'error!';
			exit;
		}

		// TwitterOAuthを設定
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);

		$access_token = $connection->oauth('oauth/access_token', [
			'oauth_verifier' => $this->request->query['oauth_verifier']
		]);

		$session->write('access_token', $access_token);

		// 使用しないRequest_Token, Request_Token_Secretを削除
		$session->delete('oauth_token');
		$session->delete('oauth_token_secret');

		// TwitterOAuthを設定
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		$user = $connection->get('account/verify_credentials');
		$this->set('user', $user);
	}
}
