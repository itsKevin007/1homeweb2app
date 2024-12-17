
    document.getElementById('startScanBtn').addEventListener('click', function () {
        document.getElementById('qr-reader').style.display = 'block';
        startQRScanner();
    });

    function startQRScanner() {
        const html5QrCode = new Html5Qrcode("qr-reader");
        
        html5QrCode.start({ facingMode: "environment" }, {
            fps: 10,    // frames per second
            qrbox: 250  // size of the scanning box
        }, function(decodedText, decodedResult) {
            // Stop the scanner after successful QR code scan
            html5QrCode.stop().then((ignore) => {
                // Handle the QR data (decodedText is the QR code data)
                findUserInDatabase(decodedText);
            }).catch((err) => {
                console.error(err);
            });
        }).catch((err) => {
            console.error("Error starting scanner", err);
        });
    }

    function findUserInDatabase(qrCodeData) {
        // Make an AJAX call to check if the user exists in the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_user.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.exists) {
                    // Show modal with user info
                    document.getElementById('userInfo').innerText = `Name: ${response.name}, Email: ${response.email}`;
                    document.getElementById('userModal').style.display = 'block';
                } else {
                    // Show SweetAlert if user is not found
                    Swal.fire('User Not Found', 'No user exists with this QR code.', 'error');
                }
            }
        };
        xhr.send('qr_code=' + qrCodeData);
    }

    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
    }
