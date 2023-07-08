const formDataModVer = document.querySelector('#formDataModVer');
const containerModVer = document.querySelector('#containerModVer');

formDataModVer.addEventListener('submit', e =>
{
    e.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', e.currentTarget.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
            let __content = `<div id="modver${__json.id}" class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    ${__json.title}
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4><b>${__json.title}</b></h4>
                                            <p>${__json.description}</p>
                                            <a href="${__json.link}">${__json.link}</a>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="${__json.img}" class="img-fluid" width="320px">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeModVer(${__json.id});">Eliminar</button>
                                    </div>
                                </div>
                            </div>`;
            containerModVer.innerHTML = __content + containerModVer.innerHTML;
            
            formDataModVer.reset();
            formDataModVer.querySelector('img').src = 'assets/img/480x320.jpg';
        }
        else
        {
            alert("No se pudo guardar el modulo vertical");
        }
    };

    xhttp.send(new FormData(e.currentTarget));
});

const formDataModHor = document.querySelector('#formDataModHor');
const containerModHor = document.querySelector('#containerModHor');

formDataModHor.addEventListener('submit', e => {
    e.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', e.currentTarget.action);

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
            let __content = `<div id="modhor${__json.id}" class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    ${__json.title}
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="${__json.img}" class="img-fluid" width="80px">
                                            <br><br>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="text-center"><b>${__json.title}</b></h4>
                                            <p class="text-center">${__json.description}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeModHor(${__json.id});">Eliminar</button>
                                    </div>
                                </div>
                            </div>`;
            
            containerModHor.innerHTML = __content + containerModHor.innerHTML;

            formDataModHor.reset();
            formDataModHor.querySelector('img').src = 'assets/img/80x80.jpg';
        }
        else
        {
            alert("No se pudo guardar el modulo horizontal");
        }
    }

    xhttp.send(new FormData(e.currentTarget));
});


function removeModVer(id)
{
    let __container = containerModVer.querySelector('#modver' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'homepage/deleteModVer');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerModVer.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'idmod': id}));
}

function removeModHor(id)
{
    let __container = containerModHor.querySelector('#modhor' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'homepage/deleteModHor');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerModHor.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'idmod': id}));
}
