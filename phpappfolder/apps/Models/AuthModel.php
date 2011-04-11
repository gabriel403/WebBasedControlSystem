<?php
/**
 * Description of RegistrationModel
 *
 * @author gabriel
 */
class Models_AuthModel {
    //put your code here

    public function registerValidation($name, $email, $username, $password1, $password2) {
        $name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if ( strlen($name) < 6 || strlen($name) > 64)
            return "'".$name."'";
//            return "Name not of correct length. (min 6 chars)";
        
        $email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ( strlen($email) < 6 || strlen($email) > 64)
            return "email address not validated or not of the correct length. (min 6 chars)";

        $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if ( strlen($username) < 6 || strlen($username) > 32)
            return "Username not valid or not of correct length. (min 6 chars)";

        $password1 = filter_var($password1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if ( strlen($password1) < 6 || strlen($password1) > 32)
            return "Password not of correct length. (min 6 chars)";

        $password2 = filter_var($password2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if ( strlen($password2) < 6 || strlen($password2) > 32)
            return "Password not of correct length. (min 6 chars)";
        
        if ( strcasecmp($password1, $password2) )
                return "Passwords do not match!";
        
        return "Successfully registered!";
    }
    
}

?>
