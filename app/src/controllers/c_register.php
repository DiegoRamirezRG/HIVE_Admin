<?php

class register {
    public function _create(){
        $omodel = new m_model();
        $date = date('Y-m-d H:i:s');
		extract($_POST);
        $type = isset($type) ? $omodel->link->real_escape_string($type) : '';

        if($type == 'singUp'){
            $name =$omodel->link->real_escape_string($name);
            $lastname =$omodel->link->real_escape_string($lastname);
            $extraname =$omodel->link->real_escape_string($extraname);
            $email =$omodel->link->real_escape_string($email);
            $password =$omodel->link->real_escape_string($password);
            $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            $omodel->link->begin_transaction();
            try {
                $query = "INSERT INTO users SET userName='$name', userLastname='$lastname', userExtraname='$extraname', userEmail='$email', userPassword = '$hash', created_at = '$date'";
                $error = $omodel->_insert($query);

                if($error == 'yes'){
                    throw new Error('An error ocurred while signing up: ' . mysqli_error($omodel->link));
                }else{
                    $omodel->link->commit();
                    http_response_code(200);
                    echo json_encode(array(
                        'success' => true,
                        'message' => 'Registration completed successfully',
                        'data' => ''
                    ));
                }
            } catch (\Throwable $th) {
                $omodel->link->rollback();
                http_response_code(500);
                echo json_encode(array(
                    'success' => false,
                    'message' => 'An error occurred while singed up',
                    'error' => $th->getMessage()
                ));
            }
        }
    }
}

?>