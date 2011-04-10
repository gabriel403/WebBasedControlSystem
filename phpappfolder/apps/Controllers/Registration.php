<?php

/**
 * Description of Registration
 *
 * @author gabriel
 */
class Controllers_Registration extends Autonomic_Controller {

    public function IndexAction() {
        if (strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], "xmlhttprequest") == 0) {
            echo new Forms_RegisterForm();
            exit;
        }
        $this->_getView()->regForm = new Forms_RegisterForm();
    }

}

?>
