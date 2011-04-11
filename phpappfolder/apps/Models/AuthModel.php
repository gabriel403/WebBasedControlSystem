<?php

/**
 * Description of RegistrationModel
 *
 * @author gabriel
 */
class Models_AuthModel {

    //put your code here

    public function registerValidation( $name, $email, $username, $password1,
            $password2 ) {
        $error = array();
        
        $name = filter_var($name, FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if( strlen($name) < 6 || strlen($name) > 64 )
            $error['name'] = "Name not of correct length. (min 6 chars)";
        else
            $error['name'] = false;

        $email = filter_var($email, FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if( strlen($email) < 6 || strlen($email) > 64 )
            $error['email'] = "email address not validated or not of the correct length. (min 6 chars)";
        else
            $error['email'] = false;

        $username = filter_var($username, FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if( strlen($email) < 6 || strlen($email) > 64 )
            $error['username'] = "Username not valid or not of correct length. (min 6 chars)";
        else
            $error['username'] = false;

        $password1 = filter_var($password1, FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if( strlen($password1) < 6 || strlen($password1) > 32 )
            $error['password1'] = "Password not of correct length. (min 6 chars)";
        else
            $error['password1'] = false;

        $password2 = filter_var($password2, FILTER_SANITIZE_STRING,
                FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if( strlen($password2) < 6 || strlen($password2) > 32 )
            $error['password2'] = "Password not of correct length. (min 6 chars)";
        else
            $error['password2'] = false;

        if ( count(array_count_values ( $error )) > 0 )
            return $error;
        if( strcasecmp($password1, $password2) )
        {
            $error['password1'] = "Passwords do not match!";
            $error['password2'] = "Passwords do not match!";
        }
        if ( count(array_count_values ( $error )) > 0 )
            return $error;
        return array("success" => "Successfully registered!");
    }

}

?>
