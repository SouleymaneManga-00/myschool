document.addEventListener("DOMContentLoaded", function () {

    const select = document.getElementById("filtreJour");
    const cellules = document.querySelectorAll("td[data-matiere]");

    const matiere = document.body.dataset.matiere || "Algorithmique";

    const elCours = document.getElementById("total-cours");
    const elHeures = document.getElementById("total-heures");

    function update() {

        const filtre = select.value;

        let total = 0;

        cellules.forEach(td => {

            const col = td.cellIndex;
            const text = td.textContent.trim();

            const isMine = text.toLowerCase() === matiere.toLowerCase();

            let show = false;

            if (isMine) {

                if (filtre === "all") {
                    show = true;
                } else {
                    show = (col == filtre);
                }
            }

            td.style.display = show ? "" : "none";

            if (show) total++;
        });

        if (elCours) elCours.textContent = total;
        if (elHeures) elHeures.textContent = (total * 2) + "h";
    }

    select.addEventListener("change", update);

    update();
});