window.onload = init();

function init(){
    document.getElementById('logo').addEventListener('click', jiggle);
    document.getElementById('bucket').addEventListener('click', jiggle);
}

function jiggle(event){
    let target = event.target;
        target.classList.add('jiggle');
        setTimeout(()=>{
            target.classList.remove('jiggle');
        },200);
}