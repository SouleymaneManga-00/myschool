document.addEventListener("DOMContentLoaded", () => {

    const studentModal = document.getElementById("studentModal");
    const openStudentBtn = document.getElementById("openModal");
    const closeStudentBtn = document.querySelector(".close-btn");

    if (!studentModal || !openStudentBtn || !closeStudentBtn) {
        console.log("Modal étudiant introuvable");
        return;
    }

    openStudentBtn.addEventListener("click", () => {
        studentModal.classList.add("active");
    });

    closeStudentBtn.addEventListener("click", () => {
        studentModal.classList.remove("active");
    });

    window.addEventListener("click", (e) => {
        if (e.target === studentModal) {
            studentModal.classList.remove("active");
        }
    });

});

const editModal = document.getElementById("editModal");

const editButtons = document.querySelectorAll(".btn-edit");


editButtons.forEach(btn => {

    btn.addEventListener("click", function(e) {

        e.preventDefault();

        document.getElementById("edit-id").value =
            this.dataset.id;

        document.getElementById("edit-prenom").value =
            this.dataset.prenom;

        document.getElementById("edit-nom").value =
            this.dataset.nom;

        document.getElementById("edit-email").value =
            this.dataset.email;

        document.getElementById("edit-classe").value =
            this.dataset.classe;

        editModal.classList.add("active");

    });

});


document.querySelectorAll(".close-btn")
.forEach(btn => {

    btn.addEventListener("click", () => {

        btn.closest(".modal")
           .classList.remove("active");

    });

});

const deleteModal =
    document.getElementById("deleteModal");

const deleteButtons =
    document.querySelectorAll(".btn-delete");

const cancelDelete =
    document.querySelector(".btn-cancel");

deleteButtons.forEach(btn => {

    btn.addEventListener("click", function(e) {

        e.preventDefault();

        document.getElementById("delete-id").value =
            this.dataset.id;

        deleteModal.classList.add("active");

    });

});

if(cancelDelete){

    cancelDelete.addEventListener("click", () => {

        deleteModal.classList.remove("active");

    });

}