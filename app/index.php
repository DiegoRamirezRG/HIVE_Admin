<?php

    session_cache_expire(30);
    session_start();

    require_once 'vendor/autoload.php';
    require_once 'src/controllers/c_controller.php';

    use Symfony\Component\Dotenv\Dotenv;
    
    $dotenv = new Dotenv();
    $dotenv->load('.env');

    $controller = new c_controller();

    if(isset($_SESSION['logged_user'])){
        extract($_POST);
        
        if(isset($method)){
            switch($method){
                case 'change':
                    echo $controller->_content($action);
                    break;
                case 'create':
                    $controller->_create($action);
                    break;
                case 'read':
                    $controller->_read($action);
                    break;
                case 'update':
                    $controller->_update($action);
                    break;
                case 'delete':
                    $controller->_delete($action);
                    break;
                case 'details':
                    $controller->_details($action);
                    break;
            }
        }else{
            if(count($_SESSION['organizations']) > 0){
                echo $controller->_layouts();
            }else{
                echo $controller->_content('v_missingOrganization');
            }
        }
    }else{
        extract($_POST);
        if(isset($method)){
            if($method == 'register'){
                $controller->_create($action);
            }else if($method == 'login'){
                $controller->_read($action);
            }
        }else{
            echo $controller->_content('v_login');
        }
    }
?>