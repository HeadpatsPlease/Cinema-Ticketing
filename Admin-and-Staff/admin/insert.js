        const genres = document.querySelectorAll(".genre-btn");
        const time = document.querySelectorAll(".time-btn");
        const qual = document.querySelectorAll(".quality-btn");
        const cinema = document.querySelectorAll(".cinema-btn");
        const direct = document.querySelectorAll(".director-btn");
        const statuse = document.querySelectorAll(".status-btn");
        const rating = document.querySelectorAll(".rating");
        const locations = document.querySelectorAll(".location-btn");
        const next = document.getElementById('next');
        const imgupload = document.getElementById('imginput');
        const customDirector = document.getElementById('customDirector');


        let collect = {};
        let selectedGenre = [];
        collect['genre'] = selectedGenre;
        let selectedTime = [];
        collect['time'] = selectedTime;
        let selectedQuality = [];
        collect['quality'] = selectedQuality;
        let selectedCinema = [];
        collect['cinema'] = selectedCinema;
        let selectedDirector = [];
        collect['director'] = selectedDirector;
        let selectedStatus = [];
        collect['status'] = selectedStatus;
        let selectedRating = [];
        collect['rating'] = selectedRating;
        let selectedLocation = [];
        collect['location'] = selectedLocation;
        

        imgupload.addEventListener('change',function(){
            const file = this.files[0];
            if (file) {
                const preview = document.getElementById("poster");
                preview.src = URL.createObjectURL(file);
            }
        })

        next.addEventListener('click',(e)=>{
            if(selectedGenre.length == 0 || selectedTime.length == 0 || selectedQuality.length == 0 || selectedCinema.length == 0 || selectedStatus.length == 0 || selectedRating.length == 0 || selectedLocation == 0){
                e.preventDefault();
                alert("Missing options");
            }
            else{
                window.location.href = 'view.php';
            }
        })

        locations.forEach((st) => {
            st.addEventListener("click", (e) => {
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedLocation.push(e.target.textContent.trim());
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedLocation.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedLocation.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });

        genres.forEach((st) => {
            st.addEventListener("click", (e) => {
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedGenre.push(e.target.textContent.trim());
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedGenre.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedGenre.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        time.forEach((st) => {
            st.addEventListener("click", (e) => {
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedTime.push(e.target.textContent.trim())
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedTime.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedTime.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
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
        cinema.forEach((st) => {
            st.addEventListener("click", (e) => {
                if(selectedCinema.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedCinema.push(e.target.textContent.trim());
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedCinema.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedCinema.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        direct.forEach((st) => {
            st.addEventListener("click", (e) => {
                if(customDirector.value.trim().length > 0){
                    return;
                }
                else if(selectedDirector.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedDirector.push(e.target.textContent.trim())
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedDirector.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedDirector.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        statuse.forEach((st) => {
            st.addEventListener("click", (e) => {
                if(selectedStatus.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedStatus.push(e.target.textContent.trim())
                    setCookie('selectedInfo',JSON.stringify(collect));
                }else{
                    const index = selectedStatus.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedStatus.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        rating.forEach((rt) => {
            rt.addEventListener("click", (e) => {
                if(selectedRating.length < 1){
                    rt.classList.toggle("active");
                }else{
                    rt.classList.remove("active");
                }
                if (e.currentTarget.classList.contains("active")){
                    selectedRating.push(e.currentTarget.dataset.info);
                    setCookie('selectedInfo',JSON.stringify(collect));
                    console.log(selectedRating);
                    
                }else{
                    const index = selectedRating.indexOf(e.currentTarget.dataset.info);
                    if (index !== -1) {
                        selectedRating.splice(index, 1);
                        setCookie('selectedInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });