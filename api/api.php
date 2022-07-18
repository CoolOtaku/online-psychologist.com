<?php 
class Api{

    private $res = array();

    public function __construct($arr) {
        if($arr != null){
            $this->res = $arr;
        }
    }

    function add($name, $value){
        $this->res[$name] = $value;
    }

    function returnRes(){
        exit(json_encode($this->res));
    }

}
?>