document.getElementById('userFormA').addEventListener('submit', function(event) {

    const lastname = document.getElementById('lastName').value.trim();
    const firstname = document.getElementById('firstName').value.trim();
    const fullname = document.getElementById('fullName').value.trim();

    const mobile = document.getElementById('mobileNumber').value.trim();
    const pmobile = document.getElementById('pmobileNumber').value.trim();
    const pemail = document.getElementById('pemailAddress').value.trim();

    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    const mobileRegex = /^09\d{9}$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!nameRegex.test(lastname)) {
        console.log("Failed at: Last Name");
        alert("Invalid Last Name.");
        event.preventDefault();
        return;
    }

    if (!nameRegex.test(firstname)) {
        console.log("Failed at: First Name");
        alert("Invalid First Name.");
        event.preventDefault();
        return;
    }

    if (!nameRegex.test(fullname)) {
        console.log("Failed at: Parent Name");
        alert("Invalid Parent/Guardian Name.");
        event.preventDefault();
        return;
    }

    if (!mobileRegex.test(mobile)) {
        console.log("Failed at: Student Mobile");
        alert("Student mobile number must start with 09 and be 11 digits.");
        event.preventDefault();
        return;
    }

    if (!mobileRegex.test(pmobile)) {
        console.log("Failed at: Parent Mobile");
        alert("Parent mobile number must start with 09 and be 11 digits.");
        event.preventDefault();
        return;
    }
    if (!emailRegex.test(pemail)) {
        console.log("Failed at: Parent Email");
        alert("Parent email must end with @gmail.com.");
        event.preventDefault();
        return;
    }
    
    console.log("All validations passed! Submitting form...");
});