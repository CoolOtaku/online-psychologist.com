<?php
class KeyBoard{
	function get($command){
		$keyboard = null;
		switch ($command) {
			case '/start':
				$keyboard = array(
        			"inline_keyboard" => array(
            			array(
                			array(
                    			"text" => "Хочу спілкуватися з психологом", 
                    			"callback_data" => "/communicate"
                			)
            			),
            			array(
            				array(
                    			"text" => "Хочу почитати про психологію", 
                    			"callback_data" => "/read_book"
                			)
            			),
            			array(
            				array(
                    			"text" => "Відео", 
                    			"callback_data" => "/videos"
                			),
                			array(
                    			"text" => "Тести", 
                    			"callback_data" => "/tests"
                			)
            			)
        			)
    			);
				break;
			case '/communicate':
				$keyboard = array(
					"resize_keyboard" => true, 
        			"keyboard" => array(
            			["Закінчити розмову"]
        			)
    			);
				break;
			case 'default':
				$keyboard = array(
					"resize_keyboard" => true, 
        			"keyboard" => array(
            			["Хочу спілкуватися з психологом"],
            			["Хочу почитати про психологію"],
            			[
            				["text" => "Відео"],
            				["text" => "Тести"]
            			]
        			)
    			);
				break;
			default:
				break;
		}
		return json_encode($keyboard);
	}
}
?>