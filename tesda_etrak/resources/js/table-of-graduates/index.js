document.addEventListener("DOMContentLoaded", function () {
    let bodyRows = document.querySelectorAll(".body-row");
    let form = document.getElementById("deleteForm");

    bodyRows.forEach(function (row) {
        row.addEventListener('dblclick', function () {
            window.location = row.dataset.url;
        });
    });

    document.querySelectorAll(".action-select").forEach(select => {
        select.addEventListener("change", function (event) {
            event.stopPropagation();
            const id = select.dataset.id;
            const value = select.value;
            const option = select.options[select.selectedIndex];

            if (value === "view" || value === "update") {
                window.location = option.dataset.url;
            }

            if (value === "delete") {
               form.action = `/admin/list-of-graduates/record-details/${id}`; 
               document.getElementById("deleteModal").classList.remove('hidden');
            }

            select.value = "";
        });
    });
});

document.getElementById("cancelDelete").addEventListener('click', function () {
    document.getElementById("deleteModal").classList.add("hidden");
});

document.getElementById("cancelDelete_desktop").addEventListener('click', function () {
    document.getElementById("deleteModal").classList.add("hidden");
});

document.getElementById("btnTruncate").addEventListener('click', function () {
    document.getElementById("truncateModal").classList.remove("hidden");
});

document.getElementById("cancelTruncate").addEventListener('click', function () {
    document.getElementById("truncateModal").classList.add("hidden");
});

document.getElementById("cancelTruncate_desktop").addEventListener('click', function () {
    document.getElementById("truncateModal").classList.add("hidden");
});
