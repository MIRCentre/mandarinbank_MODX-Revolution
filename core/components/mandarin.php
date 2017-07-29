<?php
if($_SESSION['shk_lastOrder']['payment'] !== 'mandarin' || !$mid || !$msec || isset($_GET['status']))return;
function print_p($a){echo'<pre>';print_r($a);echo'</pre>';}

$rurl = $rurl ? $rurl : 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//$dbprefix = $modx->getOption(xPDO::OPT_TABLE_PREFIX);

//$result = $modx->query('SELECT * FROM `'.$dbprefix.'shopkeeper3_config` WHERE `setting` = "payments" LIMIT 1');
//$row = $result->fetch(PDO::FETCH_ASSOC);

$payment_price = isset($_SESSION['shk_lastOrder']['price']) ? number_format(floatval($_SESSION['shk_lastOrder']['price']),2,'.','') : '';


function calc_sign($secret, $fields){
	ksort($fields);
	$secret_t = '';
	foreach($fields as $key => $val){
		$secret_t = $secret_t . '-' . $val;
	}
	$secret_t = substr($secret_t, 1) . '-' . $secret;
	return hash("sha256", $secret_t);
}

function generate_form($secret, $fields){
	$sign = calc_sign($secret, $fields);
	$form = "";
	foreach($fields as $key => $val){
		$form = $form . '<input type="hidden" name="'.$key.'" value="' . htmlspecialchars($val) . '"/>'."\n";
	}
	$form = $form . '<input type="hidden" name="sign" value="'.$sign.'"/>';
	return $form;
}
echo '<form action="https://secure.mandarinpay.com/Pay" method="POST">';
echo generate_form($msec,array(
   "email" => $_SESSION['shk_lastOrder']['email'],
   "merchantId" => $mid,
   "orderId" => $_SESSION['shk_lastOrder']['id'],
   "price" => $payment_price,
   'returnUrl'=>$rurl,
   'callbackUrl'=>'http://'.$_SERVER['HTTP_HOST'].'/payment-mandarin.php'
));

echo '<input type="submit" value="Оплатить" /></form>';