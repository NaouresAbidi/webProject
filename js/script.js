modal = document.getElementById("modal");
btns = document.getElementsByClassName("invoice-btn");
close = document.getElementById("close");

editModal = document.getElementById("editModal");
editBtn = document.getElementById("editBtn");
editClose = document.getElementById("editClose");



for(btn of btns){
    btn.addEventListener("click", function(){
        modal.style.display = "block";
    });
}

editBtn.addEventListener("click", function(){
    editModal.style.display = "block";
});



close.addEventListener("click", function(){
    modal.style.display = "none";
});

editClose.addEventListener("click", function(){
    editModal.style.display = "none";
});




window.addEventListener("click", function(event){
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

window.addEventListener("click", function(event){
    if (event.target == editModal) {
        editModal.style.display = "none";
    }
});



// ------------- Change Profile Picture -------------
profileImgEdit = document.getElementById("profileImgEdit");
profilePic = document.getElementById("profilePic");
submitBtn = document.getElementById("submitBtn");


$("#profileHover").click(function(e) {
    $("#imageUpload").click();
});

function previewProfileImage( uploader ) {   
    //ensure a file was selected 
    if (uploader.files && uploader.files[0]) {
        var imageFile = uploader.files[0];
        var reader = new FileReader();    
        reader.onload = function (e) {
            //set the image data as source
            // $('#profileImgEdit').attr('src', e.target.result);
            profileImgEdit.src = e.target.result;

            submitBtn.addEventListener("click", function(event){
                event.preventDefault();
                
                profilePic.src = e.target.result;
            });
        }
        reader.readAsDataURL( imageFile );
    }
}

$("#imageUpload").change(function(){
    previewProfileImage( this );
});


// ------------- Fill form with user info -------------

// Change Date output form

function showdate(customerDate) {
    var dateHandler = document.getElementById('date-handler');
    dateHandler.innerHTML = customerDate;
    dateHandler.style.display = 'none'

    var months = new Array();
    months = ["January", "February", "March", "April", 
    "May", "June", "July", "August", "September", 
    "October", "November", "December"];
  
    var date = new Date(customerDate);
    var month = months[date.getMonth()];
    //converting the date into array
    var dateArr = customerDate.split("-");
    //setting up the new date form
    var forDate = dateArr[2] + " " + month + " " + dateArr[0];
    userBirthday.innerHTML = forDate;
}


// Fetch user data
userName = document.getElementById("userName");
userSurname = document.getElementById("userSurname");
userAddress = document.getElementById("userAddress");
userBirthday = document.getElementById("userBirthday");
userPhone = document.getElementById("userPhone");

editForm = document.getElementById("editForm");


// Fill the form

editForm.elements['nameEdit'].value = userName.innerHTML;
editForm.elements['surnameEdit'].value = userSurname.innerHTML;
editForm.elements['addressEdit'].value = userAddress.innerHTML;
// editForm.elements['birthEdit'].value = userBirthday.innerHTML;
editForm.elements['phoneEdit'].value = userPhone.innerHTML;
profileImgEdit.src = profilePic.src;


showdate(editForm.elements['birthEdit'].value);


// Change user information button

submitBtn.addEventListener("click", function(){
    userName.innerHTML = editForm.elements['nameEdit'].value;
    userSurname.innerHTML = editForm.elements['surnameEdit'].value;
    userAddress.innerHTML = editForm.elements['addressEdit'].value;
    showdate(editForm.elements['birthEdit'].value);
    userPhone.innerHTML = editForm.elements['phoneEdit'].value;
    
    editModal.style.display = "none";

});

// Cnacel change button

cancelBtn = document.getElementById("cancelBtn");
cancelBtn.addEventListener("click", function(){
    editForm.elements['nameEdit'].value = userName.innerHTML;
    editForm.elements['surnameEdit'].value = userSurname.innerHTML;
    editForm.elements['addressEdit'].value = userAddress.innerHTML;
    // editForm.elements['birthEdit'].value = userBirthday.innerHTML;
    editForm.elements['phoneEdit'].value = userPhone.innerHTML;
    profileImgEdit.src = profilePic.src;

    editModal.style.display = "none";
    
})
