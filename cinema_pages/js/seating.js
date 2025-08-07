const seats = document.querySelectorAll(".seat");
      const selectedSeats = document.getElementById("selectedSeats");
      let showSelectedSeats = [];
      let reservedSeats = ["A10", "A8"];

    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }
    document.getElementById("totalBasketCost").textContent = getCookie("ticketPrice");
    document.getElementById("movieName").textContent = getCookie("movieName");

      seats.forEach((st) => {
        st.addEventListener("click", (e) => {
          st.classList.toggle("btn-warning");
          st.classList.toggle("btn-secondary");
          if (e.target.classList.contains("btn-warning")) {
            showSelectedSeats.push(e.target.textContent);
          } else {
            showSelectedSeats.pop(e.target.textContent);
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
        if(showSelectedSeats.length == 0){
            alert("Pick a seat");
        }else{
            document.cookie = "selectedSeats=" + encodeURIComponent(JSON.stringify(showSelectedSeats))+ "; path=/; max-age=3600";
            window.location.href = "beverage.html";
        }
      })