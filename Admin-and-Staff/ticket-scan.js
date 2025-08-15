const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
  { facingMode: "environment" },
  { fps: 10, qrbox: 350 },
  (decodedText) => {
    document.getElementById("result").textContent = decodedText;
    window.location.href =
      "ticket-scan.php?code=" + encodeURIComponent(decodedText);

    html5QrCode
      .stop()
      .then(() => {
        console.log("QR code scanning stopped.");
      })
      .catch((err) => {
        console.error("Error stopping scan:", err);
      });
  },
  (error) => {
    console.warn(error);
  }
);
