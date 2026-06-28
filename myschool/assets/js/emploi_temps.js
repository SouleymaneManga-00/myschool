document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       RECHERCHE
    ========================== */

    const searchInput = document.getElementById("edt-search");

    if (searchInput) {

        searchInput.addEventListener("keyup", function () {

            const valeur = this.value.toLowerCase();

            const lignes = document.querySelectorAll(
                ".emploi-table tbody tr"
            );

            lignes.forEach(ligne => {

                const texte = ligne.textContent.toLowerCase();

                ligne.style.display =
                    texte.includes(valeur)
                    ? ""
                    : "none";

            });

        });

    }

});


/* ==========================
   OUVRIR MODAL
========================== */

function ouvrirFormulaireCours() {

    const modal =
        document.getElementById("modalCours");

    if (modal) {
        modal.style.display = "flex";
    }

}


/* ==========================
   FERMER MODAL
========================== */

function fermerModal() {

    const modal =
        document.getElementById("modalCours");

    if (modal) {
        modal.style.display = "none";
    }

    const matiere =
        document.getElementById("matiere");

    const salle =
        document.getElementById("salle");

    const jour =
        document.getElementById("jour");

    const heure =
        document.getElementById("heure");

    if (matiere) matiere.value = "";
    if (salle) salle.value = "";
    if (jour) jour.value = "";
    if (heure) heure.value = "";

}


/* ==========================
   FERMETURE SI CLIC DEHORS
========================== */

window.addEventListener("click", (event) => {

    const modal =
        document.getElementById("modalCours");

    if (
        modal &&
        event.target === modal
    ) {
        fermerModal();
    }

});


/* ==========================
   TOUCHE ECHAP
========================== */

document.addEventListener("keydown", (e) => {

    if (e.key === "Escape") {
        fermerModal();
    }

});


/* ==========================
   AJOUT D'UN COURS
========================== */

function ajouterCoursModal() {

    let heure =
        document.getElementById("heure")
        .value.trim();

    let jour =
        document.getElementById("jour")
        .value;

    let matiere =
        document.getElementById("matiere")
        .value.trim();

    let salle =
        document.getElementById("salle")
        .value.trim();

    if (
        !heure ||
        !jour ||
        !matiere ||
        !salle
    ) {
        alert(
            "Veuillez remplir tous les champs."
        );
        return;
    }

    const table =
        document.querySelector(
            ".emploi-table tbody"
        );

    const lignes =
        table.querySelectorAll("tr");

    let ligneTrouvee = null;

    lignes.forEach(ligne => {

        const heureCellule =
            ligne.cells[0]
            .textContent
            .trim();

        if (
            heureCellule === heure
        ) {
            ligneTrouvee = ligne;
        }

    });

    const jours = {

        "Lundi": 1,
        "Mardi": 2,
        "Mercredi": 3,
        "Jeudi": 4,
        "Vendredi": 5,
        "Samedi": 6

    };

    if (!jours[jour]) {

        alert("Jour invalide");

        return;

    }

    const colonne = jours[jour];

    const contenuCours = `

        <div class="cours">

            <span>${matiere}</span>

            <small>${salle}</small>

            <button
                class="edt-btn-delete"
                onclick="supprimerCours(this)"
            >
                ×
            </button>

        </div>

    `;

    if (ligneTrouvee) {

        ligneTrouvee
        .cells[colonne]
        .innerHTML = contenuCours;

    }

    else {

        const nouvelleLigne =
            document.createElement("tr");

        nouvelleLigne.innerHTML = `

            <td>
                <strong>${heure}</strong>
            </td>

            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>

        `;

        nouvelleLigne
        .cells[colonne]
        .innerHTML = contenuCours;

        table.appendChild(
            nouvelleLigne
        );

    }

    fermerModal();

}


/* ==========================
   SUPPRESSION COURS
========================== */

function supprimerCours(btn) {

    const cours =
        btn.parentElement;

    const td =
        cours.parentElement;

    const tr =
        td.parentElement;

    cours.remove();

    let resteCours = false;

    for (
        let i = 1;
        i < tr.cells.length;
        i++
    ) {

        const contenu =
            tr.cells[i]
            .innerHTML
            .trim();

        if (
            contenu !== "" &&
            contenu !== "-"
        ) {

            resteCours = true;

            break;

        }

    }

    if (!resteCours) {

        tr.remove();

    }

}