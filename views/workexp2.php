<?php



    $dataCreate = $this->d;

    $dataWorks = $this->d['dataWorks'];



    // print_r($dataWorks);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Work Experience</title>
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
                            <p class="mb-0">Work experience</p>
                        </div>
                        <div id="text" class="mx-3 mt-3">
                            <p>Have more experiences? add all you want.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
                <div class="card card-primary">
                    <div class="card-header bg-secondary" style="font-size: 1.1rem;">Experiences</div>

                    <div class="card-body">
                        <button type="submit" class="btn btn-primary col-2 mb-4">
                            <!-- <style>

                                a:link, a:visited, a:active{
                                    text-decoration: none;
                                }

                            </style> -->
                            
                            <div id="creatework">
                                <i class="fas fa-plus px-1"></i>
                                    Add more
                            </div>    
                            </a>
                        </button>

                        <?php
                        
                        foreach($dataWorks as $row){
                            ?>
                            
                                <div class="card bg-light d-flex flex-fill collapsed-card" id="rg<?php echo $row['id'];?>">
                                    <div class="card-header d-flex justify-content-between px-1">
                                        <div class="col-sm"><?php echo $row['position'];?></div>
                                        <div class="col-sm"><?php echo $row['company']; ?></div>
                                        <div class="d-flex justify-content-end card-tools col-sm">
                                            <button type="button" class="btn btn-tool px-3">
                                                <a href="<?php echo constant("URL") . 'create/works/1?idcv=' . $_GET['idcv'] . '&idwork=' . $row['id'];?>">    
                                                    <i class="fas fa-pencil"></i>
                                                </a>
                                            </button>
                                            <button type="button" class="btn btn-tool px-3" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <?php echo $row['description']; ?>
                                        </div>
                                    </div>
                                    <div class="card-footer border-top-0 bg-light">
                                        <div class="text-right">
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row['id'];?>"> Eliminar</button>
                                        </div>
                                    </div>
                                </div>

                            <?php
                        }

                        ?>



                    </div>

                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <a href="<?php echo constant('URL') . 'create/works/1?idcv=' . $_GET['idcv'];?>"><button id="btn-back-next" type="submit" class="btn btn-secondary">Back</button></a>
                            </div>
                            <div class="p-2">
                            <a href="<?php echo constant('URL') . 'create/works/3?idcv=' . $_GET['idcv'];?>"><button id="btn-back-next" type="submit" class="btn btn-dark">Next</button></a>    
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
    #btn-back-next
    {
        font-size: 1.1rem;
        padding: 0.375rem 1.4rem;
    }
</style>
<script>

    let creatework = document.getElementById("creatework");

    creatework.addEventListener("click" , () => {

        window.location.href = "<?php echo constant("URL") . '/create/works/1?idcv=' .  $_GET['idcv'];?>";

    })

    const crudder = dominio => recurso => {
    
        const url = `${dominio}${recurso}`;

        return({

            create: (x) => fetch(url,{
                method: 'POST',
                body: JSON.stringify(x),
            }).then(x => x.json()),

            get:() => fetch(url).then(x => x.json()),

            delete: () => fetch(url, {
                method: 'DELETE'
            }).then(x => x.json())

        })
    
    }

    const Base = crudder('<?php echo constant("URL") ;?>');
    
    const payload = {};

    btnwork = document.querySelectorAll(".btn-delete");

    console.log(btnwork);

    [...btnwork].map( element => {

        element.addEventListener("click" , (e) => {

            let target = e.target.getAttribute("data-id");
 
            let divPadre = document.getElementById("rg" + target);

            // console.log(target);

            const Work = Base('create/deleteWork?id=' + target);

            Work.delete().then( msg => {
                
                console.log(msg);

                divPadre.remove();
            
            })
        })

    })

let editwork = document.getElementById("editwork");


    editwork.addEventListener("click", () => {

        window.location.href = 
        <?php 
                echo constant("URL") . 'create/works/1?idcv=' . $_GET['idcv'] . '&idwork=';
        ?> 
        + idword;

    })

</script>