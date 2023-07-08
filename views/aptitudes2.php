<?php

    $dataCreate = $this->d;

    // print_r($dataCreate);

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
            <!-- Main content -->
            <section class="content px-4">
                <div class="card card-primary">
                    <div class="card-header bg-secondary"></div>
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm">
                                <div id="title" class="col-sm-12">
                                    <p class="mb-0">Aptitudes</p>
                                </div>
                                <div id="text" class="mx-3 mt-4 pb-3 border-bottom border-secondary">
                                    <p class="mb-1">Looks really professional, lets go to the net section!</p>
                                    <p class="mb-1">or back if you feel your wrong or miss someting</p>
                                </div>
                            </div> 

                            <div class="d-flex justify-content-center col-sm">
                                <img class="img-fluid" width="60%" src="<?php echo constant('URL'). 'assets/img/cv.jpg';?>" alt="">
                            </div> 

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2"w>
                                <a href="<?php echo constant('URL') . 'create/aptitudes/1?idcv=' . $_GET['idcv']; ?>"><button type="button" class="btn btn-secondary">Back</button></a>
                            </div>
                            <div class="p-2">
                                <a href="<?php echo constant('URL') . 'create/aptitudes/3?idcv=' . $_GET['idcv']; ?>"><button type="button" class="btn btn-dark">Next</button></a>     
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
        font-size: 18px;
    }
    #imagen
    {
        width: 210px;
        height: 400px;
    }
    #img 
    {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .btn
    {
        font-size: 1.1rem;
        padding: 0.375rem 1.4rem;
    }
</style>