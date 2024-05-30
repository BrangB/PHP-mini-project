const form = document.querySelector(".form1"); // Use querySelector to select by ID
const statusText = document.querySelector(".statusText"); // Use querySelector to select by ID

form.addEventListener("submit", (e) => { // Use addEventListener to attach event handlers
    e.preventDefault();
    statusText.style.display = "block";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "message.php", true);
    xhr.onload = () => {
        if(xhr.readyState == 4 && xhr.status == 200){
            let response = xhr.response;
            statusText.innerHTML = response;
            if(response.indexOf("Email or Message field is required") != -1 || response.indexOf("Sorry!! Failed to send Message") != -1){
                statusText.style.color = "red";
            }else{
                form.reset();
                setTimeout(() => {
                    statusText.style.display = "none";
                }, 3000);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
});
