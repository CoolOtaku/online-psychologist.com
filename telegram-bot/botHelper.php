<?php 
const TOKEN = '[YOU_TELEGRAM_BOT_TOKEN]';
const BASE_URL = 'https://api.telegram.org/bot'.TOKEN.'/';

function send($method, $params){
	var_dump($params);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
    ));
    curl_setopt($curl, CURLOPT_URL, BASE_URL.$method);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

	$result = curl_exec($curl);
	curl_close($curl);
	return (json_decode($result, 1) ? json_decode($result, 1) : $result);
}

function sendNotifyAndroid($token, $message){
	$url = "https://fcm.googleapis.com/fcm/send";
	$fields = array(
		'to' => $token,
		'notification' => $message
	);
	$headers = array(
		'Authorization:key = AAAA6jXIVJs:APA91bFfWiXUo3Lj5dqwE9N12OUfnp518rMtAOIDO-CdIR12fVDmSIEaK-uQnQYq7qmF1WaSXBdQfxAtgwmVBs5h7kOKO9dIY9pS9NHFS2qw9ubGCKWzckp_QXmJ4JD9UEbNubzUBM2T',
		'Content-Type: application/json'
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	$result = curl_exec($ch);
	if(curl_error($ch)){
		file_put_contents(__DIR__.'/logs.txt', print_r(curl_error($ch), 1), FILE_APPEND);
	}
	curl_close($ch);
	return $result;
}

function sendAPIData($model, $chat_id){
	$response = getAPIData($model);
 	foreach ($response as $value) {
		send('sendMessage',[
	    	'chat_id' => $chat_id,
	    	'text' => $value
		]);
    }
    send('sendMessage',[
	    'chat_id' => $chat_id,
	    'text' => "--- Це є всі матеріали! ---"
	]);
}

function getAPIData($model){
	$query = http_build_query(array("api_key" => "MTkyLjE2OC44OC4x"));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, "https://otaku-development.pp.ua/api/$model");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    return $response;
}

?>
