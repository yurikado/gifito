var toggle = document.getElementById('container');
var body = document.querySelector('body');

//genera la accion del boton de toggle para cambiar tanto en body como en container
toggle.onclick = function(){
    toggle.classList.toggle('active');
    body.classList.toggle('active');
}