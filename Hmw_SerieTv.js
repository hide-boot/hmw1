fetch('prefer_serie.php').then(onResponce).then(onPrefer);



const input=document.querySelector("form");
input.addEventListener('submit',search);



fetch("api_film.php?q=game+of+thrones&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=breaking+bad&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=lost&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=ozark&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=away&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=rain&m=s&type=s").then(onResponce).then(onSearch);
fetch("api_film.php?q=money+heist&m=s&type=s").then(onResponce).then(onSearch);

function onResponce(responce)
{
    if(!responce.ok){
       
        return null;
    }
   
    return responce.json();
}






function search(event)
{
   
    event.preventDefault();
    const contents=document.querySelector('.contents');
    if(contents.childElementCount!==0)
    {
        contents.innerHTML='';
    }
    const value=document.querySelector('input').value;

    
  
    if(value==='')
    { contents.classList.remove('direction');


    fetch("api_film.php?q=game+of+thrones&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=breaking+bad&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=lost&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=ozark&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=away&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=rain&m=s&type=s").then(onResponce).then(onSearch);
    fetch("api_film.php?q=money+heist&m=s&type=s").then(onResponce).then(onSearch);
    }
    else
    {
        if(contents.childElementCount!==0){
            contents.innerHTML='';
        }
        const valuecode=encodeURIComponent(value);
        const link= encodeURI("api_film.php?q="+valuecode+"&m=s&type=s")
        fetch(link).then(onResponce).then(onSearch);
       
    
    }

}




  
   function onSearch(json)
{
    const contents=document.querySelector('.contents');
    contents.classList.add('direction');
    
  for(let i=0;i<json.Search.length;i++){
    if(json.Search[i].Poster==="N/A"){break;}
      
    const div =document.createElement('div');
    div.classList.add('isflex');
   
    
    const image=document.createElement('img');
    image.src=json.Search[i].Poster;
    image.classList.add('image');
    image.addEventListener('click',Modal);
    div.appendChild(image);
    const content=document.createElement('div');
    const title=document.createElement('h4');
    title.textContent=json.Search[i].Title;
    
    title.classList.add('pfilm');
    content.appendChild(title);
    
    const year=document.createElement('p');
    year.textContent=json.Search[i].Year;
    year.classList.add('pfilm');
    content.appendChild(year);
    const hidden=document.createElement('div');
    hidden.classList.add('hidden');
    hidden.classList.add('description');
    content.appendChild(hidden);
    const others=document.createElement('p');

    others.textContent="More";
    others.classList.add('mostra');
    content.appendChild(others);
    others.addEventListener('click',mostra);
    div.classList.add("more");
   content.classList.add('small'); 
    div.appendChild(content);
    const divpref=document.createElement('div');
    div.appendChild(divpref);
    const imgpref=document.createElement('img');
    imgpref.src='https://pngimg.com/uploads/like/like_PNG2.png';
    imgpref.classList.add('pref');
    divpref.appendChild(imgpref);
    imgpref.addEventListener('click',add);
    contents.appendChild(div);
    
  }
    
   }

   function mostra(event)
   {   
       const block = document.querySelectorAll('.isflex');
       const description=document.querySelectorAll('.isflex .description');
       const more= document.querySelectorAll('.mostra');
       
       for( let i=0;i<block.length;i++){
           if(more[i].textContent==='Minus'){
               more[i].textContent='More';
               more[i].removeEventListener('click',minus);
               more[i].addEventListener('click',mostra);
               block[i].classList.remove('selected');
               block[i].classList.add('more');
               more[i].parentNode.parentNode.querySelector('img').classList.remove('poster');
               description[i].innerHTML='';
              


           }

       }

       event.currentTarget.parentNode.parentNode.classList.remove('more');
       const title=event.currentTarget.parentNode.querySelector('h4').textContent;
       event.currentTarget.parentNode.parentNode.querySelector('img').classList.add('poster');
       event.currentTarget.parentNode.parentNode.classList.add('selected');
       const content=document.querySelector('.selected .description');
       content.classList.remove('hidden');
       event.currentTarget.textContent='Minus';
       event.currentTarget.removeEventListener('click',mostra);
       event.currentTarget.addEventListener('click',minus);
       
       fetch("api_film.php?q="+title+"&m=t&type=s").then(onResponce).then(onMore);


       
   }



   function minus(event){
    
    event.currentTarget.textContent='More';
    event.currentTarget.parentNode.parentNode.querySelector('img').classList.remove('poster');
    event.currentTarget.parentNode.parentNode.classList.add('more');
    document.querySelector('.selected').classList.remove('selected');
    event.currentTarget.removeEventListener('click',minus);
    event.currentTarget.addEventListener('click',mostra);
    const elimina=event.currentTarget.parentNode.querySelector('.description');
    elimina.classList.add('hidden');
    elimina.innerHTML='';
}

function onMore(json)
{
   
  
  const content=document.querySelector('.selected .description');
    
    const time=document.createElement('p');
    time.textContent="Time: "+json.Runtime;
    time.classList.add('pfilm');
    time.classList.add('description');
    content.appendChild(time);
    const description=document.createElement('p');
    description.textContent="Description: "+json.Plot;
    description.classList.add('pfilm');
    description.classList.add('description');
    content.appendChild(description);
    const actor=document.createElement('p');
    actor.textContent="Actors: "+json.Actors;
    actor.classList.add('pfilm');
    actor.classList.add('description');
    content.appendChild(actor);
    const reviewdiv=document.createElement('div');
    reviewdiv.classList.add('property');
    const comment=document.createElement('span');
    comment.textContent='commenti';
    comment.addEventListener('click',onComment);
    reviewdiv.appendChild(comment);
    
    content.appendChild(reviewdiv);


}

function add(event){
    const target=event.currentTarget.parentNode.parentNode;
    const formdata=new FormData;
   
    formdata.append("title",target.querySelector('h4').textContent);
   fetch('inprefer_serie.php',{method:'post',body:formdata}).then(onRes);
    event.currentTarget.removeEventListener('click',add);
    
    const article=document.querySelector('.article');
    const element=document.createElement('div');
    element.classList.add('prefer');
   
    const image=document.createElement('img');
    image.src=target.querySelector('.image').src;
    image.classList.add('image');
    element.appendChild(image);
    const title=document.createElement('h4');
    title.textContent=target.querySelector('h4').textContent;
    title.classList.add('pfilm');
    element.appendChild(title);
    const nopref=document.createElement('img');
    nopref.src='https://www.wallpaperuse.com/wallp/86-863477_m.jpg';
    nopref.classList.add('nopref');
    nopref.addEventListener('click',remove);
    element.appendChild(nopref);
    

    if(document.querySelector('.list')===null){

        const preferiti=document.createElement('div');
        const titlepre=document.createElement('h4');
        titlepre.textContent='Preferiti';
        titlepre.classList.add('pfilm');
        preferiti.appendChild(titlepre);
        const div=document.createElement('div');
        div.classList.add('list')
       preferiti.appendChild(div);
       div.appendChild(element);
       article.appendChild(preferiti);
   }
   else{
       const div=document.querySelector('.list');
       div.appendChild(element);
   }
    
}


function remove(event){
    const element=event.currentTarget.parentNode.querySelector('h4').textContent;
    event.currentTarget.removeEventListener('click',remove);
    const selected=document.querySelector('.list');
    const article=document.querySelector('.article');
    
    const block=document.querySelectorAll('.isflex');
    for(let i=0;i<block.length;i++) {
        if(block[i].querySelector('h4').textContent===element){
            block[i].querySelector('.pref').addEventListener('click',add);
        }
    }
    selected.removeChild(event.currentTarget.parentNode);
    if(selected.childElementCount===0){
        article.removeChild(selected.parentNode);
    }
    const formdata=new FormData;
   
    formdata.append("title",event.currentTarget.parentNode.querySelector('h4').textContent);
    fetch('delprefer_serie.php',{
        method:'post',
        body:formdata
    }).then(onRes)

    
}

function onComment(event){
    const get=encodeURI(document.querySelector('.selected .small h4').textContent);
    const selected=document.querySelector('.selected .small h4');
    const prop=document.querySelector('.selected .description');
    event.currentTarget.removeEventListener('click',onComment);
    const formcomment=document.createElement('form');
    formcomment.setAttribute("method","post");
    const incomment=document.createElement('input');
    incomment.setAttribute("type","text");
    incomment.setAttribute("name","comment");
    const send=document.createElement('input');
    const hidden=document.createElement("input");
    hidden.setAttribute("type","hidden");
    hidden.setAttribute("value",selected.textContent);
    hidden.setAttribute("name","hidden");
    send.setAttribute("type","submit");
    formcomment.addEventListener('submit',Send);
    formcomment.appendChild(incomment);
    formcomment.classList.add('center');
    formcomment.appendChild(send);
    formcomment.appendChild(hidden);
    const container=document.createElement('div')
    container.classList.add('hidden');
    prop.appendChild( container);
    prop.appendChild(formcomment);
   
    fetch('oncomment_serie.php?title='+get).then(onResponce).then(CommentJson);
}




function CommentJson(json){
   
    const des= document.querySelector('.selected .description .hidden');
    const selected=document.querySelector('.selected .small h4');
    const div=document.createElement('div');
    for(let i=0; i<json.length;i++){
        const union=document.createElement('div');
        union.classList.add('comment');
        
        const im=document.createElement('img');
        im.classList.add('userimg');
        im.src='https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433__340.png';
        const user=document.createElement('span');
        user.textContent=json[i][0];
         union.appendChild(im);
        union.appendChild(user);
      
        const text=document.createElement('div');
        text.textContent=json[i][2];
        text.classList.add('wrap');
        union.appendChild(text);
        const time=document.createElement('p');
        time.textContent=json[i][1];
        union.appendChild(time);
        div.appendChild(union);
    }
    div.classList.add('comments');
    
    des.appendChild(div);
    des.classList.remove('hidden');
    



}
function onPrefer(json){
    for(let i=0;i<json.length;i++){
        const uri=encodeURI(json[i]);
        
       
        fetch("api_film.php?q="+uri+"&m=t&type=s").then(onResponce).then(Prefe);
    }
}



function Prefe(json){
    
   
   
    const titlepref=document.querySelectorAll('.small h4');
   
    for(let i=0 ;i<titlepref.length;i++){
        if(titlepref[i].textContent===json.Title){
            
            titlepref[i].parentNode.parentNode.querySelector('.pref').removeEventListener('click',add);

        }
      
    }

    
    const article=document.querySelector('.article');
    const element=document.createElement('div');
    element.classList.add('prefer');
   
    const image=document.createElement('img');
    image.src=json.Poster;
    image.classList.add('image');
    element.appendChild(image);
    const title=document.createElement('h4');
    title.textContent=json.Title;
    title.classList.add('pfilm');
    element.appendChild(title);
    const nopref=document.createElement('img');
    nopref.src='https://www.wallpaperuse.com/wallp/86-863477_m.jpg';
    nopref.classList.add('nopref');
    nopref.addEventListener('click',remove);
    element.appendChild(nopref);
    
 if(document.querySelector('.list')===null){

     const preferiti=document.createElement('div');
     const titlepre=document.createElement('h4');
     titlepre.textContent='Preferiti';
     titlepre.classList.add('pfilm');
     preferiti.appendChild(titlepre);
     const div=document.createElement('div');
     div.classList.add('list')
    preferiti.appendChild(div);
    div.appendChild(element);
    article.appendChild(preferiti);
}
else{
    const div=document.querySelector('.list');
    div.appendChild(element);
}
   
   
}

function onRes(responce){
    return responce.ok
}

function Send(event){
    event.preventDefault();
    const formdata=new FormData;
    
    formdata.append("comment",event.currentTarget.querySelector('input[name="comment"]').value);
    formdata.append('hidden',event.currentTarget.querySelector('input[name="hidden"]').value);
   
    fetch('insertcomment_serie.php',{method:'post',
    body:formdata
    }).then(onResponce)
}


function Modal(event){
    const sec=document.querySelector('.no-w');
    const im=document.createElement('img');
    sec.appendChild(im);
    
    im.src=event.currentTarget.src;
    sec.classList.remove('no-w');
    sec.classList.add('modal-view');
    sec.style.top=window.pageYOffset+'px';
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