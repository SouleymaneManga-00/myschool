/* MODAL */
function ouvrirFormulaireCours() {
    document.getElementById("modalCours").style.display = "flex";
}

function fermerModal() {
    document.getElementById("modalCours").style.display = "none";
}

/* AJOUT */
function ajouterCoursModal() {

    let matiere = document.getElementById("matiere").value;
    let classe = document.getElementById("classe").value;
    let salle = document.getElementById("salle").value;
    let jour = document.getElementById("jour").value;
    let heure = document.getElementById("heure").value;

    if (!matiere || !classe || !salle || !jour || !heure) {
        alert("Remplis tous les champs !");
        return;
    }

    let table = document.querySelector(".emploi-table tbody");

    let lignes = table.querySelectorAll("tr");

    let ligneTrouvee = null;

    lignes.forEach(ligne => {
        if (ligne.cells[0].textContent.trim() === heure) {
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

    let col = jours[jour];

    let html = `
        <div class="cours">
            <strong>${matiere}</strong>
            <small>${classe}</small>
            <small>${salle}</small>
            <button class="btn-delete" onclick="supprimerCours(this)">×</button>
        </div>
    `;

    if (ligneTrouvee) {
        ligneTrouvee.cells[col].innerHTML = html;
    } else {
        let newRow = document.createElement("tr");

        newRow.innerHTML = `
            <td><strong>${heure}</strong></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        `;

        newRow.cells[col].innerHTML = html;

        table.appendChild(newRow);
    }

    fermerModal();
}

/* SUPPRESSION */
function supprimerCours(btn) {

    let cell = btn.parentElement;
    let tr = cell.parentElement.parentElement;

    cell.remove();

    let reste = false;

    for (let i = 1; i < tr.cells.length; i++) {
        if (tr.cells[i].innerHTML.trim() !== "-" &&
            tr.cells[i].innerHTML.trim() !== "") {
            reste = true;
            break;
        }
    }

    if (!reste) {
        tr.remove();
    }
}