const inputFrame = document.querySelector('#module_maps');
const frameMap = document.querySelector('div[data-id="module_maps"] iframe');

inputFrame.addEventListener('input', e =>
{
    frameMap.src = inputFrame.value;
});

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
                                ${__json.title}
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
                                            <iframe src="${__json.link}" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
            formDataMod.querySelector('iframe').src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3794.0045301402815!2d-70.2527232845195!3d-18.024993386553785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915acf5d1d19a029%3A0xbd7b1220077c70b!2sJorge%20Basadre%20Grohmann%20National%20University!5e0!3m2!1sen!2spe!4v1636835475340!5m2!1sen!2spe';
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
    xhttp.open('DELETE', URL + 'contact/deleteModule');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerMod.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'idmod': id}));
}