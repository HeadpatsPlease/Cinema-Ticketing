const cash = document.querySelectorAll('.cardpay');
const epay = document.querySelectorAll('.epay');
let method;
document.addEventListener('DOMContentLoaded',()=>{
    setCookie('method','epay');
})
cash.forEach((cp)=>{
    cp.addEventListener('click',()=>{
        setCookie('method','cardpay');
    })
})
epay.forEach((ep)=>{
    ep.addEventListener('click',()=>{
        setCookie('method','epay');
    })
})

document.getElementById("nextBtn").addEventListener("click", () => {
  window.location.href = "payment.php";
});
