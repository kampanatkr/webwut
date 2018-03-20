function setDateTimeRules(minCase) {
    // datetime-local value
    let dtlvalue;
    switch (minCase) {
        case 0:
            dtlvalue = document.getElementById("event-registrable-date").value;
            document.getElementById("event-start-date").min = dtlvalue;
            document.getElementById("event-end-date").min = dtlvalue;
            console.log(dtlvalue);
            break;
        case 1:
            dtlvalue = document.getElementById("event-start-date").value;
            document.getElementById("event-registrable-date").max = dtlvalue;
            document.getElementById("event-end-date").min = dtlvalue;
            console.log(dtlvalue);
            break;
        case 2:
            dtlvalue = document.getElementById("event-end-date").value;
            dtlvalue = document.getElementById("event-end-date").value;
            document.getElementById("event-start-date").max = dtlvalue;
            console.log(dtlvalue);
            break;
    }

}