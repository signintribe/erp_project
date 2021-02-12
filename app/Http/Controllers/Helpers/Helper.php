<?php

namespace App\Helpers;

use DB, Mail, Auth, TCPDF, UserCart;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Mail\VerificationCode;
use \Log;

class Helper
{

	protected $client;
	protected $default_headers;

	public function __construct(){
		$this->client = new Client(['http_errors' => true, 'verify' => false]);
		$this->default_headers = [];
	}

	public static function monthsList($month=null){
		$months = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
		if($month == null){
			return $months;
		} else {
			return $months[$month];
		}
	}

	public static function shortMonthsList($month=null) {
		$months = array(1 => "JAN", 2 => "FEB", 3 => "MAR", 4 => "APR", 5 => "MAY", 6 => "JUN", 7 => "JUL", 8 => "AUG", 9 => "SEP", 10 => "OCT", 11 => "NOV", 12 => "DEC");
		if($month == null){
			return $months;
		} else {
			return $months[$month];
		}
	}//monthShortName

	public function sendSMS($phone, $message)
	{
		$account_sid = env('TWILIO_ACCOUNT_SID');
		$auth_token = env('TWILIO_AUTH_TOKEN');
		$basic = base64_encode("$account_sid:$auth_token");
		$url = env('TWILIO_URL').$account_sid.'/Messages.json';
		$headers = ['Authorization' => "Basic $basic"];

		$form_params = [
			'To' => $phone,
			'From' => env('TWILIO_FROM_PHONE'),
			'Body' => $message
		];

		try{
			$resp = $this->client->request('POST', $url, [
				'headers'=> $headers,
				'form_params' => $form_params
			]);

			// $resp->getStatusCode();
			// return $resp->getBody();
			return true;
		} catch(\Exception $e){
			//dd($e);
			return false;
		}
	}

	public function sendFCM($token, $data)
	{
		$serverKey = env('FCM_SERVER_KEY');
		$url = 'https://fcm.googleapis.com/fcm/send';
		$headers = [
			"Authorization: key=$serverKey",
			'Content-Type: application/json'
		];

		$form_params = [
			'to' => $token,
			'data' => $data
		];

		$postdata = json_encode($form_params);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$respCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );
		curl_close($ch);

		if($respCode == 200) {
			//$resp = json_decode($result);
			Log::info('notification sent: '.$token.' '.json_encode($data));
			return true;
		}
		Log::info('notification failed: '.$token.' '.json_encode($data));

		return false;
	}

	public function sendVerificationCode($mobileNo)
	{	
		$expiry = 15;

		$makingCode = true;
		while ($makingCode) {
			$code = mt_rand(1111, 9999);
			$code_exist = DB::table('verification_codes')
			->where('code', $code)
			->count();

			if($code_exist == 0){
				$makingCode = false;
			}
		}

		$id = DB::table('verification_codes')
		->insertGetId([
			'mobile_no' => $mobileNo,
			'expiry' => date('Y-m-d H:i:s', strtotime("+$expiry minutes")),
			'code' => $code
		]);

		//$result = true;
		$result = $this->sendSMS($mobileNo, "$code.");

		if($result == true)
			return $code;
		else
			return false;
	}

	public static function verifyCode($code)
	{
		$code_exist = DB::table('verification_codes')
		->where('code', $code)
		->where('expiry', '>=', date('Y-m-d H:i:s'))
		->where('status', '=', 'available')
		->count();

		if($code_exist > 0){
			DB::table('verification_codes')
			->where('code', $code)
			->where('expiry', '>=', date('Y-m-d H:i:s'))
			->update(['status'=>'used']);
			return true;
		} else {
			return false;
		}
	}

	private static function crypto_rand_secure($min, $max){
	    $range = $max - $min;
	    if ($range < 1) return $min; // not so random...
	    $log = ceil(log($range, 2));
	    $bytes = (int) ($log / 8) + 1; // length in bytes
	    $bits = (int) $log + 1; // length in bits
	    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
	    do {
	        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
	        $rnd = $rnd & $filter; // discard irrelevant bits
	    } while ($rnd >= $range);
	    return $min + $rnd;
	}

	public static function getToken($str='', $length=5){
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $codeAlphabet.= $str;
	    $max = strlen($codeAlphabet); // edited
	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[self::crypto_rand_secure(0, $max)];
	    }
	    
	    $token = substr(base64_encode($token), 0, $length);
	    // dd($token);
	    return $token;
	}

	public static function easyPrint($html, $options = []) {	
		$style='<style type="text/css">
		th{
			background-color: #ccc;
			text-align: center;
			font-size: 12px;
		}
		td{
			font-size: 12px;
		}
		table{
			width:"100%";
			border-collapse: collapse;
		}
		.center{
			text-align: center;
		}
		.left{
			text-align: left !important;
		}
		.right{
			text-align: right;
		}
		.print{
			font-size: 6px;
		}
		.amount{
			text-align: right;
		}
		.danger{
			background-color: #d73925;
			font-weight: bold;
		}
		.warning{
			background-color: #e08e0b;
			font-weight: bold;
		}

		.green{
		  color: #1ec26b;
		}

		.red{
		  color: red;
		}

		</style>';
		$filename 	= isset($options['filename'])?$options['filename']:"Print.pdf";
		$page_style = isset($options['page_style'])?$options['page_style']:"P";
		$style = isset($options['css']) ? $options['css'] : $style;
		$pageLayout = isset($options['page_size'])?$options['page_size']: 'PDF_PAGE_FORMAT';
		$pdf = new TCPDF($page_style, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// set margins: left, top, right 
		$pdf->SetMargins(20, 20, 20);
		// $pdf->SetMargins(1, 1, 1);
		// set auto page breaks
		// $pdf->SetAutoPageBreak(TRUE, 3);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setHtmlVSpace(
			array(
			    'li' => array(
			        0 => array(
			        	'h' => 1, //margin in mm
			        	'n' => 1
			        ),
			        1 => array(
			        	'h' => 2,
			        	'n' => 2
			        )
			    ) 
			)
		);
		$pdf->setListIndentWidth(10);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}
		$pdf->AddPage();
		//$pdf->SetFont('calibri', '', 10, '', false);
		$pdf->setFontSubsetting(false); 
		// $style .= '<span class="print right">Printed at: '.date('M d, Y h:i:s A').'</span>';
		$pdf->writeHTML($style.$html, true, false, true, false, '');
		//$pdf->writeHTMLCell($w=280, $h=190, '', '', $html=$html, $border=1, $ln=0, $fill=false, $reseth=true, $align='L', $autopadding=true);
		return $pdf->Output($filename, 'I');
	}

	public static function cart(){
		if(Auth::check()){
			$cartId = Auth::user()->id;
		} else if($cartId = Cookie::get('cart-id') != null){
			$cartId = Cookie::get('cart-id');
		} else {
			$cartId = Helper::getToken(now(), 8);
			Cookie::queue('cart-id', $cartId, time()+60*60*24*30);//30 days
		}

		Cart::session($cartId);
	}
}
