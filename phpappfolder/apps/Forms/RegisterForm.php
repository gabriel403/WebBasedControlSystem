<?php

/**
 * Description of RegisterForm
 *
 * @author gabriel
 */
class Forms_RegisterForm {
    function __toString() {
        $str = <<<EOD
<form action='auth/register' id='register' name='register' method='post' accept-charset='UTF-8'>
    <fieldset >
        <legend>Register</legend>
        <label for='name' >Your Full Name*: </label><br />
        <input type='text' name='name' id='name' maxlength="50" /><br />
        <label for='email' >Email Address*:</label><br />
        <input type='text' name='email' id='email' maxlength="50" /><br />
 
        <label for='username' >UserName*:</label><br />
        <input type='text' name='username' id='username' maxlength="50" /><br />
 
        <label for='password1' >Password*:</label><br />
        <input type='password' name='password1' id='password1' maxlength="50" /><br />
        <label for='password2' >Repeat Password*:</label><br />
        <input type='password' name='password2' id='password2' maxlength="50" /><br />
        <input type='submit' name='Submit' value='Submit' /><br />
 
    </fieldset>
</form>

EOD;
        return $str;
    }
}

?>
