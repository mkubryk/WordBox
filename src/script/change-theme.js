const btnTheme = document.getElementById("theme");
const body = document.body;

const currentTheme = localStorage.getItem("theme");

if (currentTheme === "sombre") {
    body.classList.add("theme-sombre");
}

btnTheme.addEventListener("click", ()=> {
    body.classList.toggle("theme-sombre");
    if(body.classList.contains("theme-sombre"))
        localStorage.setItem("theme", "sombre");
    else 
        localStorage.setItem("theme", "clair");
})

