document.addEventListener("DOMContentLoaded", () => {

    const overlay = document.getElementById('modalOverlay');
    const btnOuvrir = document.getElementById('btnOuvrirModal');
    const btnFermer = document.getElementById('btnFermerModal');
    const btnAnnuler = document.getElementById('btnAnnuler');

    if (!overlay || !btnOuvrir || !btnFermer || !btnAnnuler) {
        return;
    }
    

function ouvrirModal() {
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function fermerModal() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
}

btnOuvrir.addEventListener('click', ouvrirModal);
btnFermer.addEventListener('click', fermerModal);
btnAnnuler.addEventListener('click', fermerModal);

// Clic en dehors du modal pour fermer
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) fermerModal();
});

// Touche Échap
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') fermerModal();
});

// --- Recherche dans le tableau ---
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function () {
    const valeur = this.value.toLowerCase();
    const lignes = document.querySelectorAll('#matieresTable tr');

    lignes.forEach(function (ligne) {
        const nom = ligne.children[1].textContent.toLowerCase();
        ligne.style.display = nom.includes(valeur) ? '' : 'none';
    });
});

});

const editModal = document.getElementById("editModal");

document.querySelectorAll(".btn-edit").forEach(btn => {

    btn.addEventListener("click", function(e){

        e.preventDefault();

        document.getElementById("edit-id").value =
            this.dataset.id;

        document.getElementById("edit-nom").value =
            this.dataset.nom;

        document.getElementById("edit-coeff").value =
            this.dataset.coeff;

        document.getElementById("edit-enseignant").value =
            this.dataset.enseignant;

        editModal.classList.add("active");

    });

});

const deleteModal =
    document.getElementById("deleteModal");

document.querySelectorAll(".open-delete-modal").forEach(btn => {

    btn.addEventListener("click", function(e){

        e.preventDefault();

        document.getElementById("delete-id").value =
            this.dataset.id;

        deleteModal.classList.add("active");

    });

});

document.querySelectorAll(".close-btn").forEach(btn => {

    btn.addEventListener("click", () => {

        btn.closest(".modal")
           .classList.remove("active");

    });

});

document.querySelectorAll(".btn-cancel").forEach(btn => {

    btn.addEventListener("click", () => {

        btn.closest(".modal")
           .classList.remove("active");

    });

});


