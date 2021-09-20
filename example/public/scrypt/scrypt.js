console.log('Привет, Мир!');

let showmoreBtn = document.querySelectorAll('#showmore-btn');
showmoreBtn.forEach((elem)=>{
    elem.addEventListener('click', ()=>{
        let page = elem.getAttribute('data-page');
        page++;
        let countMax = elem.getAttribute('data-max');
        let newcatalog = document.getElementById('catalog');
        while (newcatalog.firstChild) {
            newcatalog.firstChild.remove();
        }
        if (page <= countMax) {
            (
                async () => {
                    const response = await fetch('/good/ajax/?page=' +  page);
                    const answer = await response.json();
                    // console.log(answer.catalog);
                    elem.setAttribute("data-page", page);
                    renderCatalog(answer);
                }
            )();
            if (page == countMax) {
                elem.style.visibility="hidden";
            }
        }
    })
});

function renderCatalog(answer) {
    // console.log(answer.catalog.length);
    let newcatalog = document.getElementById('catalog');
    // console.log(answer.catalog);
    answer.catalog.forEach(function (elem) {
        let tr = document.createElement('tr');
        tr.innerHTML =
            `<div class="good-big vvv" id="vvv">
             <a class="photo"  href="../good/card/?id=${elem.id}">
                    <h3>${elem.title}</h3>
             </a>                                       
             <img class="img-good" src="${elem.photo}">                       
             <p>Стоимость: ${elem.price}</p>                                  
             <button data-id="${elem.id}" onclick="buy(${elem.id})" class="buy">Купить</button>
             </div>`;
        newcatalog.appendChild(tr);
    })
}

function buy(id) {
    (
        async () => {
            const response = await fetch('/basket/add/?id_good=' + id);
            const answer = await response.json();
            console.log(answer);
            document.getElementById('count').innerText = answer.count;
        }
    )();
}




//вариант КУПИТЬ без onclick (не работает при подгрузке товаров через ajax)
// buttons.forEach((elem)=>{
//     elem.addEventListener('click', ()=>{
//         let id = elem.getAttribute('data-id');
//         console.log(id);
//         (
//             async () => {
//                 const response = await fetch('/basket/add/?id_good=' + id);
//                 const answer = await response.json();
//                 console.log(answer);
//                 document.getElementById('count').innerText = answer.count;
//             }
//         )();
//     })
// });



