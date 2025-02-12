document.getElementById('applicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const country = document.getElementById('country').value;

    if (!name || !email || !phone || !country) {
        alert('Please fill out all fields.');
        return;
    }

    if (!/^\S+@\S+\.\S+$/.test(email)) {
        alert('Enter a valid email.');
        return;
    }

    if (!/^\d{10}$/.test(phone)) {
        alert('Enter a valid 10-digit phone number.');
        return;
    }

    alert('Application submitted successfully!');
});
