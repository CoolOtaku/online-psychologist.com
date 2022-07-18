<?php 

class Router{

    private $modules = array();

    function addRoute($url, $path){
        $this->modules[$url] = $path;
    }

    function route($url){
        $path = $this->modules[$url];
        if($path == ""){
            exit("Module ".$url." not found!");
        }
        if(file_exists($path)){
            require $path;
        }else{
            exit("Module ".$url." not found!");
        }
    }

}

?>