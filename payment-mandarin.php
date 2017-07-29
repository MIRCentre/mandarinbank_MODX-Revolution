<?php
$r = $_POST;
if(!isset($r)||!count($r)||empty($r)||!isset($r['orderId'])||!isset($r['status'])||$r['status']!=='success')die();

require_once 'config.core.php';

if(!defined('MODX_CORE_PATH'))die();

include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
include_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';

if(!$database_dsn||!$database_user||!$database_password||!$table_prefix)die();

$modx= new modX();
$modx->initialize('web');
$modx->getService('error','error.modError', '', '');

$xpdo = new xPDO($database_dsn, $database_user, $database_password);
$xpdo->connect();

$secret_table = ' `'.$table_prefix.'site_snippets` ';

$secret = $xpdo->query('SELECT * FROM'.$secret_table.'WHERE `name`="mandarin" ');
$secret = $secret->fetchAll();

$secret = $secret[0]['snippet'];

$secret = explode('$msec=',$secret);
$secret = $secret[1];

$secret = substr($secret,1);
$secret = explode('require_once',$secret);
$secret = $secret[0];
$secret = substr($secret,0,-4);

function check_sign($secret, $req){
	$sign = $req['sign'];
	unset($req['sign']);
	$to_hash = '';
	if(!is_null($req) && is_array($req)) {
		ksort($req);
		$to_hash = implode('-', $req);
	}

	$to_hash = $to_hash .'-'. $secret;
	$calculated_sign = hash('sha256', $to_hash);
	return $calculated_sign == $sign;
}

if(!check_sign($secret,$r))die('Not MandarinPay!');

$results = $xpdo->query('SELECT * FROM `'.$table_prefix.'shopkeeper3_orders` WHERE `id`="'.$r['orderId'].'" ');

if($results->rowCount()<=0)die();

$modx->query('UPDATE `'.$table_prefix.'shopkeeper3_orders` SET `status`=6 WHERE `id`="'.$r['orderId'].'"');

die('OK');