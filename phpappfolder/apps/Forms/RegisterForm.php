<?php

/**
 * Description of RegisterForm
 *
 * @author gabriel
 */
class Forms_RegisterForm {
    function __toString() {
        $str = <<<EOD
<form id='register' method='post' accept-charset='UTF-8'>
    <fieldset >
        <legend>Register</legend>
        <input type='hidden' name='submitted' id='submitted' value='1'/><br />
        <label for='name' >Your Full Name*: </label><br />
        <input type='text' name='name' id='name' maxlength="50" /><br />
        <label for='email' >Email Address*:</label><br />
        <input type='text' name='email' id='email' maxlength="50" /><br />
 
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
