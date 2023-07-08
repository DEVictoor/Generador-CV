let btnCategories = [...document.querySelectorAll('.navCategory a[data-id]')];
let containerProducts = document.querySelector('.gridProducts');

btnCategories.map(elem =>
{
    elem.addEventListener('click', e =>
    {
        e.preventDefault();


        let __id = elem.getAttribute('data-id');

        console.log(__id);

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', URL + 'producto/getProducts/' + __id);

        xhttp.onload = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                let __json = JSON.parse(xhttp.response);
                
                //console.log(__json);
                
                containerProducts.innerHTML = '';
                __json.map(x =>
                {
                    let __content = `<a href="producto/p/${x.id}" class="wow animate__animated animate__flipInY"><div>
                                        <img src="${x.img}">
                                        <span style="color: ${__color};">${x.name}</span>
                                    </div></a>`;

                    containerProducts.innerHTML += __content;
                });
                                
            }
            else
            {
                alert("No se pudo traer los productos");
            }
        };

        xhttp.send();
    });
});