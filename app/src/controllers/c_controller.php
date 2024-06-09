<?php
date_default_timezone_set('America/Mexico_City');
include 'src/model/m_model.php';

include 'src/controllers/c_register.php';
include 'src/controllers/c_login.php';

class c_controller {
    function _layouts(){
        $omodel = new m_model();
        $date = date('Y-m-d H:i:s');

        $page = file_get_contents('src/views/v_html.php');
        $page = $this->replace($page, 'v_html');

        $page = str_replace('#viewContent#', '', $page);
        return $page;
    }

    function _content($view){
        $page = file_get_contents("src/views/$view.php");
        $page = $this->replace($page, $view);

        return $page;
    }

    function _create($method){
        $object = new $method();
        $object->_create();
    }

    function _read($method){
        $object = new $method();
        $object->_read();
    }

    function _update($method){
        $object = new $method();
        $object->_update();
    }

    function _delete($method){
        $object = new $method();
        $object->_delete();
    }

    function _details($method){
        $object = new $method();
        $object->_details();
    }

    function replace($page, $view){

        return $page;
    }
}
?>