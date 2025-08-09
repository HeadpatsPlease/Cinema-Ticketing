    let totalQty = 1;
    let ticketPrice = 250;
    const total = document.getElementById("subtotal");
    const qty = document.querySelectorAll("#qty");
    let ticketInfo = {
        
      }



    const addQty = document
      .getElementById("buttonQtyAdd")
      .addEventListener("click", () => {
         qty.forEach(el =>{
          let currentqty = parseInt(el.textContent);
          if (currentqty < 8){
            currentqty++;
            el.textContent = currentqty;
            ticketPrice = ticketPrice + 250;
            total.textContent = ticketPrice;
            document.querySelectorAll("#totalBasketCost").forEach(elem => {
            elem.textContent = ticketPrice;
            }); 
          }
        })
          
      });
    const reduceQty = document
      .getElementById("buttonQtyReduce")
      .addEventListener("click", () => {
        qty.forEach(el =>{
          let currentqty = parseInt(el.textContent);

          if (currentqty > 1) {
            currentqty--;
            el.textContent = currentqty;
            ticketPrice = ticketPrice - 250;
            total.textContent = ticketPrice;
            document.querySelectorAll("#totalBasketCost").forEach(elem => {
            elem.textContent = ticketPrice;
            });
          } 
        })
      });

      

      document.getElementById("nextBtn").addEventListener("click",() => {
        document.cookie = "ticketPrice=" + ticketPrice+ "; path=/; max-age=3600";
        let sasa = document.getElementById('movieTicketInfo').textContent;
        window.location.href = "seating.html";
      })