    let totalQty = 1;
    let ticketPrice = 0;
    const total = document.getElementById("subtotal");
    const qty = document.querySelectorAll("#qty");

    let movieDetails = {};

    movieDetails["movieTitle"] = getCookie("movietitle");
    movieDetails["selectedTime"] = getCookie("selectedtime");
    movieDetails["selectedDate"] = getCookie("selecteddate");
    movieDetails["selectedQuality"] = getCookie("selectedquality");
    
    



    const addQty = document
      .getElementById("buttonQtyAdd")
      .addEventListener("click", () => {
         qty.forEach(el =>{
          let currentqty = parseInt(el.textContent);
          if (currentqty < 8){
            currentqty++;
            el.textContent = currentqty;
            ticketPrice = currentqty * 250
            total.textContent = ticketPrice;
            document.querySelectorAll("#totalBasketCost").forEach(elem => {
            elem.textContent = ticketPrice;
            }); 
            movieDetails["ticketQuantity"] = currentqty;
            movieDetails["ticketTotal"] = ticketPrice;
          }
        })
        
        console.log(movieDetails);
        
        
          
      });
    const reduceQty = document
      .getElementById("buttonQtyReduce")
      .addEventListener("click", () => {
        qty.forEach(el =>{
          let currentqty = parseInt(el.textContent);

          if (currentqty > 1) {
            currentqty--;
            el.textContent = currentqty;
            ticketPrice = currentqty * 250
            total.textContent = ticketPrice;
            document.querySelectorAll("#totalBasketCost").forEach(elem => {
            elem.textContent = ticketPrice;
            });
            movieDetails["ticketQuantity"] = currentqty;
            movieDetails["ticketTotal"] = ticketPrice;
          } 
          console.log(movieDetails);
        })
      });




      

      document.getElementById("nextBtn").addEventListener("click",() => {
        setCookie("movieDetails",JSON.stringify(movieDetails));
        window.location.href = "seating.php";
      })