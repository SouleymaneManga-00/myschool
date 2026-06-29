document.addEventListener("DOMContentLoaded", function () {

    /*=========================================
        RECHERCHE
    =========================================*/

    const searchInput = document.getElementById("searchInput");

    if (searchInput) {

        searchInput.addEventListener("keyup", function () {

            const valeur = this.value.toLowerCase();

            document.querySelectorAll("#emploiTable tr")
                .forEach(ligne => {

                    ligne.style.display =
                        ligne.textContent
                            .toLowerCase()
                            .includes(valeur)
                        ? ""
                        : "none";

                });

        });

    }

    /*=========================================
        MODALS
    =========================================*/

    const addModal = document.getElementById("addModal");
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("deleteModal");

    /*=========================================
        OUVRIR AJOUT
    =========================================*/

    const btnOpenAdd = document.getElementById("btnOpenAdd");

    if (btnOpenAdd) {

        btnOpenAdd.addEventListener("click", function () {

            addModal.classList.add("active");

        });

    }

    /*=========================================
        MODIFIER
    =========================================*/

    document.querySelectorAll(".btn-edit")
        .forEach(btn => {

            btn.addEventListener("click", function () {

                editModal.classList.add("active");

                document.getElementById("edit-id").value =
                    this.dataset.id;

                document.getElementById("edit-jour").value =
                    this.dataset.jour;

                document.getElementById("edit-heure-debut").value =
                    this.dataset.debut;

                document.getElementById("edit-heure-fin").value =
                    this.dataset.fin;

                document.getElementById("edit-classe").value =
                    this.dataset.classe;

                document.getElementById("edit-matiere").value =
                    this.dataset.matiere;

                document.getElementById("edit-enseignant").value =
                    this.dataset.enseignant;

            });

        });

    /*=========================================
        SUPPRIMER
    =========================================*/

    document.querySelectorAll(".btn-delete")
        .forEach(btn => {

            btn.addEventListener("click", function () {

                deleteModal.classList.add("active");

                document.getElementById("delete-id").value =
                    this.dataset.id;

            });

        });

    /*=========================================
        FERMER AVEC X
    =========================================*/

    document.querySelectorAll(".close-btn")
        .forEach(btn => {

            btn.addEventListener("click", function () {

                this.closest(".modal")
                    .classList.remove("active");

            });

        });

    /*=========================================
        ANNULER
    =========================================*/

    document.querySelectorAll(".btn-cancel")
        .forEach(btn => {

            btn.addEventListener("click", function () {

                this.closest(".modal")
                    .classList.remove("active");

            });

        });

    /*=========================================
        CLIC EXTERIEUR
    =========================================*/

    window.addEventListener("click", function (e) {

        if (e.target === addModal) {

            addModal.classList.remove("active");

        }

        if (e.target === editModal) {

            editModal.classList.remove("active");

        }

        if (e.target === deleteModal) {

            deleteModal.classList.remove("active");

        }

    });

    /*=========================================
        TOUCHE ECHAP
    =========================================*/

    document.addEventListener("keydown", function (e) {

        if (e.key === "Escape") {

            addModal.classList.remove("active");
            editModal.classList.remove("active");
            deleteModal.classList.remove("active");

        }

    });

});