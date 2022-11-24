let aviso = document.querySelector('.aviso');

showAviso();

function showAviso(){
    if(aviso.getAttribute('data-type') == 'ok' || aviso.getAttribute('data-type') == 'alert'){
        aviso.style.display = 'flex';
        aviso.classList.add(aviso.getAttribute('data-type'));

        setTimeout(()=>{
            aviso.style.display = 'none';
            aviso.classList.remove(aviso.getAttribute('data-type'));
        }, 3000);
    } 
}

//Controle de atualização do novel
let nivel = document.querySelector('.form-campos input[type="range"]');
let nivelLabelSpan = document.querySelector('.form-campos label span');

nivel.addEventListener('change', atualizaNivelSpan);

function atualizaNivelSpan(){
    nivelLabelSpan.innerHTML = nivel.value;
}

//Criei um evento e função para limitar a quatidade de caractere do campo textarea
document.querySelector('.form-campos textarea').addEventListener('keydown', limitaCaractere);

function limitaCaractere(){
    let couterAtual  = document.querySelector('.form-campos textarea').value.length;
    let couterMax = document.querySelector('.form-campos textarea').maxLength;
    let valor = document.querySelector('.form-campos textarea').value;

    if(couterAtual > couterMax){
        let transformaArray  = valor.split('');
        transformaArray.pop();

        let traformaString = transformaArray.join('');

        valor = traformaString;
    }
}