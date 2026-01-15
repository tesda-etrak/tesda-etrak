var logLevel = document.getElementById("logLevel");
if (logLevel) {
    logLevel.onchange = function () {
        loadLogs();
    }
}

var btnClearLogs = document.getElementById("btnClearLogs");
if (btnClearLogs) {
    btnClearLogs.onclick = function () {
        clearLogs();
    }
}

// loadLogs();
// setInterval(loadLogs, 10000);

async function loadLogs() {
    let logBox = document.getElementById("logBox");
    const selectedLevel = document.getElementById("logLevel").value;

    try {
        const response = await axios.get("/google-sheets-data/logs");
        let content = response.data.log;

        if (selectedLevel !== "all") {
            const regex = new RegExp(selectedLevel, "i");
            content = content.split("<br>").filter(line => regex.test(line)).join("<br>");
        }

        logBox.innerHTML = highlightLogLines(content);
    }
    catch (e) {
        logBox.innerText = "Failed to load logs.";
    }
}

function highlightLogLines(content) {
    return content.split("<br>").map(line => {
        if (/error/i.test(line)) {
            return `<span class="text-red-400">${line}</span>`;
        } else if (/warning/i.test(line)) {
            return `<span class="text-yellow-400">${line}</span>`;
        } else if (/info/i.test(line)) {
            return `<span class="text-white">${line}</span>`;
        } else {
            return `<span class="text-gray-400">${line}</span>`;
        }
    }).join("<br>");
}

async function clearLogs() {
    if (confirm("Confirm clearing all the logs?")) {
        try {
            await axios.post("/google-sheets-data/logs/clear");
            loadLogs();
        }
        catch (e) {
            alert("Failed to clear logs.");
        }
    }
}