const beverages = [
  { id: 1, name: "Popcorn Regular", description: "1 Popcorn Regular", price: 100, img: "../images/POPCORN-Regular.png" },
  { id: 2, name: "Popcorn Large", description: "1 Popcorn Large", price: 150, img: "../images/POPCORN-Large.png" },
  { id: 3, name: "Popcorn Bucket", description: "1 Popcorn Bucket", price: 200, img: "../images/POPCORN-Bucket.png" },
  { id: 4, name: "Soda Regular", description: "1 Regular Soda", price: 75, img: "../images/SODA-Regular.png" },
  { id: 5, name: "Soda Large", description: "1 Large Soda", price: 100, img: "../images/SODA-Large.png" },
  { id: 6, name: "Hotdog Sandwich", description: "1 Hotdog Sandwich", price: 100, img: "../images/HOTDOG SANDWICH.png" },
  { id: 7, name: "Combo 1", description: "1 Popcorn Bucket & 1 Large Soda", price: 250, img: "../images/COMBO 1.png" },
  { id: 8, name: "Combo 2", description: "1 Popcorn Bucket & 2 Large Soda", price: 300, img: "../images/COMBO 2.png" }
];
let movieDetail = {}
let movieCookie = getCookie("movieDetails");
if(movieCookie) {
    movieDetail = JSON.parse(movieCookie);
}

let basket = {};
let baseCost = movieDetail['ticketTotal'];
let chosenBeverage = [];


function updateBasket() {
  console.log(movieDetail);
  
  const basketList = document.getElementById("basket-items");
  basketList.innerHTML = '';
  let total = baseCost;
  for (let id in basket) {
    const item = beverages.find(b => b.id == id);
    const qty = basket[id];
    const cost = qty * item.price;
    total += cost;
    const li = document.createElement("li");
    li.textContent = `${item.name} - ${qty} - ₱${cost}`;
    basketList.appendChild(li);
    chosenBeverage[id] = li.textContent;
    movieDetail["beverages"] = chosenBeverage;
  }
  document.getElementById("total-cost").textContent = total;
  movieDetail['ticketTotal'] = total;
  
}

document.getElementById("nextBtn").addEventListener("click",() => {
    setCookie("movieDetails",JSON.stringify(movieDetail));
    window.location.href = "payment.php";
})

function changeQty(id, change) {
  if (!basket[id]) {
    basket[id] = 0;
  }
  basket[id] += change;
  if (basket[id] <= 0) {
    delete basket[id];
    chosenBeverage[id] = null;
    movieDetail["beverages"] = 0;
  }
  updateBasket();
  document.getElementById(`qty-${id}`).textContent = basket[id] || 0;
  movieDetail['beverageID'] = basket;
}

function renderItems() {
  const container = document.getElementById("beverage-list");
  beverages.forEach(item => {
    const col = document.createElement("div");
    col.className = "col";
    col.innerHTML = `
      <div class="beverage-card w-100 h-100">
        <img src="${item.img}" alt="${item.name}"/>
        <div class="beverage-info">
            <h5 class="roboto-bold">${item.name}</h5>
          <p class="roboto-medium">${item.description || ''}</p>
          <h2 class="price roboto-bold">₱${item.price}</h2>
        </div>
        <div class="qty-buttons">
          <button class="qty-btn" style="color: #ff4d00; background-color: white;" onclick="changeQty(${item.id}, -1)">–</button>
          <span id="qty-${item.id}" style="background-color: #ff4d00;">0</span>
          <button class="qty-btn" style="color: #ff4d00; background-color: white;" onclick="changeQty(${item.id}, 1)">+</button>
        </div>
      </div>
    `;
    container.appendChild(col);
  });
}
renderItems();
updateBasket();