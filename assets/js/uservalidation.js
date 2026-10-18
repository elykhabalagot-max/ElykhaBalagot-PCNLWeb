document.getElementById('userFormA').addEventListener('submit', function(event) {

    const lastname = document.getElementById('lastName').value.trim();
    const firstname = document.getElementById('firstName').value.trim();
    const fullname = document.getElementById('fullName').value.trim();

    const mobile = document.getElementById('mobileNumber').value.trim();
    const pmobile = document.getElementById('pmobileNumber').value.trim();
    const semail = document.getElementById('emailAddress').value.trim();
    const pemail = document.getElementById('pemailAddress').value.trim();

    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    const mobileRegex = /^09\d{9}$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!nameRegex.test(lastname)) {
        alert("Invalid Last Name.");
        event.preventDefault();
        return;
    }

    if (!nameRegex.test(firstname)) {
        alert("Invalid First Name.");
        event.preventDefault();
        return;
    }

    if (!nameRegex.test(fullname)) {
        alert("Invalid Parent/Guardian Name.");
        event.preventDefault();
        return;
    }

    if (!mobileRegex.test(mobile)) {
        alert("Student mobile number must start with 09 and be 11 digits.");
        event.preventDefault();
        return;
    }

    if (!mobileRegex.test(pmobile)) {
        alert("Parent mobile number must start with 09 and be 11 digits.");
        event.preventDefault();
        return;
    }

    if (!emailRegex.test(semail)) {
        alert("Student email must end with @gmail.com.");
        event.preventDefault();
        return;
    }
    
    if (!emailRegex.test(pemail)) {
        alert("Parent email must end with @gmail.com.");
        event.preventDefault();
        return;
    }
});