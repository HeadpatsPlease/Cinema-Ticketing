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
        const information = JSON.parse(getCookie('info'));

        console.log(information);

        let prsgenre = [];
        let prsquality = [];
        let prscinema = [];
        let prslocation = [];
        let prstime = [];
        let prsdirector = [];
        let prsrating = [];
        let prsstatus = [];

        for (let index = 0; index < information.genre.length; index++) {
            prsgenre.push(information.genre[index]);
        }
        for (let index = 0; index < information.quality.length; index++) {
            prsquality.push(information.quality[index]);
        }
        for (let index = 0; index < information.cinema.length; index++) {
            prscinema.push(information.cinema[index]);
        }
        for (let index = 0; index < information.location.length; index++) {
            prslocation.push(information.location[index]);
        }
        for (let index = 0; index < information.time.length; index++) {
            prstime.push(information.time[index]);
        }
        prsdirector.push(information.director);
        prsrating.push(information.rating);
        prsstatus.push(information.status);


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
        
        
        document.getElementById('movie-title').value = information.name;
        document.getElementById('year').value = information.year;
        document.getElementById('synopsis').value = information.desc;
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
            let picked = st.textContent.trim();
            if(prslocation.includes(picked.trim())){
                st.classList.add("active");
                selectedLocation.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            st.addEventListener("click", (e) => {
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedLocation.push(e.target.textContent.trim());
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedLocation.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedLocation.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });

        genres.forEach((st) => {
            let picked = st.textContent.trim();
            if(prsgenre.includes(picked.trim())){
                st.classList.add("active");
                selectedGenre.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            st.addEventListener("click", (e) => {
                
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedGenre.push(e.target.textContent.trim());
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedGenre.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedGenre.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        time.forEach((st) => {
            let picked = st.textContent.trim();
            if(prstime.includes(picked.trim())){
                st.classList.add("active");
                selectedTime.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            st.addEventListener("click", (e) => {
                st.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedTime.push(e.target.textContent.trim())
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedTime.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedTime.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        qual.forEach((sts) => {
            let picked = sts.textContent.trim();
            if(prsquality.includes(picked.trim())){
                sts.classList.add("active");
                selectedQuality.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            sts.addEventListener("click", (e) => {
                sts.classList.toggle("active");
                if (e.target.classList.contains("active")){
                    selectedQuality.push(e.target.textContent.trim())
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedQuality.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedQuality.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        cinema.forEach((st) => {
            let picked = st.textContent.trim();
            if(prscinema.includes(picked.trim())){
                st.classList.add("active");
                selectedCinema.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            st.addEventListener("click", (e) => {
                if(selectedCinema.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedCinema.push(e.target.textContent.trim());
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedCinema.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedCinema.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        direct.forEach((st) => {
            let picked = st.textContent.trim();
            if(prsdirector.includes(picked.trim())){
                st.classList.add("active");
                selectedDirector.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
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
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedDirector.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedDirector.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });
        statuse.forEach((st) => {
            let picked = st.textContent.trim();
            if(prsstatus.includes(picked.trim())){
                st.classList.add("active");
                selectedStatus.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            st.addEventListener("click", (e) => {
                if(selectedStatus.length < 1){
                    st.classList.toggle("active");
                }else{
                    st.classList.remove("active");
                }
                if (e.target.classList.contains("active")){
                    selectedStatus.push(e.target.textContent.trim())
                    setCookie('updatingInfo',JSON.stringify(collect));
                }else{
                    const index = selectedStatus.indexOf(e.target.textContent.trim());
                    if (index !== -1) {
                        selectedStatus.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }

                
            });
        });
        rating.forEach((rt) => {
            let picked = rt.dataset.info;
            if(prsrating.includes(picked)){
                rt.classList.add("active")
                selectedRating.push(picked);
                setCookie('updatingInfo',JSON.stringify(collect));
            }
            rt.addEventListener("click", (e) => {
                if(selectedRating.length < 1){
                    rt.classList.toggle("active");
                }else{
                    rt.classList.remove("active");
                }
                if (e.currentTarget.classList.contains("active")){
                    selectedRating.push(e.currentTarget.dataset.info);
                    setCookie('updatingInfo',JSON.stringify(collect));
                    console.log(selectedRating);
                    
                }else{
                    const index = selectedRating.indexOf(e.currentTarget.dataset.info);
                    if (index !== -1) {
                        selectedRating.splice(index, 1);
                        setCookie('updatingInfo',JSON.stringify(collect));
                    }
                }
                
            });
        });

        