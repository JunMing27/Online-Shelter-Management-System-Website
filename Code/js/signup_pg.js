// first & last name & emergency contact name validation
function nameValidation(id,  maxCharacterAmount = 50){
    var userInput_name = document.getElementById(id).value;
    if (userInput_name.length > maxCharacterAmount){
        document.getElementById(id).style.borderColor = "red";
    } else if (userInput_name.length <= maxCharacterAmount) {
        document.getElementById(id).style.borderColor = "#ccc";
    }
}

// email validation
function emailValidation() {
    var userInput_email = document.getElementById("login_email").value;
    var new_email = userInput_email.replace(/ /g, "");
    document.getElementById('login_email').value = new_email;
    var validateEmail = new_email.search(/(@([a-z]+)\.com)$/g);
    if (validateEmail == -1) {
        document.getElementById("login_email").style.borderColor = "red";
    } else {
        document.getElementById("login_email").style.borderColor = "#ccc";
    }
}

// password validation
function passwordValidation(id){
    var userInput_password = document.getElementById(id).value;
    if (userInput_password.length < 8){
        document.getElementById(id).style.borderColor = "red";
    } else if (userInput_password.length > 7) {
        document.getElementById(id).style.borderColor = "#ccc";
    }

    if (id = 'oldPw') {
        var userOriginalPw = document.getElementById('oldPwValidation').value;
        if (userInput_password != userOriginalPw){
            document.getElementById(id).style.borderColor = "red";
        } else if (userInput_password == userOriginalPw){
            document.getElementById(id).style.borderColor = "#ccc";
            console.log("same");
        }
    }
}

// confirm password validation
function confirmPasswordValidation(pw,confirmPw = 'confirmPw'){
    var userInput_confirmPassword = document.getElementById(confirmPw).value;
    var userInput_password = document.getElementById(pw).value;
    if (userInput_confirmPassword == userInput_password) {
        document.getElementById(confirmPw).style.borderColor = "#ccc";
    } else if (userInput_confirmPassword != userInput_password) {
        document.getElementById(confirmPw).style.borderColor = "red";
    }
}


// emergency phone number validation
function EM_contactNoValidation(id) {
    var userInput_EM_contactNo = document.getElementById(id).value;
    var new_EM_contactNo = userInput_EM_contactNo.replace(/(?![\d])./g, "");
    document.getElementById(id).value = new_EM_contactNo;
    if ((new_EM_contactNo.length > 9) && (new_EM_contactNo.length < 14)) {
        document.getElementById(id).style.borderColor = "#ccc";
    } else {
        document.getElementById(id).style.borderColor = "red";
    }
}


// invalid message display
function invalidMessage(id) {
    document.getElementById(id).style.display = "inline-block";
    document.getElementById(id).style.color = "red";
}