let totalQty = 1;
    let ticketPrice = 250;
    const total = document.getElementById("subtotal");
    const qty = document.getElementById("qty");
    const movieName = document.getElementById("movieName").textContent;
    const addQty = document
      .getElementById("buttonQtyAdd")
      .addEventListener("click", () => {
        totalQty = totalQty + 1;
        qty.textContent = totalQty;
        ticketPrice = ticketPrice + 250;
        total.textContent = ticketPrice;
        document.getElementById("totalBasketCost").textContent = ticketPrice;
      });
    const reduceQty = document
      .getElementById("buttonQtyReduce")
      .addEventListener("click", () => {
        if (qty.textContent === "1") {
          totalQty = 1;
        } else {
          totalQty = totalQty - 1;
          qty.textContent = totalQty;
          ticketPrice = ticketPrice - 250;
          total.textContent = ticketPrice;
          document.getElementById("totalBasketCost").textContent = ticketPrice;
        }
      });

      document.getElementById("nextBtn").addEventListener("click",() => {
        document.cookie = "ticketPrice=" + ticketPrice+ "; path=/; max-age=3600";
        document.cookie = "movieName=" + movieName + "; path=/; max-age=3600";
        window.location.href = "seating.html";
      })