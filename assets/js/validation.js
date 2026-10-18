document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");
    if (!form) return;

    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("emailError");
    
    const passwordInput = document.getElementById("password");
    const passwordError = document.getElementById("passwordError");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        const emailValue = emailInput.value.trim().toLowerCase();
        if (!emailValue.endsWith("@gmail.com")) {
            e.preventDefault();
            emailError.textContent = "Email must end with @gmail.com";
            emailInput.focus();
            isValid = false;
        } else {
            emailError.textContent = "";
        }

        const passwordValue = passwordInput.value;
        if (passwordValue.length < 6) {
            e.preventDefault();
            passwordError.textContent = "Password must be at least 6 characters long.";
            if (isValid) {
                passwordInput.focus();
            }
            isValid = false;
        } else {
            passwordError.textContent = "";
        }
    });
});
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('-translate-x-full');
    
    overlay.classList.toggle('hidden');
}

document.getElementById('userForm').addEventListener('submit', function(event) {
    const lastname = document.getElementById('lastName').value.trim();
    const firstname = document.getElementById('firstName').value.trim();
    const fullname = document.getElementById('fullName').value.trim()
    const mobile = document.getElementById('mobileNumber').value.trim();
    const pmobile = document.getElementById('pmobileNumber').value.trim();
    const email = document.getElementById('emailAddress').value.trim();
    const pemail = document.getElementById('pemailAddress').value.trim();

    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    if (!nameRegex.test(lastname)) {
        alert("Invalid Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        event.preventDefault(); 
        return;
    }
    if (!nameRegex.test(firstname)) {
        alert("Invalid Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        event.preventDefault(); 
        return;
    }
    if (!nameRegex.test(fullname)) {
        alert("Invalid Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        event.preventDefault(); 
        return;
    }
    const mobileRegex = /^09\d{9}$/;
    if (!mobileRegex.test(mobile)) {
        alert("Invalid Mobile Number: Must start with '09' and be exactly 11 digits long.");
        event.preventDefault();
        return;
    }
    if (!mobileRegex.test(pmobile)) {
        alert("Invalid Mobile Number: Must start with '09' and be exactly 11 digits long.");
        event.preventDefault();
        return;
    }
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!emailRegex.test(email)) {
        alert("Invalid Email: Email must end with '@gmail.com'.");
        event.preventDefault();
        return;
    }
    if (!emailRegex.test(pemail)) {
        alert("Invalid Email: Email must end with '@gmail.com'.");
        event.preventDefault();
        return;
    }
});
function validateRow(studentId) {
    const lastname = document.getElementById('lastName-' + studentId).value.trim();
    const firstname = document.getElementById('firstName-' + studentId).value.trim();
    const fullname = document.getElementById('fullName-' + studentId).value.trim();
    const mobile = document.getElementById('mobileNumber-' + studentId).value.trim();
    const pmobile = document.getElementById('pmobileNumber-' + studentId).value.trim();
    const email = document.getElementById('emailAddress-' + studentId).value.trim();
    const pemail = document.getElementById('pemailAddress-' + studentId).value.trim();

    const nameRegex = /^[A-Z][A-Za-z\s'-]*$/;
    const mobileRegex = /^09\d{9}$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!nameRegex.test(lastname)) {
        alert("Invalid Last Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        document.getElementById('lastName-' + studentId).focus();
        return false;
    }

    if (!nameRegex.test(firstname)) {
        alert("Invalid First Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        document.getElementById('firstName-' + studentId).focus();
        return false;
    }

    if (!nameRegex.test(fullname)) {
        alert("Invalid Full Name: Must start with an uppercase letter and cannot contain numbers or special symbols.");
        document.getElementById('fullName-' + studentId).focus();
        return false;
    }

    if (!mobileRegex.test(mobile)) {
        alert("Invalid Mobile Number: Must start with '09' and be exactly 11 digits long.");
        document.getElementById('mobileNumber-' + studentId).focus();
        return false;
    }

    if (!mobileRegex.test(pmobile)) {
        alert("Invalid Parent Mobile Number: Must start with '09' and be exactly 11 digits long.");
        document.getElementById('pmobileNumber-' + studentId).focus();
        return false;
    }

    if (!emailRegex.test(email)) {
        alert("Invalid Email: Email must end with '@gmail.com'.");
        document.getElementById('emailAddress-' + studentId).focus();
        return false;
    }

    if (!emailRegex.test(pemail)) {
        alert("Invalid Parent Email: Email must end with '@gmail.com'.");
        document.getElementById('pemailAddress-' + studentId).focus();
        return false;
    }

    return true;
}