function dateConvert(value) {
  const date = new Date(value);

  const weekday = date.toLocaleDateString("en-US", { weekday: "long" });
  const day = date.getDate();
  let month = date.toLocaleDateString("en-US", { month: "short" });
  if (month === "Sep") month = "Sept";
  const year = date.getFullYear();

  return `${weekday}, ${day} ${month} ${year}`;
}
function today(add) {
  const today = new Date();
  today.setDate(today.getDate() + add);

  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, "0");
  const dd = String(today.getDate()).padStart(2, "0");

  return `${yyyy}-${mm}-${dd}`;
}

function getSelectedTime(time,date,quality){
  let selectedTime = document.getElementById(time).textContent.trim();
  let selectedDate = document.getElementById(date).textContent.trim();
  let selectedQuality = document.getElementById(quality).textContent.trim();
  document.cookie = "selectedtime=" + selectedTime + "; path=/; max-age=3600";
  document.cookie = "selecteddate=" + selectedDate + "; path=/; max-age=3600";
  document.cookie = "selectedquality=" + selectedQuality + "; path=/; max-age=3600";
  window.location.href =
    "../cinema_pages/tickets.php";
}
function getSelectedTime(time,date,quality,title){
  let selectedTime = document.getElementById(time).textContent.trim();
  let selectedDate = document.getElementById(date).textContent.trim();
  let selectedQuality = document.getElementById(quality).textContent.trim();
  document.cookie = "selectedtime=" + selectedTime + "; path=/; max-age=3600";
  document.cookie = "selecteddate=" + selectedDate + "; path=/; max-age=3600";
  document.cookie = "selectedquality=" + selectedQuality + "; path=/; max-age=3600";
  document.cookie = "movietitle=" + title + "; path=/; max-age=3600";
  window.location.href =
    "../cinema_pages/tickets.php";
}


document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".imaxDate").forEach((el) => {
    el.textContent = dateConvert(today(2));
  });
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".twodDate").forEach((el) => {
    el.textContent = dateConvert(today(0));
  });
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dcDate").forEach((el) => {
    el.textContent = dateConvert(today(1));
  });
});
