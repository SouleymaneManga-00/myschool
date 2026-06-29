document.addEventListener("DOMContentLoaded", function () {

    const filtre = document.getElementById("filtreJour");

    if (!filtre) return;

    const cells = document.querySelectorAll("td[data-jour]");
    const totalCoursEl = document.getElementById("total-cours");
    const totalHeuresEl = document.getElementById("total-heures");

    function update() {

        const value = filtre.value;

        let totalCours = 0;

        cells.forEach(cell => {

            const jour = cell.dataset.jour;
            const contenu = cell.textContent.trim();

            const estCours = contenu !== "-" && contenu !== "";

            let show = false;

            if (value === "all") {
                show = estCours;
            } else {
                show = (jour === value && estCours);
            }

            cell.style.display = show ? "" : "none";

            if (show) {
                totalCours++;
            }
        });

        const heures = totalCours * 2;

        totalCoursEl.textContent = totalCours;
        totalHeuresEl.textContent = heures + "h";
    }

    filtre.addEventListener("change", update);

    update();
});