<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SigninForm
 *
 * @author gabriel
 */
class Forms_SigninForm {

    function __toString() {
        $str = <<<EOD
<form action='auth/signin' id='signin' method='post' accept-charset='UTF-8'>
    <fieldset >
        <legend>Signin</legend>
        
        <label for='username' >UserName*:</label><br />
        <input type='text' name='username' id='username' maxlength="50" /><br />
 
        <label for='password' >Password*:</label><br />
        <input type='password' name='password' id='password' maxlength="50" /><br />
        <input type='submit' name='Submit' value='Submit' /><br />
 
    </fieldset>
</form>

EOD;
        return $str;
    }

}

?>
