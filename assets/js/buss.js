
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BUSSINESS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const formDataMod = document.querySelector('#formDataMod');
const containerMod = document.querySelector('#containerMod');

formDataMod.addEventListener('submit', e =>
{
    e.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', e.currentTarget.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
            let __content = `<div id="mod${__json.id}" class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    Módulo
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4><b>${__json.title}</b></h4>
                                            <p>${__json.description}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <img src="${__json.img}" class="img-fluid" width="200px">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeMod(${__json.id});">Eliminar</button>
                                    </div>
                                </div>
                            </div>`;
            containerMod.innerHTML = __content + containerMod.innerHTML;

            formDataMod.reset();
            formDataMod.querySelector('img').src = 'assets/img/500x500.jpg';
          }
        else
        {
          alert("No se pudo guardar el módulo");
        }
    };
      
    xhttp.send(new FormData(e.currentTarget));
});

const formDataGal = document.querySelector('#formDataGal');
const containerGal = document.querySelector('#containerGal');

formDataGal.addEventListener('submit', e =>
{
    e.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', e.currentTarget.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
            let __content = `<div id="gal${__json.id}" class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                Imagen
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="${__json.img}" class="img-fluid" width="100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeGal(${__json.id});">Eliminar</button>
                                    </div>
                                </div>
                            </div>`;
            containerGal.innerHTML = __content + containerGal.innerHTML;

            formDataGal.reset();
            formDataGal.querySelector('img').src = 'assets/img/1024x768.jpg';
        }
        else
        {
            alert("No se pudo guardar el módulo");
        }
    };

    xhttp.send(new FormData(e.currentTarget));
});



function removeMod(id)
{
    let __container = containerMod.querySelector('#mod' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'business/deleteModule');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerMod.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'idmod': id}));
}

function removeGal(id)
{
    let __container = containerGal.querySelector('#gal' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'business/deletePhoto');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerGal.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'idphoto': id}));
}
