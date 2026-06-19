document.addEventListener("DOMContentLoaded", function () {

    const flashMessage = document.getElementById("flash-message");

    if (flashMessage) {

        setTimeout(() => {

            flashMessage.style.opacity = "0";

            setTimeout(() => {

                flashMessage.remove();

            }, 500);

        }, 4000);

    }

});

// const editModal =
//     document.getElementById("editModal");

// const editButtons =
//     document.querySelectorAll(".btn-edit");

// editButtons.forEach(btn => {

//     btn.addEventListener("click", () => {

//         document.getElementById("edit-id").value =
//             btn.dataset.id;

//         document.getElementById("edit-prenom").value =
//             btn.dataset.prenom;

//         document.getElementById("edit-nom").value =
//             btn.dataset.nom;

//         document.getElementById("edit-email").value =
//             btn.dataset.email;

//         document.getElementById("edit-classe").value =
//             btn.dataset.classe;

//         editModal.classList.add("active");

//     });

// });