const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button"),
blurEffect = document.querySelector(".blur-effect"),
popUp = document.querySelector(".popup-box"),
shortenedLink = popUp.querySelector("input");

form.onsubmit = (e) => {
    e.preventDefault();
}

blurEffect.onclick = () => {
    blurEffect.style.display = "none";
    popUp.classList.toggle("show");
}


shortenBtn.onclick = () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/url-controll.php", true);
    xhr.onload = () => {
        if(xhr.readyState === 4 && xhr.status === 200){
            const data = xhr.response;
            if(data.length <= 5){
                blurEffect.style.display="block";
                popUp.classList.add("show");
                let domain = "localhost/url?u="
                shortenedLink.value = domain + data;
            }else{
                alert(data)
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}