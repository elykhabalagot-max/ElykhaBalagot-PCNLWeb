document.getElementById('userFormSubj').addEventListener('submit', function(event) {
    const dtitle = document.getElementById('title').value.trim();
    const day = document.getElementById('day').value.trim();
    const instruct = document.getElementById('instructor').value.trim();

    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    if (!nameRegex.test(dtitle)) {
        alert("Invalid Title: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        event.preventDefault(); 
        return;
    }
    if (!nameRegex.test(instruct)) {
        alert("Invalid Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        event.preventDefault(); 
        return;
    }
    const dayRegex = /^[A-Z][A-Za-z\s'/\-]*$/;    
    if (!dayRegex.test(day)) {
        alert("Invalid Day: Must start with an uppercase letter and cannot contain numbers or special symbols (except /).");
        event.preventDefault(); 
        return;
    }
});

function validateRow(subjectId) {
    const descri = document.getElementById('Descri-' + subjectId).value.trim();
    const day = document.getElementById('Day-' + subjectId).value.trim();
    const instructor = document.getElementById('Instruct-' + subjectId).value.trim();


    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    const dayRegex = /^[A-Z][A-Za-z\s'/\-]*$/; 
    if (!nameRegex.test(descri)) {
        alert("Invalid Title: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        document.getElementById('Descri-' + subjectId).focus();
        return false;
    }
    if (!dayRegex.test(day)) {
        alert("Invalid Day: Must start with an uppercase letter and cannot contain numbers or special symbols (except /).");
        document.getElementById('Day-' + subjectId).focus();
        return false;
    }
        if (!nameRegex.test(instructor)) {
        alert("Invalid Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        document.getElementById('Instruct-' + subjectId).focus();
        return false;
    }

    return true;
}