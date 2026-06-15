document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalOverlay");
    const openBtn = document.getElementById("showFormBtn");
    const closeBtn = document.getElementById("closeModalBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    function openModal() {
        modal.classList.remove("hidden");
    }

    function closeModal() {
        modal.classList.add("hidden");
    }

    openBtn.addEventListener("click", openModal);
    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    // clic dehors pour fermer
    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });
});