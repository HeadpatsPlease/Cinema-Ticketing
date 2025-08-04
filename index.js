const comingSoonButton = document.getElementById("comingSoonButton");
const nowShowingButton = document.getElementById("nowShowingButton");
const nowShowingPage = document.getElementById("nowShowing");
const comingSoonPage = document.getElementById("comingSoon");

comingSoonButton.addEventListener("click", () => {
    comingSoonPage.classList.remove("d-none");
    comingSoonButton.classList.add("active");
    nowShowingPage.classList.add("d-none");
    nowShowingButton.classList.remove("active");
});
nowShowingButton.addEventListener("click", () => {
    nowShowingPage.classList.remove("d-none");
    nowShowingButton.classList.add("active");
    comingSoonPage.classList.add("d-none");
    comingSoonButton.classList.remove("active");
});

function getTitle(title){
    let movieTitle = document.getElementById(title).textContent.trim()
    document.cookie = "movietitle=" + movieTitle+ "; path=/; max-age=3600";
}