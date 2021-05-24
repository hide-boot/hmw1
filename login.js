const form=document.querySelector('form');

const username=form.querySelector('input[name="user"]');
username.addEventListener('blur',UserTrue);
const pass=form.querySelector('input[name="password"]');
pass.addEventListener('blur',PassTrue);

const button=document.querySelector('.buttom');

button.disabled = true;

const check=document.querySelector('.confirm')



if(document.querySelectorAll('.error')!==null){
    Checkform();
    
}
function Checkform(){
  
    if(username.value.length!==0&&
    pass.value.length!==0){
       
        button.disabled = false;
    }

}


function UserTrue(event){ 
    

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(event.target.value)){
        if(event.target.parentNode.querySelector('.error')===null){
        const e= document.createElement('p');
        e.classList.add('error');
        e.textContent="Inserire qualcosa o Non utilizzare caratteri speciali";
        event.target.parentNode.append(e);
        
        }
        else{
            event.target.parentNode.querySelector('.error').textContent="Inserire qualcosa o Non utilizzare caratteri speciali";

        }
      

    }
    else{
        if(event.target.parentNode.querySelector('.error')!==null){
            event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));
        }
    
    }
    Checkform();
}
function PassTrue(event){
    if(event.target.value.length<8){
        if(event.target.parentNode.querySelector('.error')===null){
        const e= document.createElement('p');
        e.classList.add('error');
        e.textContent="password troppo corta";
        event.target.parentNode.append(e);
        }
       

    }
    else{
        if(event.target.parentNode.querySelector('.error')!==null){
            event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));
        }
    }
    Checkform();
   

}
function OnResponce(responce){
    if(!responce.ok){
        return null;
    }
    return responce.json();
}

