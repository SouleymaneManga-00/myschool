document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("noteModal");
    const btnAdd = document.getElementById("btnAddNote");
    const closeModal = document.getElementById("closeModal");
    const cancelBtn = document.getElementById("cancelBtn");

    const form = document.getElementById("noteForm");

    const student = document.getElementById("student");
    const subject = document.getElementById("subject");
    const grade = document.getElementById("grade");
    const semester = document.getElementById("semester");

    const tbody = document.querySelector("#notesTable tbody");
    const searchInput = document.getElementById("searchInput");

    let currentRow = null;

    /*=========================
        OUVRIR LE MODAL
    =========================*/

    btnAdd.addEventListener("click", () => {

        form.reset();

        currentRow = null;

        modal.style.display = "flex";

        document.querySelector(".modal-header h3").textContent =
            "Ajouter une note";

    });

    /*=========================
        FERMER LE MODAL
    =========================*/

    function fermerModal() {

        modal.style.display = "none";

        form.reset();

    }

    closeModal.addEventListener("click", fermerModal);

    cancelBtn.addEventListener("click", fermerModal);

    window.addEventListener("click", (e) => {

        if (e.target === modal) {

            fermerModal();

        }

    });

    /*=========================
        AJOUT / MODIFICATION
    =========================*/

    form.addEventListener("submit", (e) => {

        e.preventDefault();

        const nom = student.value.trim();
        const matiere = subject.value.trim();
        const note = grade.value.trim();
        const semestre = semester.value;

        if (
            nom === "" ||
            matiere === "" ||
            note === ""
        ) {

            alert("Veuillez remplir tous les champs.");

            return;

        }

        if (currentRow === null) {

            const tr = document.createElement("tr");

            tr.innerHTML = `

                <td>${nom}</td>

                <td>${matiere}</td>

                <td>${note}/20</td>

                <td>${semestre}</td>

                <td>

                    <button class="edit-btn">

                        <i class="fas fa-edit"></i>

                    </button>

                    <button class="delete-btn">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            `;

            tbody.appendChild(tr);

        } else {

            currentRow.cells[0].textContent = nom;
            currentRow.cells[1].textContent = matiere;
            currentRow.cells[2].textContent = note + "/20";
            currentRow.cells[3].textContent = semestre;

        }

        fermerModal();

    });

    /*=========================
        MODIFIER / SUPPRIMER
    =========================*/

    tbody.addEventListener("click", (e) => {

        const row = e.target.closest("tr");

        if (!row) return;

        /* Modifier */

        if (
            e.target.closest(".edit-btn")
        ) {

            currentRow = row;

            student.value = row.cells[0].textContent;

            subject.value = row.cells[1].textContent;

            grade.value = row.cells[2].textContent.replace("/20", "");

            semester.value = row.cells[3].textContent;

            document.querySelector(".modal-header h3").textContent =
                "Modifier une note";

            modal.style.display = "flex";

        }

        /* Supprimer */

        if (
            e.target.closest(".delete-btn")
        ) {

            const confirmation = confirm(
                "Voulez-vous vraiment supprimer cette note ?"
            );

            if (confirmation) {

                row.remove();

            }

        }

    });

    /*=========================
        RECHERCHE
    =========================*/

    searchInput.addEventListener("keyup", () => {

        const valeur = searchInput.value.toLowerCase();

        const lignes = tbody.querySelectorAll("tr");

        lignes.forEach((ligne) => {

            const texte = ligne.textContent.toLowerCase();

            if (texte.indexOf(valeur) > -1) {

                ligne.style.display = "";

            } else {

                ligne.style.display = "none";

            }

        });

    });

});