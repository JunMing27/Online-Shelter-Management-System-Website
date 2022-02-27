// Validate image size and preview image
function showimg() {
    // Check file size
    var idsize = idimg.files.item(0).size;
    var idfile = Math.round((idsize / 1024));
    if (idfile>= 4096) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The image is too big, Please select image that is less than 4MB',
        })
    } else if (idfile >0 && idfile<4096){
        sampleid.src = URL.createObjectURL(event.target.files[0]);
    }}

// Cancel preview image and revert back to default image
    function cancelimg(){   
    document.getElementById('idimg').value = null;
    sampleid.src = 'pictures/sampleid.jpg';
    }

