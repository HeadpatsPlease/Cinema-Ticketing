const seats = document.querySelectorAll(".seat");
      const selectedSeats = document.getElementById("selectedSeats");
      let showSelectedSeats = [];
      let reservedSeats = ["A10", "A8"];
      let movieDetail = {}

      let movieCookie = getCookie("movieDetails");

      if(movieCookie) {
         movieDetail = JSON.parse(movieCookie);
      }

      movieDetail["seatsTaken"] = showSelectedSeats;

      let maxSeats = movieDetail["ticketQuantity"];


      
      

    

      seats.forEach((st) => {
        st.addEventListener("click", (e) => {
          console.log(movieDetail);
          
          if(showSelectedSeats.length < maxSeats){
            st.classList.toggle("btn-warning");
          }else{
            st.classList.remove("btn-warning")
          }


          if (e.target.classList.contains("btn-warning")) {
              showSelectedSeats.push(e.target.textContent.trim());
          } else {
            const index = showSelectedSeats.indexOf(e.target.textContent.trim());
            if (index !== -1) {
              showSelectedSeats.splice(index, 1);
            }
          }
          selectedSeats.textContent = "Seats: " + showSelectedSeats;
        });

        let reserve = st.textContent;
        if (reservedSeats.includes(reserve)) {
          st.classList.add("btn-danger");
          st.classList.add("disabled");
        }
      });
      

      document.getElementById("nextBtn").addEventListener("click",() => {
        if(showSelectedSeats.length == 0 || showSelectedSeats.length < maxSeats){
            alert("Pick a seat");
        }else{
            setCookie("movieDetails",JSON.stringify(movieDetail));
            window.location.href = "beverage.php";
        }
      })