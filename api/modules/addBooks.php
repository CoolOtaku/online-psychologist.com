<?php 
$api = new Api(null);
if(isset($_POST)){
    $book = $_POST['book'];

    $res = mysqli_query($_SESSION['db'],"INSERT INTO `books` (`book`) VALUES ('".$book."')");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>