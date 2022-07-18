<?php 
if(isset($_POST)){
	ReturnTests();
}
function ReturnTests(){
    $tests = mysqli_query($_SESSION['db'],"SELECT * FROM `tests`");
    $emparray = array();
    while($row = mysqli_fetch_assoc($tests)){
        $emparray[] = $row;
    }
    $res = json_encode($emparray);
	exit($res);
}
?>