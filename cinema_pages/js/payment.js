let movieDetail = {}
let movieCookie = getCookie("movieDetails");
if(movieCookie) {
    movieDetail = JSON.parse(movieCookie);
}
let refNo = getRandomInt(10, 999) + "-" + getRandomInt(10, 999) + "-" + getRandomInt(10, 999);


document.addEventListener("DOMContentLoaded", () =>{
    console.log(movieDetail);
})

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

document.getElementById("refNo").textContent = refNo;
