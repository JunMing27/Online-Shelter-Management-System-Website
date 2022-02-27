function confirmation(message) {
    if (confirm(message) == true) {
        document.getElementById('deleteConfirmation').style.display = 'inline-block';
        document.getElementById('realDeleteButton').style.display = 'inline-block';
        document.getElementById('fakeDeletebutton').style.display = 'none';
      }
}