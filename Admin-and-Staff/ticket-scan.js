const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
  { facingMode: "environment" },
  { fps: 10, qrbox: 350 },
  (decodedText) => {
    document.getElementById("result").textContent = decodedText;
    document.getElementById("reader").classList.add("d-none");
    document.getElementById("refno").value = decodedText;

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
