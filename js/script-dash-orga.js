
banner = document.getElementById("eventBanner");
preview = document.getElementById("previewBanner");

banner.onchange = evt => {
    const [file] = banner.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}

// ------- A D D -- M O D A L --------------------------------

newEventBtn = document.getElementById("newEventBtn");
newModal = document.getElementById("newModal");
close = document.getElementById("close");



newEventBtn.addEventListener("click", function(){
    newModal.style.display = "block";
});


close.addEventListener("click", function(){
    newModal.style.display = "none";
});

window.addEventListener("click", function(event){
    if (event.target == newModal) {
        newModal.style.display = "none";
    }
});



// ------- E D I T -- M O D A L --------------------------------


editEventBtns = document.getElementsByClassName("editBtns");
editModal = document.getElementById("editModal");
closeEdit = document.getElementById("closeEdit");


// for(btn of editEventBtns){
//     btn.addEventListener("click", function(){
//         editModal.style.display = "block";
        
//     });
// }


// closeEdit.addEventListener("click", function(){
//     editModal.style.display = "none";
// });

// window.addEventListener("click", function(event){
//     if (event.target == editModal) {
//         editModal.style.display = "none";
//     }
// });


