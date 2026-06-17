


const btnAddClasse = document.getElementById("btnAddClasse");
const modal = document.getElementById("classeModal");
const closeModal = document.querySelector(".close-modal");
const btnCancel = document.getElementById("btnCancel");

btnAddClasse.addEventListener("click", () => {
    modal.classList.add("show");
});

closeModal.addEventListener("click", () => {
    modal.classList.remove("show");
});

btnCancel.addEventListener("click", () => {
    modal.classList.remove("show");
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.remove("show");
    }
});


