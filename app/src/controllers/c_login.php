<?php

class login {

    public function _read(){
        $omodel = new m_model();
        $date = date('Y-m-d H:i:s');
		extract($_POST);
        $type = isset($type) ? $omodel->link->real_escape_string($type) : '';

        if($type == 'signIn'){
            $email = $omodel->link->real_escape_string($email);
            $password = $omodel->link->real_escape_string($password);

            $omodel->link->begin_transaction();
            try {
                $queryGetUser = "SELECT _id, userName, userLastname, userExtraname, userEmail, userPassword, userAuthAttemps, userLastAuthAttemp, created_at, updated_at FROM users WHERE userEmail = '$email'";
                $row = $omodel->_query($queryGetUser);
                $numRows = $omodel->numRows;

                if($row == 'yes'){
                    throw new Error('An error ocurred while singing in: ' . mysqli_error($omodel->link));
                }else{
                    if($numRows > 0){
                        if(intval($row[0]['userAuthAttemps']) >= 5){
                            $currentTime = new DateTime($date);
                            $lastAttemp = new DateTime($row[0]['userLastAuthAttemp']);
                            $interval = $currentTime->diff($lastAttemp);

                            $minutesDifference = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

                            if($minutesDifference < 15){
                                throw new Error("The number of attempts has been reached, please wait ".(15 - $minutesDifference)." minutes and try again");
                            }else{
                                $queryUpdateAttemps = "UPDATE users SET userAuthAttemps  = 0, userLastAuthAttemp = NULL, updated_at = '$date' WHERE _id = '".$row[0]['_id']."'";
                                $errorUpdateAttemps = $omodel->_insert($queryUpdateAttemps);

                                if($errorUpdateAttemps == 'yes'){
                                    throw new Error('An error ocurred while singing in: ' . mysqli_error($omodel->link));
                                }
                            }
                        }

                        if(password_verify($password, $row[0]['userPassword'])){
                            $queryUpdateSuccessAttemp = "UPDATE users SET userAuthAttemps  = 0, userLastAuthAttemp = NULL, updated_at = '$date' WHERE _id = '".$row[0]['_id']."'";
                            $errorUpdateSuccessAttemp = $omodel->_insert($queryUpdateSuccessAttemp);

                            if($errorUpdateSuccessAttemp == 'yes'){
                                throw new Error('An error ocurred while singing in: ' . mysqli_error($omodel->link));
                            }else{
                                $_SESSION['logged_user'] = $row[0];
                                $_SESSION['preloaded_view'] = 'dashboard';
                                $_SESSION['organizations'] = array();
                                $omodel->link->commit();
                                http_response_code(200);
                                echo json_encode(array(
                                    'success' => true,
                                    'message' => 'Authentication completed successfully',
                                    'data' => $row[0]['_id']
                                ));
                            }
                        }else{
                            $queryUpdateFailedAttemp = "UPDATE users SET userAuthAttemps = userAuthAttemps + 1, userLastAuthAttemp = '$date', updated_at = '$date' WHERE _id = '".$row[0]['_id']."'";
                            $errorUpdateFailedAttemp = $omodel->_insert($queryUpdateFailedAttemp);

                            if($errorUpdateFailedAttemp == 'yes'){
                                throw new Error('An error ocurred while singing in: ' . mysqli_error($omodel->link));
                            }else{
                                $omodel->link->commit();
                                http_response_code(500);
                                echo json_encode(array(
                                    'success' => false,
                                    'message' => 'An error occurred while singed up',
                                    'error' => 'Credentials are not correct'
                                ));
                            }
                        }
                    }else{
                        throw new Error('The user does not exist in the system, check the credentials and try again');
                    }
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