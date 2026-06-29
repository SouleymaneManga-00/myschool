document.addEventListener("DOMContentLoaded", () => {

    /* ==========================================
       LES MODALS
    ========================================== */

    const photoModal = document.getElementById("photoModal");
    const infosModal = document.getElementById("infosModal");
    const passwordModal = document.getElementById("passwordModal");

    /* ==========================================
       LES BOUTONS
    ========================================== */

    const btnPhoto = document.getElementById("btnPhoto");
    const btnInfos = document.getElementById("btnInfos");
    const btnPassword = document.getElementById("btnPassword");

    /* ==========================================
       OUVERTURE
    ========================================== */

    btnPhoto?.addEventListener("click", () => {

        photoModal.classList.add("active");

    });

    btnInfos?.addEventListener("click", () => {

        infosModal.classList.add("active");

    });

    btnPassword?.addEventListener("click", () => {

        passwordModal.classList.add("active");

    });

    /* ==========================================
       FERMER UNE MODAL
    ========================================== */

    function closeModal(modal){

        modal.classList.remove("active");

    }

    /* ==========================================
       BOUTON X
    ========================================== */

    document.querySelectorAll(".close-btn")
    .forEach(btn=>{

        btn.addEventListener("click",()=>{

            closeModal(btn.closest(".modal"));

        });

    });

    /* ==========================================
       BOUTON ANNULER
    ========================================== */

    document.querySelectorAll(".btn-cancel")
    .forEach(btn=>{

        btn.addEventListener("click",()=>{

            closeModal(btn.closest(".modal"));

        });

    });

    /* ==========================================
       CLIC EXTERIEUR
    ========================================== */

    document.querySelectorAll(".modal")
    .forEach(modal=>{

        modal.addEventListener("click",(e)=>{

            if(e.target===modal){

                closeModal(modal);

            }

        });

    });

    /* ==========================================
       TOUCHE ECHAP
    ========================================== */

    document.addEventListener("keydown",(e)=>{

        if(e.key==="Escape"){

            document.querySelectorAll(".modal")
            .forEach(modal=>{

                closeModal(modal);

            });

        }

    });

    /* ==========================================
       APERCU PHOTO
    ========================================== */

    const inputPhoto = document.getElementById("photoInput");

    const previewPhoto = document.getElementById("previewPhoto");

    const previewAvatar = document.getElementById("previewAvatar");

    if(inputPhoto){

        inputPhoto.addEventListener("change",function(){

            const fichier = this.files[0];

            if(!fichier){

                return;

            }

            const lecteur = new FileReader();

            lecteur.onload = function(e){

                previewPhoto.src = e.target.result;

                previewPhoto.style.display = "block";

                if(previewAvatar){

                    previewAvatar.style.display = "none";

                }

            }

            lecteur.readAsDataURL(fichier);

        });

    }

});

/* ==========================================
   TOAST
========================================== */

const toast = document.getElementById("toast");

if (toast) {

    setTimeout(() => {

        toast.classList.add("hide");

        setTimeout(() => {

            toast.remove();

        }, 400);

    }, 4000);

}