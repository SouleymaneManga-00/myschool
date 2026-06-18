/* ==========================
   MODAL
========================== */

function ouvrirFormulaireCours() {
    document.getElementById("modalCours").style.display = "flex";
}

function fermerModal() {
    document.getElementById("modalCours").style.display = "none";

    document.getElementById("matiere").value = "";
    document.getElementById("salle").value = "";
    document.getElementById("jour").value = "";
    document.getElementById("heure").value = "";
}

/* fermer si clic dehors */
window.onclick = function (event) {
    let modal = document.getElementById("modalCours");
    if (event.target === modal) {
        fermerModal();
    }
};

/* ==========================
   AJOUT COURS
========================== */

function ajouterCoursModal() {

    let heure = document.getElementById("heure").value.trim();
    let jour = document.getElementById("jour").value;
    let matiere = document.getElementById("matiere").value.trim();
    let salle = document.getElementById("salle").value.trim();

    if (!heure || !jour || !matiere || !salle) {
        alert("Veuillez remplir tous les champs !");
        return;
    }

    let table = document.querySelector(".emploi-table tbody");
    let lignes = table.querySelectorAll("tr");

    let ligneTrouvee = null;

    lignes.forEach(ligne => {
        let heureCellule = ligne.cells[0].textContent.trim();
        if (heureCellule === heure) {
            ligneTrouvee = ligne;
        }
    });

    let jours = {
        "Lundi": 1,
        "Mardi": 2,
        "Mercredi": 3,
        "Jeudi": 4,
        "Vendredi": 5,
        "Samedi": 6
    };

    if (!jours[jour]) {
        alert("Jour invalide !");
        return;
    }

    let colonne = jours[jour];

    let contenuCours = `
        <div class="cours">
            <span>${matiere}</span>
            <small>${salle}</small>
            <button class="btn-delete" onclick="supprimerCours(this)">×</button>
        </div>
    `;

    if (ligneTrouvee) {
        ligneTrouvee.cells[colonne].innerHTML = contenuCours;
    } else {

        let nouvelleLigne = document.createElement("tr");

        nouvelleLigne.innerHTML = `
            <td><strong>${heure}</strong></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        `;

        nouvelleLigne.cells[colonne].innerHTML = contenuCours;

        table.appendChild(nouvelleLigne);
    }

    fermerModal();
}

/* ==========================
   SUPPRESSION COURS + LIGNE SI VIDE
========================== */

function supprimerCours(btn) {

    let cell = btn.parentElement;   // div.cours
    let td = cell.parentElement;    // td
    let tr = td.parentElement;      // tr

    // supprimer cours
    cell.remove();

    // vérifier si la ligne est vide
    let resteCours = false;

    for (let i = 1; i < tr.cells.length; i++) {

        let content = tr.cells[i].innerHTML.trim();

        if (content !== "" && content !== "-") {
            resteCours = true;
            break;
        }
    }

    // supprimer ligne si vide
    if (!resteCours) {
        tr.remove();
    }
}