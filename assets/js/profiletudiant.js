document.addEventListener("DOMContentLoaded", () => {

    /* Confirmation déconnexion */

    const logoutBtn = document.getElementById("logoutBtn");

    if (logoutBtn) {

        logoutBtn.addEventListener("click", (e) => {

            const confirmation = confirm(
                "Voulez-vous vraiment vous déconnecter ?"
            );

            if (!confirmation) {

                e.preventDefault();

            }

        });

    }

});