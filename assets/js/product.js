const formDataCategory = document.querySelector('#formDataCategory');
const containerCategories = document.querySelector('#containerCategories');

formDataCategory.addEventListener('submit', e =>
{
    e.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', e.currentTarget.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
            let __content = `<div id="cat${__json.id}" class="card bg-light d-flex flex-fill" >
                                <div class="card-header text-muted border-bottom-0">
                                <span>${__json.name}</span>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                    <h4><b>${__json.name}</b></h4>
                                    <br> 
                                            
                                    <div class="card">
                                    <div class="card-header bg-secondary">
                                        <h3 class="card-title">Producto</h3>
                                    </div>
                                    <form action="product/createProduct" id="formDataProduct${__json.id}" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                <label for="product_name${__json.id}">Nombre</label>
                                                <input type="text" name="product_name" id="product_name${__json.id}" class="form-control" value="">
                                                </div>

                                                <div class="form-group">
                                                <label for="product_description${__json.id}">Descripción</label>
                                                <textarea type="text" name="product_description" id="product_description${__json.id}" class="form-control" value="" rows="6"></textarea>
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                <label for="product_image${__json.id}">Imagen <i style="font-weight: normal;">(500 x 500)</i></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                    <input type="file" id="product_image${__json.id}" name="product_image" class="custom-file-imput" value="">
                                                    <label class="custom-file-label" for="product_image${__json.id}">Seleccionar archivo</label>
                                                    </div>
                                                </div>
                                                </div>
                                                <img src="assets/img/500x500.jpg" data-id="product_image${__json.id}" height="200px">

                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white">
                                        <input type="hidden" value="${__json.id}" name="id_category">
                                        <button type="submit" class="btn btn-primary" onclick="addProduct(event, ${__json.id});">Enviar</button>
                                        </div>
                                    </form>
                                    </div>
                                            
                                    <div id="containerProducts${__json.id}">

                                        

                                    </div>
                                    </div>
                                </div>
                                </div>

                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeCategory(${__json.id});">Eliminar</button>
                                    </div>
                                </div>
                            </div>`;
                            
            containerCategories.innerHTML = __content + containerCategories.innerHTML;
            inputsImage = [...document.querySelectorAll('input[type="file"]')];
            inputsImage.map(e => addListener(e, 'change', showImage));
            formDataCategory.reset();
            }
        else
        {
            alert("No se pudo guardar la categoría");
        }
    };

    xhttp.send(new FormData(e.currentTarget));
});

function removeCategory(id)
{
    let __container = containerCategories.querySelector('#cat' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'product/deleteCategory');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            containerCategories.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'id': id}));
}

function addProduct(event, id)
{
    const formDataProduct = document.querySelector('#formDataProduct' + id);
    const containerProducts = document.querySelector('#containerProducts' + id);

    
    let __formData = new FormData(formDataProduct);
    if( __formData.get('product_name') == '' || __formData.get('product_description')  == '' || __formData.get('product_image') == '')
    {
        return ;
    }

    event.preventDefault();
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', formDataProduct.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);
    
                let __content = `<div id="pro${__json.id}" class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        <span>${__json.name}</span>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                        <h4><b>${__json.name}</b></h4>
                                        <p>${__json.description}</p>
                                        </div>
                                        <div class="col-5 text-center">
                                        <img src="${__json.img}" class="img-fluid" width="300px">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row padding-form-product">
                                    <div class="col-md-6">

                                        <div class="card">
                                    
                                        <div class="card-header" id="subcard">
                                            <h3 class="card-title text-white">Galería</h3>
                                        </div>
                                                    
                                        <form action="product/createImg" id="formDataGalery${__json.id}" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="">Imagen <i style="font-weight: normal;">(1024 x 768)</i></label>
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="product_galery${__json.id}" name="product_galery" class="custom-file-imput" value="">
                                                        <label class="custom-file-label" for="product_galery${__json.id}">Seleccionar archivo</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <img src="assets/img/1024x768.jpg" data-id="product_galery${__json.id}" width="100%">
                                    
                                                
                                                </div>
                                                 
                                            </div>
                                        </div><div class="card-footer">
                                        <input type="hidden" name="prod_id" value="${__json.id}">
                                        <button type="submit" class="btn btn-primary" onclick="addGalery(event, ${__json.id});">Enviar</button>
                                    </div>
                                    </form>  
                                        </div>
                                        


                                        <!-- Card de Galeria -->
                                        <div id="containerGalery${__json.id}">

                                        

                                        </div>
                                                
                                    </div>

                                    <div class="col-md-6">

                                        <div class="card">
                                        <div class="card-header" id="subcard">
                                        <h3 class="card-title text-white">Tabla</h3>
                                        </div>
                                        
                                        <form action="product/createTable" method="POST" id="formDataTable${__json.id}">
                                        <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    <label for="product_table_title${__json.id}">Título</label>
                                                    <input type="text" name="product_table_title" id="product_table_title${__json.id}" class="form-control" value="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="product_table_html${__json.id}">Tabla</label>
                                                    <textarea type="text" name="product_table_html" id="product_table_html${__json.id}" class="form-control" rows="15"></textarea>
                                                </div>

                                                <input type="hidden" name="prod_id" value="${__json.id}">
                                                
                                                
                                                </div>  
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" onclick="addTable(event, ${__json.id})">Enviar</button>
                                        </div>
                                        </form> 
                                    </div>


                                        <!-- Card tabla -->
                                        <div id="containerTables${__json.id}">

                                        

                                        </div>    
                                    </div>
                                    </div>
                                            
                                    <div class="card-footer">
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="removeProduct(${__json.id});">Eliminar</button>
                                    </div>
                                    </div>

                                </div>`;
                containerProducts.innerHTML = __content + containerProducts.innerHTML;
                inputsImage = [...document.querySelectorAll('input[type="file"]')];
                inputsImage.map(e => addListener(e, 'change', showImage));
                let listTextarea = [...document.querySelectorAll('textarea[name="product_table_html"]')];
                listTextarea.map(e =>
                {
                // CodeMirror
                    CodeMirror.fromTextArea(e, {
                        mode: "htmlmixed",
                        theme: "dracula"
                    });

                    e.style.display = 'block';
                    e.style.padding = '0';
                    e.style.height = '1px';
                    e.style.border = 'none';
                });
                formDataProduct.reset();
                formDataProduct.querySelector('img').src = 'assets/img/500x500.jpg';
        }
        else
        {
            alert("No se pudo guardar la categoría");
        }
    };
   
    xhttp.send(new FormData(formDataProduct));
}

function removeProduct(id)
{
    let __container = document.querySelector('#pro' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'product/deleteProduct');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            __container.parentNode.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'id': id}));
}

function addGalery(event, id)
{
    const formDataGalery = document.querySelector('#formDataGalery' + id);
    const containerGalery = document.querySelector('#containerGalery' + id);

    let __formData = new FormData(formDataGalery);
    console.log(__formData.get('product_galery').name);
    if( __formData.get('product_galery').name == '')
    {
        return ;
    }
    
    event.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', formDataGalery.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);

                let __content = `<div id="gal${__json.id}" class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                    Galería
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
                formDataGalery.querySelector('img').src = 'assets/img/1024x768.jpg';
                containerGalery.innerHTML = __content + containerGalery.innerHTML;
                inputsImage = [...document.querySelectorAll('input[type="file"]')];
                inputsImage.map(e => addListener(e, 'change', showImage));


                }
        else
        {
            alert("No se pudo guardar la categoría");
        }
    };

    xhttp.send(new FormData(formDataGalery));
}

function removeGal(id)
{
    let __container = document.querySelector('#gal' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'product/deleteImageCat');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            __container.parentNode.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'id': id}));
}

function addTable(event, id)
{
    const formDataTable = document.querySelector('#formDataTable' + id);
    const containerTables = document.querySelector('#containerTables' + id);

    
    let __formData = new FormData(formDataTable);
    let __txtCodeMirror = formDataTable.querySelector('textarea[name="product_table_html"]').nextSibling.innerText;
    __formData.set('product_table_html', __txtCodeMirror);

    if( __formData.get('product_table_title') == '' || __formData.get('product_table_html') == '​')
    {
        return;
    }
    
    event.preventDefault();

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', formDataTable.action);

    xhttp.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let __json = JSON.parse(xhttp.response);

                let __content = `<div id="tab${__json.id}" class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                    <span>${__json.title}</span>
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                  </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12 text-center style-table">
                                            <h4>${__json.title}</h4>
                                            <table>
                                                ${__json.table}
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button class="btn btn-sm btn-danger" onclick="removeTable(${__json.id});">Eliminar</button>
                                        </div>
                                    </div>
                                </div>`;

            containerTables.innerHTML = __content + containerTables.innerHTML;
            inputsImage = [...document.querySelectorAll('input[type="file"]')];
            inputsImage.map(e => addListener(e, 'change', showImage));
            formDataTable.reset();
            // formDataTable.querySelector('.CodeMirror-code').innerHTML = '<pre class=" CodeMirror-line " role="presentation"><span role="presentation" style="padding-right: 0.1px;"><span cm-text="">​</span></span></pre>';
            let listCodeMirror = [...document.querySelectorAll('.CodeMirror')];
            listCodeMirror.map(e =>
            {
                e.parentNode.removeChild(e);
            });
            let listTextarea = [...document.querySelectorAll('textarea[name="product_table_html"]')];
                listTextarea.map(e =>
                {
                // CodeMirror
                    CodeMirror.fromTextArea(e, {
                        mode: "htmlmixed",
                        theme: "dracula"
                    });

                    e.style.display = 'block';
                    e.style.padding = '0';
                    e.style.height = '1px';
                    e.style.border = 'none';
                });
        }
        else
        {
            alert("No se pudo guardar la categoría");
        }
    };

    xhttp.send(__formData);
}

function removeTable(id)
{
    let __container = document.querySelector('#tab' + id);

    let xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', URL + 'product/deleteTable');

    xhttp.onload = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            __container.parentNode.removeChild(__container);
        }
    }

    xhttp.send(JSON.stringify({'id': id}));
}

