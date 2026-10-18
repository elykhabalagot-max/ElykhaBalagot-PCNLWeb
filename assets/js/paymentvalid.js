function validateRow(paymentId) {
    const units = document.getElementById('units-' + paymentId).value.trim();
    const tuition = document.getElementById('tuition-' + paymentId).value.trim();
    const reg = document.getElementById('reg-' + paymentId).value.trim();
    const lib = document.getElementById('lib-' + paymentId).value.trim();
    const med = document.getElementById('med-' + paymentId).value.trim();
    const guide = document.getElementById('guide-' + paymentId).value.trim();
    const lab = document.getElementById('lab-' + paymentId).value.trim();
    const net = document.getElementById('net-' + paymentId).value.trim();
    const org = document.getElementById('org-' + paymentId).value.trim();
    const pub = document.getElementById('pub-' + paymentId).value.trim();
    const id = document.getElementById('id-' + paymentId).value.trim();
    const ath = document.getElementById('ath-' + paymentId).value.trim();
    const act = document.getElementById('act-' + paymentId).value.trim();
    const ins = document.getElementById('ins-' + paymentId).value.trim();
    const cul = document.getElementById('cul-' + paymentId).value.trim();
    const pri = document.getElementById('pri-' + paymentId).value.trim();
    const sec = document.getElementById('sec-' + paymentId).value.trim();
    const energy = document.getElementById('energy-' + paymentId).value.trim()
    const hand = document.getElementById('hand-' + paymentId).value.trim();
    const crim = document.getElementById('crim-' + paymentId).value.trim();
    const total = document.getElementById('total-' + paymentId).value.trim();

    const integerRegex = /^\d+$/;
    const decimalRegex = /^\d+(\.\d{1,2})?$/;

    if (!integerRegex.test(units) || parseInt(units, 10) < 0) {
        alert("Invalid Value: Must be a whole number/integer only (no decimals, letters, or special characters allowed).");
        document.getElementById('units-' + subjectId).focus();
        return false;
    }
    if (!decimalRegex.test(tuition) || parseFloat(tuition) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('tuition-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(reg) || parseFloat(reg) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('reg-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(lib) || parseFloat(lib) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('lib-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(med) || parseFloat(med) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('med-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(guide) || parseFloat(guide) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('guide-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(lab) || parseFloat(lab) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('lab-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(net) || parseFloat(net) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('net-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(org) || parseFloat(org) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('org-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(pub) || parseFloat(pub) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('pub-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(id) || parseFloat(id) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('id-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(ath) || parseFloat(ath) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('ath-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(act) || parseFloat(act) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('act-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(ins) || parseFloat(ins) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('ins-' + paymentId).focus();
        return false
    }
    if (!decimalRegex.test(cul) || parseFloat(cul) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('cul-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(pri) || parseFloat(pri) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('pri-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(sec) || parseFloat(sec) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('sec-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(energy) || parseFloat(energy) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('energy-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(hand) || parseFloat(hand) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('hand-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(crim) || parseFloat(crim) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('crim-' + paymentId).focus();
        return false;
    }
    if (!decimalRegex.test(total) || parseFloat(total) < 0) {
        alert("Invalid Value: Must be a valid decimal number (e.g., 150.00) with no letters or special characters.");
        document.getElementById('total-' + paymentId).focus();
        return false;
    }
    return true;
}