<?php 
$api = new Api(null);
if(isset($_POST)){
    $email = $_POST['email'];
    $res = mysqli_query($_SESSION['db'],"SELECT * FROM `administrators` WHERE `email` LIKE '$email'");
    $user = mysqli_fetch_assoc($res);
    if(!$user){
        $api->add('res', false);
        $api->returnRes();
    }else{
        $api->add('res', true);
        $api->add('button', "<a href=\"admin\"><img src=\"public/img/wrench_adjustable.svg\"><p class=\"text-primary text-center fw-bold\">Адмін - панель</p></a>");
        $api->returnRes();
    }
}
?>