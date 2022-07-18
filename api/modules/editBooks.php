<?php 
$api = new Api(null);
if(isset($_POST)){
    $book = json_decode($_POST['book']);

    $res = mysqli_query($_SESSION['db'],"UPDATE `books` SET `book` = '".$book->book."' WHERE `id` = $book->id");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>