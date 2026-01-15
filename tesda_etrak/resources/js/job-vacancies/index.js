document.querySelectorAll(".cards").forEach(function (card) {
    card.addEventListener('click', function () {
        blankedDefinitions();
    });
});

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
    else 
        console.log(`Blanked definitions not found!`);
}