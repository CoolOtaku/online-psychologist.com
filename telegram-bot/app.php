<?php
ini_set("display_errors",1);
include 'fireBase/db.php';
include 'botHelper.php';
include 'keyboards.php';

$update = json_decode(file_get_contents('php://input'), true);
//file_put_contents(__DIR__.'/logs.txt', print_r($update, 1), FILE_APPEND);

$user_id = $update['message']['from']['id'] ?? $update['callback_query']['from']['id'];
$chat_id = $update['message']['chat']['id'] ?? $update['callback_query']['message']['chat']['id'];
$text = $update['message']['text'] ?? $update['callback_query']['data'];
$user_name = $update['message']['from']['username'] ?? $update['callback_query']['from']['username'];
if(empty($user_name)){
	$user_name = $update['message']['from']['first_name'] ?? $update['callback_query']['from']['first_name'];
}
$date = $update['message']['date'] ?? $update['callback_query']['message']['date'];
$keyBoard = new KeyBoard();
$_SESSION['ApiKey'] = base64_encode($_SERVER['REMOTE_ADDR']);

switch ($text) {
	case '/start':
		$startKeyboard = $keyBoard->get($text);
	    $res = send('sendMessage',[
	    	'chat_id' => $chat_id,
	        'text' => 'Радий бачити вас 😁!

Виберіть те що вас інтересує:',
	        'reply_markup' => $startKeyboard
	    ]);
		break;
	case '/communicate':
	case 'Хочу спілкуватися з психологом':
		if($db->getReference("communicate")->getValue()){
			$getData = $db->getReference("communicate")->getChildKeys();
			if(in_array($user_id, $getData)){
				send('sendMessage',[
	    			'chat_id' => $chat_id,
	        		'text' => 'Ви вже надавали запит на спілкування!'
	    		]);
				break;
			}
		}
		if($db->getReference("conversation_started")->getValue()){
			$getData = $db->getReference("conversation_started")->getChildKeys();
			if(in_array($user_id, $getData)){
				$communicateKeyboard = $keyBoard->get('/communicate');
				send('sendMessage',[
	    			'chat_id' => $chat_id,
	        		'text' => 'Ви вже почали спілкування!',
	        		'reply_markup' => $communicateKeyboard
	    		]);
				break;
			}
		}
		$data = [
			'chat_id' => $chat_id,
			'username' => $user_name,
			'date' => $date
		];
		$pushData = $db->getReference("communicate/".$user_id)->set($data);
		$getData = $db->getReference("AndroidTokens")->getValue();
		foreach ($getData as $value) {
			$notifi = array(
				'title' => 'Онлайн психолог бот',
				'body' => 'Користувач '.$user_name.', хоче спілкуватися з психологом!'
			);
			sendNotifyAndroid($value,$notifi);
		}
		send('sendMessage',[
	    	'chat_id' => $chat_id,
	        'text' => 'Запит на спілкування надіслано, очікуйте відгуку!'
	    ]);
		break;
	case '/read_book':
	case 'Хочу почитати про психологію':
		sendAPIData("getBooks", $chat_id);
		break;
	case '/videos':
	case 'Відео':
        sendAPIData("getVideos", $chat_id);
		break;
	case '/tests':
	case 'Тести':
		sendAPIData("getTests", $chat_id);
		break;
	case 'Закінчити розмову':
		$getData = $db->getReference("conversation_started/".$user_id)->getValue();
		if($getData){
			$db->getReference("conversation_started/".$user_id)->remove();
			$db->getReference("chats/".$getData['tokenId']."/".$user_id)->remove();
			$getData = $db->getReference("AndroidTokens/".$getData['tokenId'])->getValue();
			if($getData){
				$notifi = array(
					'title' => 'Онлайн психолог бот',
					'body' => 'Користувач '.$user_name.', закінчує з вами спілкування!'
				);
				sendNotifyAndroid($getData,$notifi);
			}
			$defaultKeyboard = $keyBoard->get('default');
			send('sendMessage',[
	    		'chat_id' => $chat_id,
	    		'text' => 'Ви закінчили розмову з психологом!',
	        	'reply_markup' => $defaultKeyboard
	    	]);
		}else{
			$defaultKeyboard = $keyBoard->get('default');
			send('sendMessage',[
	    		'chat_id' => $chat_id,
	    		'text' => 'Ви зараз не спілкуєтися з психологом!',
	        	'reply_markup' => $defaultKeyboard
	    	]);
		}
		break;
	default:
		$data = $db->getReference("conversation_started/".$user_id)->getValue();
		if($data){
			$messagesId = $db->getReference("chats/".$data['tokenId']."/".$user_id)->getValue();
			$isNotSends = true;
			foreach ($messagesId as &$value){
    			if($value['from'] == strval($chat_id)){
					$isNotSends = false;
    			}
			}
			if($isNotSends){
				$communicateKeyboard = $keyBoard->get('/communicate');
				send('sendMessage',[
	    			'chat_id' => $chat_id,
	    			'text' => 'Ви надіслали повідовлення, очікуйте відповіді вашого психолога:',
	        		'reply_markup' => $communicateKeyboard
	    		]);
			}
			$token = $db->getReference("AndroidTokens/".$data['tokenId'])->getValue();
			$pushData = [
				'from' => strval($chat_id),
				'text' => $text,
				'date' => $date
			];
			$db->getReference("chats/".$data['tokenId']."/".$user_id)->push($pushData);
			$notifi = array(
				'title' => 'Онлайн психолог бот',
				'body' => 'Користувач '.$user_name.', надіслав вам повідомлення!'
			);
			sendNotifyAndroid($token,$notifi);
		}else{
			$defaultKeyboard = $keyBoard->get('default');
			send('sendMessage',[
	    		'chat_id' => $chat_id,
	        	'text' => 'Вибачте, я вас не зрозумів 😅',
	        	'reply_markup' => $defaultKeyboard
	    	]);
		}
		break;
}

?>