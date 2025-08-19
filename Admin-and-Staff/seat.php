<?php 
if (isset($_POST['return'])) {
    header("Location: checkseats.php");
    # code...
}
 include '../php/connection.php';
    $name = $_POST['name'];
    $time = $_POST['time'];
    $cine = $_POST['cine'];
    $reserved = $admin->query("SELECT `seat_num` FROM `reservedseats` WHERE movie_name = '$name' AND time = '$time' AND cinema = '$cine'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cinema_pages/css/seating.css">
    <title>Document</title>
</head>
<body>
   <form  method="post">
     <button name="return" class="btn btn-success">
        Back
    </button>
   </form>
    <?php 

    while($seat = $reserved->fetch_assoc()){?>
            <input type="hidden" class="reserve" value="<?= $seat['seat_num']?>">
            <?php }; ?>
    <div
            class="container d-flex justify-content-between mt-2 flex-wrap pb-3"
          >
            <h3 class="text-light roboto-bold">
              <span class="bg-danger text-danger pe-1 ps-2 small">0</span
              >Reserved
            </h3>
            <h3 class="text-light roboto-bold">
              <span class="bg-secondary text-secondary pe-1 ps-2 small">0</span
              >Available
            </h3>
            <h3 class="text-light roboto-bold">
              <span class="bg-warning text-warning pe-1 ps-2 small">0</span
              >Selected
            </h3>
          </div>
              <h1
                class="text-center bg-danger text-light pb-1 w-100 d-none d-md-inline-block roboto-bold"
              >
                Screen 
              </h1>
              <div class="row g-0 d-flex flex-md-row flex-sm-column justify-content-center">
                <!-- col1 -->
                <div class="col-auto text-center">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D9
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E9
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D8
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E8
                      </button>
                    </div>
                  </div>
                </div>

                <!-- col2 -->
                <div class="col-auto text-center mx-md-3">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0 my-2"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D7
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E7
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D6
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E6
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D5
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E5
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D4
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E4
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D3
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E3
                      </button>
                    </div>
                  </div>
                </div>
                <!-- col3 -->
                <div class="col-auto text-center">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D2
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E2
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D1
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E1
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto d-md-none">
              <h1
                class="text-center bg-danger text-light pb-1 d-md-none"
                style="writing-mode: vertical-rl; text-orientation: upright"
              >
                Screen
              </h1>
            </div>
          </div>

    <script>
        const seats = document.querySelectorAll(".seat");
        const selectedSeats = document.getElementById("selectedSeats");
            let showSelectedSeats = [];
            let reservedSeats = [];
            const rSeats = document.querySelectorAll(".reserve");
            rSeats.forEach((r) => {
            let rse = r.value;
            reservedSeats.push(rse);
            });
            seats.forEach((st) => {
                let reserve = st.textContent.trim();
                if (reservedSeats.includes(reserve.trim())) {
                    st.classList.add("btn-danger");
                    st.classList.add("disabled");
                }
                st.addEventListener("click", (e) => {

                    console.log(reservedSeats);
                    
                });
                });
       
    </script>
    
</body>
</html>