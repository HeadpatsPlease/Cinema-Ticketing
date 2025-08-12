function downloadPDF() {
  const { jsPDF } = window.jspdf;
  html2canvas(document.querySelector("#ticket"), { scale: 2 }).then(canvas => {
    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF("p", "mm", "a4");
    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();
    const imgProps = {
      width: pageWidth,
      height: (canvas.height * pageWidth) / canvas.width
    };
    if (imgProps.height > pageHeight) {
      imgProps.height = pageHeight;
      imgProps.width = (canvas.width * pageHeight) / canvas.height;
    }
    const x = (pageWidth - imgProps.width) / 2;
    const y = (pageHeight - imgProps.height) / 2;
    pdf.addImage(imgData, "PNG", x, y, imgProps.width, imgProps.height);
    pdf.save("ticket.pdf");
  });
}
const refNo = document.getElementById("refNo").textContent;
document.addEventListener("DOMContentLoaded", () => {
        new QRCode(document.getElementById("qrCode"), {
            text: refNo,
            width: 150,
            height: 150
        });
});