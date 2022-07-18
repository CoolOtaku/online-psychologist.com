<?php 
if(isset($_POST)){
	ReturnAdministrators();
}
function ReturnAdministrators(){
    $administrators = mysqli_query($_SESSION['db'],"SELECT * FROM `administrators`");
    $emparray = array();
    while($row = mysqli_fetch_assoc($administrators)){
        $emparray[] = $row;
    }
    $res = json_encode($emparray);
	exit($res);
}
?>