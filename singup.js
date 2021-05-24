const form=document.querySelector('.form');
const nome=form.querySelector('input[name="name"]');

nome.addEventListener('blur',NameTrue);
const surname=form.querySelector('input[name="surname"]');
surname.addEventListener('blur',NameTrue);
const email=form.querySelector('input[name="email"]');
email.addEventListener('blur',EmailTrue);
const username=form.querySelector('input[name="user"]');
username.addEventListener('blur',UserTrue);
const pass=form.querySelector('input[name="password"]');
pass.addEventListener('blur',PassTrue);
const confpass=form.querySelector('input[name="confpass"]');
confpass.addEventListener('blur',itstrue);

const button=document.querySelector('.sinbutton');

button.disabled = true;

const check=document.querySelector('.confirm')



if(document.querySelectorAll('.error')!==null){
    Checkform();
    
}

function Checkform(){
  
    if(nome.value.length!==0&&surname.value.length!==0&&email.value.length!==0&&username.value.length!==0&&
    pass.value.length!==0&&confpass.value.length!==0&&check.checked){
       
        button.disabled = false;
    }

}
function NameTrue(event){
   
   if(event.target.value.length>0){
    if(event.target.parentNode.querySelector('.error')!==null){
        
        event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));
    }
    }
    else{
        if(event.target.parentNode.querySelector('.error')===null){
        const e= document.createElement('p');
        e.classList.add('error');
        e.textContent="inserire qualcosa";
        event.target.parentNode.append(e);
        }
    }
    Checkform()
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
    fetch("usertrue.php?q="+encodeURIComponent(event.target.value)).then(OnResponce).then(ExistUser);
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
        event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));

    }
    Checkform();
   

}
function itstrue(event){
    if(event.target.value.length<8){
        if(event.target.parentNode.querySelector('.error')===null){
        const e= document.createElement('p');
        e.classList.add('error');
        e.textContent="password troppo corta";
        event.target.parentNode.append(e);
        }
       

    }
    else{
    
        if(event.target.value===pass.value){
            if(event.target.parentNode.querySelector('.error')!==null){
                event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));
            }
          
        }
       else{
           if(event.target.parentNode.querySelector('.error')===null){
            const er= document.createElement('p');
            er.classList.add('error');
            er.textContent="password non corrispondente a password di conferma";
            event.target.parentNode.append(er);
           }
           else{
               const er=event.target.parentNode.querySelector('.error');
               er.textContent="password non corrispondente a password di conferma";
           }
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
function ExistUser(json){
    if(json.exist){
        if(username.parentNode.querySelector('.error')===null){
            const e= document.createElement('p');
            e.classList.add('error');
            e.textContent="Username già in uso";
            username.parentNode.append(e);
        }
        else{
            username.parentNode.querySelector('.error').textContent="Username già in uso";
        }

    }

}
function EmailTrue(event){
    if(!/^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/.test(event.target.value)){
        if(event.target.parentNode.querySelector('.error')===null){
        const e= document.createElement('p');
        e.classList.add('error');
        e.textContent="Inserire qualcosa o Non utilizzare caratteri speciali non validi";
        event.target.parentNode.append(e);

        }
        else if(event.target.parentNode.querySelector('.error')!==null){
            event.target.parentNode.querySelector('.error').textContent="Inserire qualcosa o Non utilizzare caratteri speciali non validi";

        }
    }
    else{
        if(event.target.parentNode.querySelector('.error')!==null){
        event.target.parentNode.removeChild( event.target.parentNode.querySelector('.error'));
    }
    fetch("emailtrue.php?q="+encodeURIComponent(event.target.value)).then(OnResponce).then(ExistEmail);
    }

}
function ExistEmail(json){
    if(json.exist){
        if(email.parentNode.querySelector('.error')===null){
            const e= document.createElement('p');
            e.classList.add('error');
            e.textContent="Username già in uso";
            email.parentNode.append(e);
        }
        else{
            email.parentNode.querySelector('.error').textContent="Username già in uso";
        }
    }
   
}

