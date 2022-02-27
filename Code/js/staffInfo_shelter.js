function displayinfo(username) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("searchUser").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "staff_searchuser.php?username=" + username, true);
      xmlhttp.send();
  }
