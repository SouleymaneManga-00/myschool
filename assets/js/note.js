const searchInput =
document.getElementById("searchInput");

searchInput.addEventListener("keyup", function () {

    const value =
    this.value.toLowerCase();

    const rows =
    document.querySelectorAll("#notesTable tr");

    rows.forEach(row => {

        const matiere =
        row.children[0]
        .textContent
        .toLowerCase();

        row.style.display =
        matiere.includes(value)
        ? ""
        : "none";
    });
});