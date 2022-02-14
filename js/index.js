document.getElementById("nav_open").addEventListener("click", () =>{
    document.querySelector(".navbar_links").classList.toggle("open");
})


const left = document.getElementById('left') ;
const right = document.getElementById('right') ;
const inputToRemove = document.querySelectorAll('.to_remove') ;
const welcom = document.querySelector(".welcom_container");
const formContainer = document.querySelector(".form_container");
const form = document.querySelector(".form_container form")
const leftText = ["Re Bonjour !","Pour pouvoir acceder a toutes les fonctionalite du site veuillez vous connecter","Se connecter"] ;
const rightText = ["Bienvenue" ,"Inscriver vous afin de rejoindre notre beau site","S'inscrire" ] ;
let leftTurn = true ;
const connectButton = document.getElementById('connect') ;

connectButton.addEventListener("click" , () => {
    left.classList.toggle("moveL");
    right.classList.toggle("moveR");
    swapText(leftTurn) ;
    leftTurn = !leftTurn ;
    changeForm ();
});
function swapText(leftTur) {
	if (leftTur){
        welcom.classList.add('opaci');
		for (var i = 0; i < welcom.children.length; i++) {
            welcom.children[i].textContent = rightText[i];
		}
        welcom.addEventListener('animationend',function() {
            welcom.classList.remove('opaci');
            welcom.style.animation = "";
        });
        changeFormText("Se connecter", "Connecter", "Connecter")
	}
    else{
        welcom.classList.add('opaci');
		for (var i = 0; i < welcom.children.length; i++) {
			welcom.children[i].textContent = leftText[i] ;
		}
        changeFormText("Creer", "Creer un compte", "Creer");
        welcom.addEventListener('animationend',function() {
            welcom.classList.remove('opaci');
            welcom.style.animation = "";
        });
	}
}
function changeFormText(name, title, inputName){
    formContainer.lastElementChild.lastElementChild.textContent = name ;
    formContainer.firstElementChild.textContent = title;
    formContainer.lastElementChild.lastElementChild.setAttribute("name", inputName) ;
}
function changeForm () {
    formContainer.classList.add('opaci2');
	inputToRemove.forEach(input =>{
        input.classList.toggle("hide");
        input.required = leftTurn ;
    })
    formContainer.addEventListener('animationend',function() {
        formContainer.classList.remove('opaci2');
        formContainer.style.animation = "";
    });
}
