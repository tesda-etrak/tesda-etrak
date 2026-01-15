import '../bootstrap';

var addCompanyModal = document.getElementById("addVacancyModal");

document.getElementById("btnAdd")?.addEventListener("click", function () {
    addCompanyModal.classList.replace("hidden", "block");
});

document.getElementById("btnCancel")?.addEventListener("click", function () {
    addCompanyModal.classList.replace("block", "hidden");
});