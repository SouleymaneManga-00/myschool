document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       MODAL AJOUT
    ========================== */

    const btnAddClasse = document.getElementById("btnAddClasse");
    const addModal = document.getElementById("classeModal");
    const closeModal = document.querySelector(".close-modal");
    const btnCancel = document.getElementById("btnCancel");

    if(btnAddClasse){

        btnAddClasse.addEventListener("click", () => {

            addModal.classList.add("show");

        });

    }

    if(closeModal){

        closeModal.addEventListener("click", () => {

            addModal.classList.remove("show");

        });

    }

    if(btnCancel){

        btnCancel.addEventListener("click", () => {

            addModal.classList.remove("show");

        });

    }

    /* ==========================
       MODAL MODIFIER
    ========================== */

    const editModal =
        document.getElementById("editModal");

    const editButtons =
        document.querySelectorAll(".btn-edit");

    editButtons.forEach(btn => {

        btn.addEventListener("click", function(e){

            e.preventDefault();

            document.getElementById("edit-id").value =
                this.dataset.id;

            document.getElementById("edit-nom").value =
                this.dataset.nom;

            editModal.classList.add("show");

        });

    });

    /* ==========================
       MODAL SUPPRIMER
    ========================== */

    const deleteModal =
        document.getElementById("deleteModal");

    const deleteButtons =
        document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(btn => {

        btn.addEventListener("click", function(e){

            e.preventDefault();

            document.getElementById("delete-id").value =
                this.dataset.id;

            deleteModal.classList.add("show");

        });

    });

    /* ==========================
       FERMER TOUS LES MODALS
    ========================== */

    document
        .querySelectorAll(".close-btn")
        .forEach(btn => {

            btn.addEventListener("click", () => {

                btn.closest(".modal")
                   .classList.remove("show");

            });

        });

    document
        .querySelectorAll(".btn-cancel")
        .forEach(btn => {

            btn.addEventListener("click", () => {

                btn.closest(".modal")
                   .classList.remove("show");

            });

        });

    /* ==========================
       CLIC EN DEHORS
    ========================== */

    window.addEventListener("click", (e) => {

        document
            .querySelectorAll(".modal")
            .forEach(modal => {

                if(e.target === modal){

                    modal.classList.remove("show");

                }

            });

    });

});