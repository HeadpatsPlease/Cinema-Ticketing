    let totalQty = 1;
    let ticketPrice = 0;
    const total = document.getElementById("subtotal");
    const qty = document.querySelectorAll("#qty");
    let cinema = document.getElementById("cinema").textContent;

    let movieDetails = {};
    let refNo = getRandomInt(10, 999) + "-" + getRandomInt(10, 999) + "-" + getRandomInt(10, 999);

    movieDetails["movieTitle"] = getCookie("movietitle");
    movieDetails["selectedTime"] = getCookie("selectedtime");
    movieDetails["selectedDate"] = getCookie("selecteddate");
    movieDetails["selectedQuality"] = getCookie("selectedquality");
    movieDetails["location"] = getCookie("loc");
    movieDetails["cinema"] = cinema;
    movieDetails["refNo"] = refNo;
    
    

    function getRandomInt(min, max) {
      min = Math.ceil(min);
      max = Math.floor(max);
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    document.addEventListener('DOMContentLoaded',()=>{
      movieDetails["ticketTotal"] = 250;
      qty.forEach(qt => {
        movieDetails["ticketQuantity"] = parseInt(qt.textContent)
      })
    })
    
    

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