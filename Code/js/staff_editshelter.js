// City list 
var citybystate = {
    Johor:["Johor Bahru","Nusajaya","Kota Tinggi","Pasir Gudang","Senai","Muar","Kulai","Skudai"],
    Kedah:["Merbok","Changlun","Pendang","Megat Dewa","Bedong","Baling","Bandar Baharu","Alor Setar","Gurun"],
    Kelantan:["Pasir Mas","Pasir Puteh","Bachok","Gua Musang","Tumpat","Kota Bharu"],
    Melaka:["Alor Gajah","Melaka","Merlimau"],
    NegeriSembilan:["Seremban","Nilai","Kuala Pilah","Batu Kikir","Tampin","Kuala Klawang","Bahau","Port Dickson"],
    Pahang:["Kuantan","Bentong","Pekan","Tanah Rata","Mentakab","Temerloh","Kuala Lipis"],
    Penang:["George Town","Butterworth","Batu Ferringhi","Balik Pulau","Bukit Mertajam","Tanjung Bungah"],
    Perak:["Ipoh","Taiping","Kuala Kangsar","Teluk Intan","Batu Gajah","Lumut"],
    Perlis:["Kangar","Kuala Perlis","Arau","Kaki Bukit","Simpang Ampat","Wang Kelian"],
    Sabah:["Kota Kinabalu","Sandakan","Kudat","Papar","Tawau","Kota Belud","Tuaran"],
    Sarawak:["Kuching","Miri","Sibu","Bintulu","Kota Samarahan","Bau"],
    Selangor:["Shah Alam","Klang","Petaling Jaya","Kuala Selangor","Subang Jaya","Cyberjaya","Kajang","Rawang","Semenyih"],
    Terengganu:["Kuala Terengganu","Jerteh","Marang","Kerteh","Paka","Chukai"],
    KualaLumpur:["Ampang","Cheras","Kuala Lumpur","Sentul"],
    Labuan:["Labuan"],
    Putrajaya:["Putrajaya"]
    }
    function getstatevalue(value) {
        if(value.length==0) document.getElementById("newcity").innerHTML = "<option></option>";
        else {
            var city = "<option value=''disabled selected>Please select</option>";
            document.getElementById("newcity").innerHTML = city;
            for(cityvalue in citybystate[value]) {
            city+="<option>"+citybystate[value][cityvalue]+"</option>";}
            document.getElementById("newcity").innerHTML = city;}}
    
    function showthumbnailimg() {
        // Check file size
        var shelterthumbnailsize = thumbnailimg.files.item(0).size;
        var shelterthumbnailfile = Math.round((shelterthumbnailsize / 1024));
        if (shelterthumbnailfile>= 4096) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'The image is too big, Please select image that is less than 4MB',
              })
        } else if (shelterthumbnailfile >=0){
            thumbnailpreview.src = URL.createObjectURL(event.target.files[0]);
        }}
        
    
    
    function showshelterimg() {
        var shelterimg = document.getElementById('shelterimgid1');
        // Check file limit
        if (shelterimg.files.length> 4) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You can only upload 4 images 😢',
            })}
        else if (shelterimg.files.length > 0) {
            for (var i = 0; i <= shelterimg.files.length - 1; i++) {
                var imagesize = shelterimg.files.item(i).size;
                var imagefile = Math.round((imagesize / 1024));
                if (imagefile>= 4096) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'One of the images is too big, Please select image that is less than 4MB',
                    })
                } else if (imagefile >=0){
                    simageimg1.src = URL.createObjectURL(event.target.files[0])
                    simageimg2.src = URL.createObjectURL(event.target.files[1])
                    simageimg3.src = URL.createObjectURL(event.target.files[2])
                    simageimg4.src = URL.createObjectURL(event.target.files[3]);
                } 
            }
        }
    }
    
    
    // Name Validation
    function nameValidation(maxCharacterAmount = 99){
        var userInput_name = document.getElementById("sname").value;
        if (userInput_name.length > maxCharacterAmount){
            document.getElementById("sname").style.borderColor = "red";
        } else if (userInput_name.length <= maxCharacterAmount) {
            document.getElementById("sname").style.borderColor = "black";
        }
    }
    
    // Street Validation
    function streetValidation(maxCharacterAmount = 254){
        var userInput_street = document.getElementById("sstreet").value;
        if (userInput_street.length > maxCharacterAmount){
            document.getElementById("sstreet").style.borderColor = "red";
        } else if (userInput_street.length <= maxCharacterAmount) {
            document.getElementById("sstreet").style.borderColor = "black";
        }
    }
    
    // Postcode Validation
    function postcodeValidation(maxCharacterAmount = 5){
        var userInput1 = document.getElementById("spostcode").value;
        if (userInput1.length > maxCharacterAmount){
            document.getElementById("spostcode").style.borderColor = "red";
        } else if (userInput1.length <= maxCharacterAmount) {
            document.getElementById("spostcode").style.borderColor = "black";
        }
    }
    
    // Description Validation
    function DescriptionValidation(){
        var userInput_Desc = document.getElementById('sdesc').value;
        var new_Desc = userInput_Desc.replace(/[^a-zA-Z0-9,.() ]/g, "");
        document.getElementById('sdesc').value = new_Desc;
    }
    
    // Space Validation
    function spaceValidation(maxCharacterAmount = 4){
        var userInput2 = document.getElementById("sspace").value;
        if (userInput2.length > maxCharacterAmount){
            document.getElementById("sspace").style.borderColor = "red";
        } else if (userInput2.length <= maxCharacterAmount) {
            document.getElementById("sspace").style.borderColor = "black";
        }
    }
    
    // Phone number validation
    function S_contactNoValidation() {
        var userInput_S_contactNo = document.getElementById('shelter_contactnum').value;
        var new_S_contactNo = userInput_S_contactNo.replace(/(?![\d])./g, "");
        document.getElementById('shelter_contactnum').value = new_S_contactNo;
        if ((new_S_contactNo.length > 9) && (new_S_contactNo.length < 14)) {
            document.getElementById("shelter_contactnum").style.borderColor = "black";
        } else {
            document.getElementById("shelter_contactnum").style.borderColor = "red";
        }
        
        var amountof_onFocus = 0;
        if (amountof_onFocus === 0) {
            document.getElementById('shelter_contactnum').onfocus = value = '01';
            amountof_onFocus = 1;
        }
    }
    
    // email validation
    function emailValidation() {
        var userInput_email = document.getElementById("semail").value;
        var new_email = userInput_email.replace(/ /g, "");
        document.getElementById('semail').value = new_email;
        var validateEmail = new_email.search(/(@([a-z]+)\.com)$/g);
        if (validateEmail == -1) {
            document.getElementById("semail").style.borderColor = "red";
        } else {
            document.getElementById("semail").style.borderColor = "black";
        }
    }
