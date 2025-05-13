window.scan = function () {
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false
    });
    
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert("No cameras found.");
        }
    }).catch(function (e) {
        console.error(e);
    });
    
    scanner.addListener('scan', function (content) {
       document.getElementById.text = content;
       document.location.href = content;
    });

    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.log("getUserMedia not supported");
    } else {
        console.log("getUserMedia is supported");
    }
    
};

// window.copyUUID = function () {
//     const uuid = document.getElementById('text').value;
//     navigator.clipboard.writeText(uuid).then(() => {
//         alert('UUID copied to clipboard');
//     }).catch(err => {
//         console.error('Could not copy text: ', err);
//     });
// }

window.confirmFirst = function showConfirmation() {
    const title = document.getElementById('title').value;
    const sender = document.getElementById('sender').value;
    const email = document.getElementById('email').value;
    const senderDept = document.getElementById('sender_dept').value;
    const recipientDept = document.getElementById('department').value;
    const commType = document.querySelector('input[name="communication"]:checked')?.value || 'Not selected';

    if (!title || !recipientDept || !document.querySelector('input[name="communication"]:checked')) {
        alert("Please fill out all required fields.");
        return;
    }

    document.getElementById('previewText').innerHTML = `
        <strong>Document:</strong> ${title}<br>
        <strong>Sender:</strong> ${sender}<br>
        <strong>Sender's Email:</strong> ${email}<br>
        <strong>Sender Dept:</strong> ${senderDept}<br>
        <strong>Recipient Dept:</strong> ${recipientDept}<br>
        <strong>Communication:</strong> ${commType}
    `;

    document.getElementById('confirmModal').style.display = 'block';
}

window.closeModal = function closeModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

window.submitForm = function submitForm() {
    document.getElementById('qrForm').submit();
}