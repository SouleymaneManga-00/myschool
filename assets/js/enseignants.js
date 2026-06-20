document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("teacher-modal-overlay");
    const openBtn = document.getElementById("showFormBtn");
    const closeBtn = document.getElementById("closeModalBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    if (!modal || !openBtn || !closeBtn || !cancelBtn) {
        return;
    }

    function openModal() {
        modal.classList.remove("hidden");
    }

    function closeModal() {
        modal.classList.add("hidden");
    }

    openBtn.addEventListener("click", openModal);
    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });

});