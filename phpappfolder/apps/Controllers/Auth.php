<?php

/**
 * Description of Registration
 *
 * @author gabriel
 */
class Controllers_Auth extends Autonomic_Controller {

    public function RegistrationAction() {
        if (strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], "xmlhttprequest") == 0) {
            echo new Forms_RegisterForm();
            exit;
        }
        $this->_getView()->regForm = new Forms_RegisterForm();
    }

    public function RegisterAction() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        echo Models_AuthModel::registerValidation($name, $email, $username, $password1, $password2);
        exit;
    }


    public function SigniningAction() {
        if (strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], "xmlhttprequest") == 0) {
            echo new Forms_SigninForm();
            exit;
        }
        $this->_getView()->regForm = new Forms_SigninForm();
    }
    
    public function signinAction() {
        
    }
    
}

?>
