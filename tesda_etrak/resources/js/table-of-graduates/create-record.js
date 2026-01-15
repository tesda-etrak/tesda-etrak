import '../bootstrap';

var selectDistrict = document.getElementById("selectDistrict");
if (selectDistrict) {
    selectDistrict.onchange = function () {
        districtToCitySelection(this.value);
    }
}

var toggleCreate = document.getElementById("toggleCreate");
if (toggleCreate) {
    toggleCreate.onclick = function () {
        document.getElementById("confirmationModal").classList.remove('hidden');
    }
}

var dismissCreate = document.getElementById("dismissCreate");
if (dismissCreate) {
    dismissCreate.onclick = function () {
        document.getElementById("confirmationModal").classList.add('hidden');
    }
}

function districtToCitySelection(optionValue) {
    let city = document.getElementById("selectCity");

    let length = city.options.length - 1;
    for (let i = length; i >= 0; i--) {
        city.remove(i);
    }

    switch (optionValue) {
        case "CaMaNaVa":
            city.add(addOption("None"));
            city.add(addOption("Caloocan City"));
            city.add(addOption("Malabon City"));
            city.add(addOption("Navotas City"));
            city.add(addOption("Valenzuela City"));
            break;

        case "Manila":
            city.add(addOption("Manila"));
            break;

        case "MuntiParLasTaPat":
            city.add(addOption("None"));
            city.add(addOption("Las Piñas City"));
            city.add(addOption("Muntinlupa City"));
            city.add(addOption("Parañaque City"));
            city.add(addOption("Pateros City"));
            city.add(addOption("Taguig City"));
            break;

        case "PaMaMariSan":
            city.add(addOption("None"));
            city.add(addOption("Mandaluyong City"));
            city.add(addOption("Marikina City"));
            city.add(addOption("Pasig City"));
            city.add(addOption("San Juan City"));
            break;

        case "Pasay-Makati":
            city.add(addOption("None"));
            city.add(addOption("Makati City"));
            city.add(addOption("Pasay City"));
            break;

        case "Quezon City":
            city.add(addOption("Quezon City"));
            break;

        default:
            city.add(addOption("None"));
            city.add(addOption("Caloocan City"));
            city.add(addOption("Las Piñas City"));
            city.add(addOption("Makati City"));
            city.add(addOption("Malabon City"));
            city.add(addOption("Mandaluyong City"));
            city.add(addOption("Manila"));
            city.add(addOption("Marikina City"));
            city.add(addOption("Muntinlupa City"));
            city.add(addOption("Navotas City"));
            city.add(addOption("Parañaque City"));
            city.add(addOption("Pasay City"));
            city.add(addOption("Pasig City"));
            city.add(addOption("Pateros City"));
            city.add(addOption("Quezon City"));
            city.add(addOption("San Juan City"));
            city.add(addOption("Taguig City"));
            city.add(addOption("Valenzuela City"));
            break;
    }
}

function addOption(text) {
    let option = document.createElement("option");
    option.text = text;

    if (text == "None") {
        option.value = "";
    }

    return option;
}