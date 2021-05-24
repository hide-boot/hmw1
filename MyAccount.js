fetch('prefer.php').then(onResponce).then(onFilmP);
fetch('prefer_serie.php').then(onResponce).then(onSerieP);
fetch('prefer_anime.php').then(onResponce).then(onAnimeP);


function onResponce(responce){
    if(!responce.ok){
        return null;
    }
    if(responce===null){
        return null;
    }
    return responce.json();
}

function onFilmP(json){
    for(let i=0;i<json.length;i++){
       
        
        const uri=encodeURI(json[i]);
        fetch("api_film.php?q="+uri+"&m=t&type=f").then(onResponce).then(PreferFilm);
    }

}



function onSerieP(json){

    for(let i=0;i<json.length;i++){
        const uri=encodeURI(json[i]);
       
       
        fetch("api_film.php?q="+uri+"&m=t&type=s").then(onResponce).then(PreferSerie);
    }

}





function onAnimeP(json){
    for(let i=0;i<json.length;i++){
        const uri=encodeURI(json[i]);
        
        fetch('animepref.php?q='+uri+'&type=t').then(onResponce).then(PreferAnime);
      
    }
}

function PreferAnime(json){
    

    const prefer=document.querySelector('.prefer');
    
const div=document.createElement('div');
div.classList.add('isflex');
const img=document.createElement('img');
img.classList.add('image');
img.src=json[0].posterImage.small;
img.addEventListener('click',Modal);
div.appendChild(img);
const title=document.createElement('h4');
title.classList.add('titlef');
title.textContent=json[0].canonicalTitle;
div.appendChild(title);
const prefimg=document.createElement('img');
prefimg.classList.add('prefimg');
prefimg.src='https://www.wallpaperuse.com/wallp/86-863477_m.jpg';
div.appendChild(prefimg);

prefimg.addEventListener('click',removeAnime);
prefer.appendChild(div);

}




function PreferFilm(json){
  
    const prefer=document.querySelector('.prefer');
    
    const div=document.createElement('div');
    div.classList.add('isflex');
    const img=document.createElement('img');
    img.classList.add('image');
    img.src=json.Poster;
    img.addEventListener('click',Modal);
    div.appendChild(img);
    const title=document.createElement('h4');
    title.classList.add('titlef');
    title.textContent=json.Title;
    div.appendChild(title);
    const prefimg=document.createElement('img');
    prefimg.classList.add('prefimg');
    div.appendChild(prefimg);
    prefimg.src='https://www.wallpaperuse.com/wallp/86-863477_m.jpg';
    prefimg.addEventListener('click',removeFilm);
    prefer.appendChild(div);
}

function PreferSerie(json){
  
 const prefer=document.querySelector('.prefer');
    
const div=document.createElement('div');
div.classList.add('isflex');
const img=document.createElement('img');
img.classList.add('image');
img.src=json.Poster;
img.addEventListener('click',Modal);
div.appendChild(img);
const title=document.createElement('h4');
title.classList.add('titlef');
title.textContent=json.Title;
div.appendChild(title);
const prefimg=document.createElement('img');
prefimg.classList.add('prefimg');
prefimg.src='https://www.wallpaperuse.com/wallp/86-863477_m.jpg';
div.appendChild(prefimg);
prefimg.addEventListener('click',removeSerie);
prefer.appendChild(div);
      
    
}




function removeSerie(event) {
   const prefer= document.querySelector('.prefer');
   prefer.removeChild(event.currentTarget.parentNode);
   const formdata=new FormData;
   
   formdata.append("title",event.currentTarget.parentNode.querySelector('h4').textContent);
   fetch('delprefer_serie.php',{
       method:'post',
       body:formdata
   }).then(onRes)
}

function removeFilm(event) {
    const prefer= document.querySelector('.prefer');
    prefer.removeChild(event.currentTarget.parentNode);
    const formdata=new FormData;
   
    formdata.append("title",event.currentTarget.parentNode.querySelector('h4').textContent);
    fetch('delprefer.php',{
        method:'post',
        body:formdata
    }).then(onRes)
 }

 function removeAnime(event) {
    const prefer= document.querySelector('.prefer');
    prefer.removeChild(event.currentTarget.parentNode);
    const formdata=new FormData;
   
    formdata.append("title",event.currentTarget.parentNode.querySelector('h4').textContent);
    fetch('delprefer_anime.php',{
        method:'post',
        body:formdata
    }).then(onRes)
    
 }

 function Modal(event){
    const sec=document.querySelector('.no-w');
    const im=document.createElement('img');
    sec.appendChild(im);
    sec.style.top=window.pageYOffset+'px';
    im.src=event.currentTarget.src;
    sec.classList.remove('no-w');
    sec.classList.add('modal-view');
  
    document.body.classList.add('no-scroll');
   im.addEventListener('click',removeModal);


}

function removeModal(event){
    event.currentTarget.removeEventListener('click',removeModal);
    const sec=document.querySelector('.modal-view');
    
    sec.removeChild(event.currentTarget);
    sec.classList.add('no-w');
    sec.classList.remove('modal-view');
    document.body.classList.remove('no-scroll');
    
}



function onRes(responce){
    if(responce.ok){
        return 'error'
    }
}