document.getElementById("detailsTab")?.addEventListener('click', function () {
    openTab(0);
});
document.getElementById("verificationTab")?.addEventListener('click', function () {
    openTab(1);
});
document.getElementById("employmentTab")?.addEventListener('click', function () {
    openTab(2);
});

document.getElementById("btnDelete").addEventListener('click', function () {
    document.getElementById("deleteModal").classList.remove('hidden');
});
document.getElementById("cancelDelete").addEventListener('click', function () {
    document.getElementById("deleteModal").classList.add("hidden");
});

document.getElementById("cancelDelete_desktop").addEventListener('click', function () {
    document.getElementById("deleteModal").classList.add("hidden");
});

blankedDefinitions();
dateFormatRead();

function openTab(index) {
    document.querySelectorAll(".tab-content").forEach((tab, i) => {
        tab.classList.toggle("hidden", i !== index);
    });

    document.querySelectorAll("#tabs button").forEach((btn, i) => {
        btn.classList.toggle("bg-neutral-500", i === index);
        btn.classList.toggle("text-white", i === index);
        btn.classList.toggle("bg-transparent", i !== index);
        btn.classList.toggle("hover:bg-neutral-300", i !== index);
        btn.classList.toggle("text-black", i !== index);
    });
}

function blankedDefinitions() {
    const definitions = document.getElementsByTagName("dd");
    let blanks = 0;

    for (let i = 0; i < definitions.length; i++) {
        if (definitions[i].innerHTML === "") {
            definitions[i].innerHTML = "N/A";
            blanks++;
        }
        else 
            continue;
    }

    if (blanks > 0) 
        console.log(`Blanked definitions: ${blanks}`);
}

function dateFormatRead() {
    let dateFormats = document.getElementsByClassName("dateFormat");
    let year = "";
    let month = "";
    let day = "";

    let monthName = "";
    for (let dateFormat of dateFormats) {
        if (dateFormat.textContent == "" || !isValidDateStrict(dateFormat.textContent)) {
            if (dateFormat.textContent.length > 11) {
                let sliced = dateFormat.textContent.slice(0, 11);
                dateFormat.textContent = sliced;
            }
            continue;
        }

        year = dateFormat.textContent.slice(0, 4);
        month = dateFormat.textContent.slice(5, 7);
        day = dateFormat.textContent.slice(8, 10);

        switch (month) {
            case "01":
                monthName = "January";
                break;

            case "02":
                monthName = "February";
                break;

            case "03":
                monthName = "March";
                break;

            case "04":
                monthName = "April";
                break;

            case "05":
                monthName = "May";
                break;

            case "06":
                monthName = "June";
                break;

            case "07":
                monthName = "July";
                break;

            case "08":
                monthName = "August";
                break;

            case "09":
                monthName = "September";
                break;

            case "10":
                monthName = "October";
                break;

            case "11":
                monthName = "November";
                break;

            case "12":
                monthName = "December";
                break;

            default:
                monthName = "Month"
                break;
        }

        dateFormat.textContent = `${monthName} ${day}, ${year}`;
    }
}

function isValidDateStrict(dateString) {
    const regex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;
    if (!regex.test(dateString)) return false;

    const date = new Date(dateString);
    const [year, month, day] = dateString.split("-").map(Number);

    return date.getFullYear() === year && 
           date.getMonth() + 1 === month && 
           date.getDate() === day;
}