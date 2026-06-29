document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       MODAL AJOUT
    ========================== */

    const addModal =
        document.getElementById("teacher-modal-overlay");

    const openAddBtn =
        document.getElementById("showFormBtn");

    const closeAddBtn =
        document.getElementById("closeModalBtn");

    const cancelAddBtn =
        document.getElementById("cancelBtn");

    if (openAddBtn) {

        openAddBtn.addEventListener("click", () => {

            addModal.classList.remove("hidden");

        });

    }

    if (closeAddBtn) {

        closeAddBtn.addEventListener("click", () => {

            addModal.classList.add("hidden");

        });

    }

    if (cancelAddBtn) {

        cancelAddBtn.addEventListener("click", () => {

            addModal.classList.add("hidden");

        });

    }

    window.addEventListener("click", (e) => {

        if (e.target === addModal) {

            addModal.classList.add("hidden");

        }

    });


    /* ==========================
       MODAL MODIFIER
    ========================== */

    const editModal =
        document.getElementById("editModal");

    const editButtons =
        document.querySelectorAll(".btn-edit");

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

            document.getElementById("edit-specialite").value =
                this.dataset.specialite;

            editModal.classList.add("active");

        });

    });


    /* ==========================
       MODAL SUPPRIMER
    ========================== */

    const deleteModal =
        document.getElementById("deleteModal");

    const deleteButtons =
        document.querySelectorAll(".open-delete-modal");

    deleteButtons.forEach(btn => {

        btn.addEventListener("click", function(e) {

            e.preventDefault();

            document.getElementById("delete-id").value =
                this.dataset.id;

            deleteModal.classList.add("active");

        });

    });


    /* ==========================
       FERMETURE DES MODALS
    ========================== */

    document.querySelectorAll(".close-btn")
    .forEach(btn => {

        btn.addEventListener("click", () => {

            const modal = btn.closest(".modal");

            if (modal) {

                modal.classList.remove("active");

            }

            if (addModal) {

                addModal.classList.add("hidden");

            }

        });

    });


    document.querySelectorAll(".btn-cancel")
    .forEach(btn => {

        btn.addEventListener("click", () => {

            const modal = btn.closest(".modal");

            if (modal) {

                modal.classList.remove("active");

            }

        });

    });

});