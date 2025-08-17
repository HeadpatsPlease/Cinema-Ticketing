
        const qual = document.querySelectorAll(".quality-btn");
        const beverage = document.querySelectorAll(".beverage-btn");
        const movies = document.querySelectorAll(".movies");
        const next = document.getElementById('next');


        let collect = {};
        let selectedQuality = [];
        collect['quality'] = selectedQuality;
        let selectedbeverage = [];
        collect['beverage'] = selectedbeverage;
        let selectedmovies = [];
        collect['movies'] = selectedmovies;
        

        next.addEventListener('click',(e)=>{
            if(selectedQuality.length == 0 || selectedbeverage.length == 0 || selectedmovies.length == 0){
                e.preventDefault();
                alert("Missing options");
            }
            else{
                window.location.href = 'view.php';
            }
        })


       
        qual.forEach((sts) => {
            sts.addEventListener("click", (e) => {
                sts.classList.toggle("active");
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
        beverage.forEach((st) => {
            st.addEventListener("click", (e) => {
                if(selectedbeverage.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedbeverage.push(e.target.textContent.trim());
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedbeverage.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedbeverage.splice(index, 1);
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