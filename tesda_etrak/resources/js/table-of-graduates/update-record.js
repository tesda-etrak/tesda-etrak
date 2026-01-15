//#region VARIABLES
const tabDetails = document.getElementById("tabDetails");
const tabVerification = document.getElementById("tabVerification");
const tabEmployment = document.getElementById("tabEmployment");

const btnNone = document.getElementById("btnNone");
const btnResponded = document.getElementById("btnResponded");
const btnNoResponse = document.getElementById("btnNoResponse");
const divResponded = document.getElementById("divResponded");
const divNoResponse = document.getElementById("divNoResponse");

const btnInterested = document.getElementById("btnInterested");
const btnNotInterested = document.getElementById("btnNotInterested");
const divInterested = document.getElementById("divInterested");
const divNotInterested = document.getElementById("divNotInterested");

const referralStatusForm = document.getElementById("referralStatusForm");
const btnYes = document.getElementById("btnYes");
const btnNo = document.getElementById("btnNo");
const referralDate = document.getElementById("referral_date");
const noReferralReason = document.getElementById("no_referral_reason");

const notInterestedReason = document.getElementById("not_interested_reason");

const followUpDate_1 = document.getElementById("follow_up_date_1");
const followUpDate_2 = document.getElementById("follow_up_date_2");
const invalidContact = document.getElementById("invalid_contact");
const followUpRemarks = document.getElementById("follow_up_remarks");

const btnProceed = document.getElementById("btnProceed");
const btnNotProceed = document.getElementById("btnNotProceed");
const divProceed = document.getElementById("divProceed");
const divNotProceed = document.getElementById("divNotProceed");
const notProceedReason = document.getElementById("not_proceed_reason");

const btnHired = document.getElementById("btnHired");
const btnSubmitDocs = document.getElementById("btnSubmitDocs");
const btnForInterview = document.getElementById("btnForInterview");
const btnNotHired = document.getElementById("btnNotHired");

const hiredDate = document.getElementById("hired_date");
const submitDocsDate = document.getElementById("submitted_documents_date");
const interviewDate = document.getElementById("interview_date");
const notHiredReason = document.getElementById("not_hired_reason");

const VerificationStatus = Object.freeze({
    NONE: btnNone.value,
    RESPONDED: btnResponded.value,
    NO_RESPONSE: btnNoResponse.value
});
const ResponseType = Object.freeze({
    INTERESTED: btnInterested.value,
    NOT_INTERESTED: btnNotInterested.value
});
const Referral_Status = Object.freeze({
    YES: btnYes.value,
    NO: btnNo.value
});
//#endregion

//#region FUNCTIONS AND INITIALISATION
document.addEventListener("DOMContentLoaded", function () {
    tabDetails.addEventListener('click', function () {
        openTab(0);
    });
    tabVerification.addEventListener('click', function () {
        openTab(1);
        refreshVerification();
    });
    tabEmployment.addEventListener('click', function () {
        openTab(2);
    });

    tabVerification.click();
});

function openTab(index) {
    document.querySelectorAll(".tab-content").forEach((tab, i) => {
        tab.classList.toggle("hidden", i !== index);
    });

    document.querySelectorAll("#tabs button").forEach((btn, i) => {
        btn.classList.toggle("border-black", i === index);
        btn.classList.toggle("border-transparent", i !== index);
        btn.classList.toggle("hover:border-gray-300", i !== index);
    });
}

function refreshVerification() {
    if (btnNone.checked == true) {
        verificationStatusValue(VerificationStatus.NONE);
    }
    if (btnResponded.checked == true) {
        verificationStatusValue(VerificationStatus.RESPONDED);
    }
    if (btnNoResponse.checked == true) {
        verificationStatusValue(VerificationStatus.NO_RESPONSE);
    }

    if (btnInterested.checked == true) {
        typeOfResponse(ResponseType.INTERESTED);
    }
    if (btnNotInterested.checked == true) {
        typeOfResponse(ResponseType.NOT_INTERESTED);
    }

    if (btnYes.checked == true) {
        referralStatus(Referral_Status.YES);
    }
    if (btnNo.checked == true) {
        referralStatus(Referral_Status.NO);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    btnNone.addEventListener('click', function () {
        verificationStatusValue(VerificationStatus.NONE);
    });
    btnResponded.addEventListener('click', function () {
        verificationStatusValue(VerificationStatus.RESPONDED);
    });
    btnNoResponse.addEventListener('click', function () {
        verificationStatusValue(VerificationStatus.NO_RESPONSE);
    });
});

function verificationStatusValue(response) {
    if (response == VerificationStatus.RESPONDED) {
        divResponded.classList.remove("hidden");
        divNoResponse.classList.add("hidden");
        respondedStatus();
    }
    else if (response == VerificationStatus.NO_RESPONSE) {
        divNoResponse.classList.remove("hidden");
        divResponded.classList.add("hidden");
        noResponseStatus();
    }
    else {
        divResponded.classList.add("hidden");
        divNoResponse.classList.add("hidden");
        noVerificationStatus();
    }
}

function respondedStatus() {
    resetDate(followUpDate_1);
    resetDate(followUpDate_1);

    invalidContact.checked = false;
    invalidContact.value = "";
    followUpRemarks.value = "";
}

function noResponseStatus() {
    divInterested.classList.add("hidden");
    divNotInterested.classList.add("hidden");

    btnInterested.checked = false;
    referralStatusForm.disabled = true;
    btnYes.checked = false;
    btnNo.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";

    btnNotInterested.checked = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";

    employmentField(true);
}

function noVerificationStatus() {
    divInterested.style.display = "none";
    divNotInterested.style.display = "none";

    btnInterested.checked = false;
    referralStatusForm.disabled = true;
    btnYes.checked = false;
    btnNo.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";

    btnNotInterested.checked = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";

    resetDate(followUpDate_1);
    resetDate(followUpDate_2);

    invalidContact.checked = false;
    invalidContact.value = "";

    employmentField(true);
}

document.addEventListener("DOMContentLoaded", function () {
    btnInterested.addEventListener('click', function () {
        typeOfResponse(ResponseType.INTERESTED);
    });
    btnNotInterested.addEventListener('click', function () {
        typeOfResponse(ResponseType.NOT_INTERESTED);
    });
});

function typeOfResponse(response) {
    if (response == ResponseType.INTERESTED) {
        divInterested.classList.remove("hidden");
        referralStatusForm.disabled = false;
        
        divNotInterested.classList.add("hidden");
        notInterestedReason.disabled = true;
        notInterestedReason.value = "";
    }
    else {
        divNotInterested.classList.remove("hidden");
        notInterestedReason.disabled = false;
        
        divInterested.classList.add("hidden");
        referralStatusForm.disabled = true;
        btnYes.checked = false;
        btnNo.checked = false;
        referralDate.disabled = true;
        resetDate(referralDate);
        noReferralReason.disabled = true;
        noReferralReason.value = "";

        employmentField(true);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    btnYes.addEventListener('click', function () {
        referralStatus(Referral_Status.YES);
    });
    btnNo.addEventListener('click', function () {
        referralStatus(Referral_Status.NO);
    });

    invalidContact.addEventListener('click', function () {
        invalidContactValue(invalidContact.checked);
    });
});

function referralStatus(response) {
    if (response == Referral_Status.YES) {
        referralDate.disabled = false;
        referralDate.classList.remove("bg-gray-200");
        noReferralReason.disabled = true;
        noReferralReason.value = "";
        noReferralReason.classList.add("bg-gray-200");
        employmentField(false);
    }
    else {
        noReferralReason.disabled = false;
        noReferralReason.classList.remove("bg-gray-200");
        referralDate.disabled = true;
        referralDate.classList.add("bg-gray-200");
        resetDate(referralDate);
        employmentField(true);
    }
}

function invalidContactValue(isChecked) {
    if (isChecked) {
        invalidContact.value = "Yes";
    }
    else {
        invalidContact.value = "";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    btnProceed.addEventListener('click', function () {
        applicationStatusValue(true);
    });
    btnNotProceed.addEventListener('click', function () {
        applicationStatusValue(false);
    });
});

function applicationStatusValue(canProceed) {
    if (canProceed == true) {
        divProceed.style.display = "block";
        divNotProceed.style.display = "none";
        proceedStatus();
    }
    else {
        divNotProceed.style.display = "block";
        divProceed.style.display = "none";
        notProceedStatus();
    }
}

function proceedStatus() {
    notProceedReason.disabled = true;
    notProceedReason.value = "";

    remarks.disabled = false;
}

function notProceedStatus() {
    notProceedReason.disabled = false;

    btnHired.checked = false;
    btnSubmitDocs.checked = false;
    btnForInterview.checked = false;
    btnNotHired.checked = false;

    hiredDate.disabled = true;
    resetDate(hiredDate);
    submitDocsDate.disabled = true;
    resetDate(submitDocsDate);
    interviewDate.disabled = true;
    resetDate(interviewDate);
    notHiredReason.disabled = true;
    notHiredReason.value = "";
    remarks.disabled = true;
    remarks.value = "";
}

document.addEventListener("DOMContentLoaded", function () {
    btnHired.addEventListener('click', function () {
        employmentStatusValue(this.id);
    });
    btnSubmitDocs.addEventListener('click', function () {
        employmentStatusValue(this.id);
    });
    btnForInterview.addEventListener('click', function () {
        employmentStatusValue(this.id);
    });
    btnNotHired.addEventListener('click', function () {
        employmentStatusValue(this.id);
    });
});

function employmentStatusValue(id) {
    if (id === btnHired.id) {
        hiredDate.disabled = false;
    }
    else {
        hiredDate.disabled = true;
        resetDate(hiredDate);
    }

    if (id === btnSubmitDocs.id) {
        submitDocsDate.disabled = false;
    }
    else {
        submitDocsDate.disabled = true;
        resetDate(submitDocsDate);
    }

    if (id === btnForInterview.id) {
        interviewDate.disabled = false;
    }
    else {
        interviewDate.disabled = true;
        resetDate(interviewDate);
    }

    if (id === btnNotHired.id) {
        notHiredReason.disabled = false;
    }
    else {
        notHiredReason.disabled = true;
        notHiredReason.value = "";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const btnUpdate_1 = document.getElementById("btnUpdate_1");
    const btnUpdate_2 = document.getElementById("btnUpdate_2");
    const btnCancelUpdate = document.getElementById("btnCancelUpdate");
    const modalUpdate = document.getElementById("modalUpdate");

    btnUpdate_1.addEventListener("click", function () {
        modalUpdate.classList.remove('hidden');
    });
    btnUpdate_2.addEventListener("click", function () {
        modalUpdate.classList.remove("hidden");
    });
    btnCancelUpdate.addEventListener("click", function () {
        modalUpdate.classList.add("hidden");
    });
});

function employmentField(isDisabled) {
    const companyName = document.getElementById("company_name");
    const companyAddress = document.getElementById("company_address");
    const jobTitle = document.getElementById("job_title");

    const notProceedReason = document.getElementById("not_proceed_reason");
    const remarks = document.getElementById("remarks");

    document.getElementById("employmentField").disabled = isDisabled;

    if (isDisabled) {
        tabEmployment.classList.add("hidden");

        companyName.value = "";
        companyAddress.value = "";
        jobTitle.value = "";

        btnProceed.checked = false;
        btnNotProceed.checked = false;
        divProceed.style.display = "none";
        divNotProceed.style.display = "none";

        btnHired.checked = false;
        btnSubmitDocs.checked = false;
        btnForInterview.checked = false;
        btnNotHired.checked = false;

        hiredDate.disabled = true;
        resetDate(hiredDate);
        submitDocsDate.disabled = true;
        resetDate(submitDocsDate);
        interviewDate.disabled = true;
        resetDate(interviewDate);
        notHiredReason.disabled = true;
        notHiredReason.value = "";
        remarks.disabled = true;
        remarks.value = "";

        notProceedReason.disabled = true;
        notProceedReason.value = "";
    }
    else {
        tabEmployment.classList.remove("hidden");
    }
}

function resetDate(element) {
    element.value = "";

    // prevent error on older browsers (eg. IE8)
    if (element.type === "date") {
        // update the input content visually
        element.type = "text";
        element.type = "date";
    }
}

function dateFormatRead() {
    let dateFormats = document.getElementsByClassName("dateFormat");
    let year = "";
    let month = "";
    let day = "";

    let monthName = "";
    let dateValue = "";
    for (let dateFormat of dateFormats) {
        dateValue = dateFormat.value;
        if (dateValue == "") {
            continue;
        }

        year = dateValue.slice(0, 4);
        month = dateValue.slice(5, 7);
        day = dateValue.slice(8, 10);

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

        dateFormat.value = `${monthName} ${day}, ${year}`;
    }
}
//#endregion

dateFormatRead();