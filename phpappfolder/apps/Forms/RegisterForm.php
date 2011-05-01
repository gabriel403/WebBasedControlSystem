<?php

/**
 * Description of RegisterForm
 *
 * @author gabriel
 */
class Forms_RegisterForm {
    function __toString() {
        $str = <<<EOD
       <img src="/p07224405/images/help_icon.png" title="The email address should be the one you wish to recieve alerts to.\nThe phonenumber should be the one that is sending the status information to the M2M server and should be in the in the international form '4407893423563'." />
<form action='/p07224405/auth/register' id='register' name='register' method='post' accept-charset='UTF-8'>
    <fieldset >
        <legend>Register</legend>
        <label for='name' >Your Full Name*: </label><br />
        <input type='text' name='name' id='name' maxlength="64" /><br />
        <label for='email' >Email Address*:</label><br />
        <input type='text' name='email' id='email' maxlength="64" /><br />
 
        <label for='username' >UserName*:</label><br />
        <input type='text' name='username' id='username' maxlength="64" /><br />
 
        <label for='username' >PhoneNumber*:</label><br />
        <input type='text' name='phonenumber' id='phonenumber' maxlength="16" /><br />
 
        <label for='password1' >Password*:</label><br />
        <input type='password' name='password1' id='password1' maxlength="32" /><br />
        <label for='password2' >Repeat Password*:</label><br />
        <input type='password' name='password2' id='password2' maxlength="32" /><br />
        <input type='submit' name='Submit' value='Submit' /><br />
 
    </fieldset>
</form>

EOD;
        return $str;
    }
}

?>
