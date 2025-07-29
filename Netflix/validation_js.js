
function validation()
        {
        var password = document.getElementById('password').value;
        var passcheck = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,16}$/;
        if(passcheck.test(password))
        {
            document.getElementById('passworderror').innerHTML=" ";
        }
        else
        {
            document.getElementById('passworderror').innerHTML="** password is invalid";
            return false;
        }
    }    