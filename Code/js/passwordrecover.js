function Nosinglequoteallowed(){
    var userInput_pw = document.getElementById('password').value;
    var userInput_pw2 = document.getElementById('confirmpassword').value;
    if (userInput_pw.includes("'")){
    document.getElementById('password').value = userInput_pw.replace("'", "");
    document.getElementById('pwvalidation').style.display = "inline-block";
    document.getElementById('pwvalidation').style.color = "red";
    }
    else if (userInput_pw2.includes("'")){
    document.getElementById('confirmpassword').value = userInput_pw2.replace("'", "");
    document.getElementById('pwvalidation2').style.display = "inline-block";
    document.getElementById('pwvalidation2').style.color = "red";
    }
    else {
    document.getElementById('pwvalidation').style.display = "none";
    document.getElementById('pwvalidation2').style.display = "none";
    }
}