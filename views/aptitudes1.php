<?php

$dataCreate = $this->d;

// print_r($dataCreate);

$html_body = $dataCreate['html_body'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'layout/keywords.php';?>
        <title>Aptitudes</title>
    </head>
    
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include_once 'layout/nav.php';?>
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper px-4 py-4">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div id="title" class="col-sm-12">
                                <p class="mb-0">Aptitudes</p>
                            </div>
                            <div id="text" class="mx-3 mt-3">
                                <p>Have you work in somewhere? Tell us all your jobs and work position.</p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Main content -->
                <section class="content px-4">
                    <div class="card card-primary">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label>Maybe you have this aptitudes you can agree all you want</label>
                                    <div class="form-group pt-3">
                                        <div class="custom-control custom-checkbox py-2">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                            <div for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</div>
                                        </div>
                                        <div class="custom-control custom-checkbox py-2">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                        <div for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</div>
                                    </div>
                                    <div class="custom-control custom-checkbox py-2">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                        <div for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</div>
                                    </div>
                                    <div class="custom-control custom-checkbox py-2">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                        <div for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</div>
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="col-7">
                                <div class="form-group">
                                    <label>Aptitudes: List at least 5 aptitudes of you to make more interesting your profile. </label> 
                                    <textarea id="html_body" class="form-control" rows="6" placeholder="Enter"><?php echo $html_body;?></textarea>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <a href="<?php echo constant('URL') . 'create/vocations/3?idcv=' . $_GET['idcv']?>"><button type="button" class="btn btn-secondary">Back</button>                            </a>
                            </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-dark" id="btnSummerNote">Next</button>     
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
        </div>
        <?php include_once 'layout/footer.php';?>
    </body>
</html>

<style>
    #title 
    {
        font-size: 36px;
        font-weight: bold;
    }
    #text
    {
        font-size: 22px;
    }
    .btn
    {
        font-size: 1.1rem;
        padding: 0.375rem 1.4rem;
    }
    </style>
<script>
    $(function () {
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            // tabsize: 2,
            height: 100
        });
        
    })
</script>

<script >

    const crudder = dominio => recurso => {
    
        const url = `${dominio}${recurso}`;
    
        return({
    
            create: (x) => fetch(url,{
                method: 'POST',
                body: JSON.stringify(x),
            }).then(x => x.json()),

            get:() => fetch(url).then(x => x.json())

        })
        
    }
    
    const Base = crudder('<?php echo constant("URL") ;?>');
    const Ability = Base('create/insertApUno?idcv=<?php echo $_GET['idcv']?>');
    
    
    // (function(){
        
    //     document.addEventListener('load', () => {
    
    const summernote = document.getElementById('html_body');
    const btnSummernote = document.getElementById('btnSummerNote');
    
    // console.log(summernote);
    
    const payload = {};

    summernote.addEventListener('change', e => {

        payload.html_body = summernote.value;
        console.log(payload);
    } )

    btnSummernote.addEventListener('click', e => {
        
        e.preventDefault();
    
        Ability.create(payload).then(payload => {
            console.log(payload);
            window.location.href = "<?php echo constant("URL") . '/create/aptitudes/2?idcv=' .  $_GET['idcv'];?>";
        })
    })
    
    //     });

    // })();

</script>