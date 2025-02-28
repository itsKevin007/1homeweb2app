<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/delete-account.css">
<br><br>

<!-- Step 1: Initiation -->
<div class="container deletion-init" id="step1">
    <div class="warning-icon">❗</div>
    <h1>Delete Your Account</h1>
    <ul class="bullet-list">
        <li>Permanently remove your account after 15 days</li>
        <li>Remove all personal data</li>
        <li>Cancel active subscriptions</li>
        <li>Delete content permanently</li>
        <li>You can retrieve your account before 15 days if you log in.</li>
    </ul>
    <div class="btn-group">
        <button class="btn btn-primary" onclick="showConfirmation()">Proceed to Delete</button>
    </div>
</div>

<!-- Step 2: Confirmation (Now inline instead of a modal) -->
<div class="container confirmation-step" id="confirmationStep" style="display: none;">
    <h2>Final Warning</h2>
    <p>This action cannot be undone. To confirm deletion:</p>

    <div class="checkbox-group">
        <div class="checkbox-item">
            <input type="checkbox" id="confirm1" onchange="validateForm()">
            <label for="confirm1">I understand all my data will be permanently removed</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" id="confirm2" onchange="validateForm()">
            <label for="confirm2">I acknowledge this will cancel active subscriptions</label>
        </div>
    </div>

    <input type="password" id="password" placeholder="Re-enter password to confirm" onkeyup="validateForm()">
    <p id="errorMessage" style="color: #FF4444; display: none;">Incorrect password</p>

    <div class="btn-group">
        <button class="btn btn-primary" id="deleteBtn" disabled onclick="deleteAccount()">Delete Account Forever</button>
        <button class="btn btn-secondary" onclick="goBack()">Go Back</button>
    </div>
</div>

<!-- Step 3: Success Screen -->
<div class="container success-screen" id="successScreen" style="display: none;">
    <div class="checkmark"></div>
    <h1>Account Deletion Complete</h1>
    <p>Your data will be permanently removed within 15 Days.<br>
        Changed your mind? <a href="#" class="undo-link" onclick="undoDeletion()">Undo deletion</a> within 24 hours.</p>
    <p>Redirecting to homepage in <span id="countdown">5</span> seconds...</p>
</div>

<script>
    function showConfirmation() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('confirmationStep').style.display = 'block';
    }

    function goBack() {
        document.getElementById('confirmationStep').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    }

    function validateForm() {
        const confirm1 = document.getElementById('confirm1').checked;
        const confirm2 = document.getElementById('confirm2').checked;
        const password = document.getElementById('password').value;
        const deleteBtn = document.getElementById('deleteBtn');

        if (confirm1 && confirm2 && password.length > 0) {
            checkPassword(password).then(isValid => {
                deleteBtn.disabled = !isValid;
            });
        } else {
            deleteBtn.disabled = true;
        }
    }

    async function checkPassword(password) {
        const response = await fetch('pass-checker.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `password=${password}`
        });

        const result = await response.text();
        return result.trim() === 'valid';
    }

    function deleteAccount() {

        document.getElementById('confirmationStep').style.display = 'none';
        document.getElementById('successScreen').style.display = 'block';

        fetch('process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                console.log("Raw response:", response);
                if (!response.ok) {
                    throw new Error('HTTP error! Status: ' + response.status);
                }
                return response.text(); // Log raw response
            })
            .then(text => {
                return JSON.parse(text); // Now parse JSON
            })
            .then(data => {
                console.log("Server response:", data);
                if (data.success) {
                    let seconds = 5;
                    const countdown = setInterval(() => {
                        seconds--;
                        document.getElementById('countdown').textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(countdown);
                            window.location.href = '../index.php?logout';
                        }
                    }, 1000);
                } else {
                    alert('Error deleting account: ' + (data.message || 'Unknown error'));
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Something went wrong. Please check the console for details.');
            });

    }


    function undoDeletion() {
        if (confirm("Are you sure you want to undo account deletion?")) {
            window.location.reload(); // Replace with actual undo logic
 
  
        }
    }
</script>
