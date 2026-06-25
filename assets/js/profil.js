document.addEventListener("DOMContentLoaded", function () {

    const photoInput = document.getElementById("photoInput");
    const profileImage = document.getElementById("profileImage");
    const deletePhoto = document.getElementById("deletePhoto");

    photoInput.addEventListener("change", function () {

        if (this.files[0]) {

            const reader = new FileReader();

            reader.onload = function (e) {

                profileImage.src = e.target.result;

            };

            reader.readAsDataURL(this.files[0]);

        }

    });

    deletePhoto.addEventListener("click", function () {

        profileImage.src = "../../assets/images/avatar.png";
        photoInput.value = "";

    });

});