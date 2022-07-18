<?php 
if(isset($_POST)){
	ReturnBooks();
}
function ReturnBooks(){
	$books = mysqli_query($_SESSION['db'],"SELECT * FROM `books`");
    $emparray = array();
    while($row = mysqli_fetch_assoc($books)){
        $emparray[] = $row;
    }
    $res = json_encode($emparray);
	exit($res);
}
?>