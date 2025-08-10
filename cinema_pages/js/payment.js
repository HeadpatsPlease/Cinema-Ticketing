let movieDetail = {}
let movieCookie = getCookie("movieDetails");
if(movieCookie) {
    movieDetail = JSON.parse(movieCookie);
}



document.addEventListener("DOMContentLoaded", () =>{
    console.log(movieDetail);
})



