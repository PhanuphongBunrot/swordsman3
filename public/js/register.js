

function requestOtp(type) {
    // แสดง OTP Input Section
    document.getElementById(type + '-otp-section').style.display = 'block';

    // ซ่อนปุ่มขอ OTP
    let otpButton = document.getElementById(type + '-otp-button');
    let resendButton = document.getElementById(type + '-resend-button');

    otpButton.style.display = 'none'; // ซ่อนปุ่มขอ OTP
    resendButton.style.display = 'inline-block'; // แสดงปุ่มขอใหม่ (แต่ปิดใช้งาน)

    let countdown = 300; // 5 นาที (300 วินาที)
    resendButton.disabled = true;
    resendButton.innerText = `ขอใหม่ (5:00)`;

    let timer = setInterval(function() {
        countdown--;
        let minutes = Math.floor(countdown / 60);
        let seconds = countdown % 60;
        resendButton.innerText = `ขอใหม่ (${minutes}:${seconds < 10 ? '0' : ''}${seconds})`;

        if (countdown <= 0) {
            clearInterval(timer);
            resendButton.innerText = "ขอใหม่";
            resendButton.disabled = false; // เปิดใช้งานปุ่มขอใหม่
        }
    }, 1000);
}

function verifyOtp(type) {
    alert(`ยืนยัน OTP สำหรับ ${type}`);
}