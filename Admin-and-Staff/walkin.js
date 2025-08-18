const qty = document.querySelectorAll("#qty");
        const qual = document.querySelectorAll(".quality-btn");
        const cine = document.querySelectorAll(".cinema-btn");
        const beverage = document.querySelectorAll(".beverage-btn");
        const movies = document.querySelectorAll(".movies");
        const next = document.getElementById('next');

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        let refNo =
            getRandomInt(10, 999) +
            "-" +
            getRandomInt(10, 999) +
            "-" +
            getRandomInt(10, 999);

        document.addEventListener('DOMContentLoaded',()=>{
            document.getElementById('ref').textContent ="Ref No. " + refNo;
        })
        let p = 0;
        let collect = {};
        let selectedQuality = [];
        collect['quality'] = selectedQuality;
        let selectedmovies = [];
        collect['movies'] = selectedmovies;
        collect['reference'] = refNo;
        let selectcinema = [];
        collect['cine'] = selectcinema;

        
        
        

        next.addEventListener('click',(e)=>{
            if(selectedQuality.length == 0 || selectedbeverage.length == 0 || selectedmovies.length == 0){
                e.preventDefault();
                alert("Missing options");
            }
            else{
                window.location.href = 'view.php';
            }
            })
            
            const addQty = document
            .getElementById("add")
            .addEventListener("click", () => {
                qty.forEach((el) => {
                let currentqty = parseInt(el.textContent);
                    if(selectedQuality.find(qual => qual === "IMAX" ) === "IMAX"){
                        p = 450;
                    }else if(selectedQuality.find(qual => qual === "Directors Club" ) === "Directors Club"){
                        p= 350;
                    }else if(selectedQuality.find(qual => qual === "2D" ) === "2D"){
                        p= 250;
                    }
                    currentqty++;
                    el.textContent = currentqty;
                    ticketPrice = currentqty * p;
                    collect['price'] = ticketPrice;
                    console.log(collect);
                    
                
                });
            });
            const reduceQty = document
            .getElementById("minus")
            .addEventListener("click", () => {
                qty.forEach((el) => {
                let currentqty = parseInt(el.textContent);
                if (currentqty > 1) {
                    if(selectedQuality.find(qual => qual === "IMAX" ) === "IMAX"){
                        p = 450;
                    }else if(selectedQuality.find(qual => qual === "Directors Club" ) === "Directors Club"){
                        p= 350;
                    }else if(selectedQuality.find(qual => qual === "2D" ) === "2D"){
                        p= 250;
                    }
                    currentqty--;
                    el.textContent = currentqty;
                    ticketPrice = currentqty * p;
                    collect['price'] = ticketPrice;
                    console.log(collect);
                }
                });
            });

       
        qual.forEach((sts) => {
            sts.addEventListener("click", (e) => {
                if(selectedQuality.length < 1){
                    sts.classList.toggle("active");
                }else{
                    sts.classList.remove("active");
                }
                
                if (e.target.classList.contains("active")){
                    selectedQuality.push(e.target.textContent.trim())
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedQuality.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedQuality.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        
        movies.forEach((rt) => {
            rt.addEventListener("click", (e) => {
                if(selectedmovies.length < 1){
                    rt.classList.toggle("active");
                }else{
                    rt.classList.remove("active");
                }
                if (e.currentTarget.classList.contains("active")){
                    selectedmovies.push(e.currentTarget.dataset.info);
                    setCookie('selectedInfo',JSON.stringify(collect));
                    console.log(selectedmovies);
                    
                }else{
                    const index = selectedmovies.indexOf(e.currentTarget.dataset.info);
                    if (index !== -1) {
                        selectedmovies.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        cine.forEach((sts) => {
            sts.addEventListener("click", (e) => {
                if(selectcinema.length < 1){
                    sts.classList.toggle("active");
                }else{
                    sts.classList.remove("active");
                }
                
                if (e.target.classList.contains("active")){
                    selectcinema.push(e.target.textContent.trim())
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectcinema.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectcinema.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });