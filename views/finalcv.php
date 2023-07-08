<?php

    $dataCreate = $this->d;

    // print_r($dataCreate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Final CV</title>
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
                            <div class="d-flex justify-content-center col-sm">
                                <img class="img-fluid" width="60%" src="<?php echo constant("URL") . 'assets/img/cv.jpg'?>" alt="">
                            </div> 
                            <div class="col-sm">
                                <div id="title" class="d-flex justify-content-center col-sm-12">
                                    <p class="mb-0">What Next?</p>
                                </div>
                               
                                <div class="d-flex align-items-center flex-column border-bottom border-secondary">
                                    <button type="submit" class="btn btn-secondary my-3" id="gohome">Go Home</button>
                                    <button type="submit" class="btn btn-secondary mb-4" id="cvs">My CVs</button>
                                </div>

                                <div class="d-flex align-items-center flex-column">
                                    <a href="<?php echo constant('URL') . 'create/viewPdf?idcv=' . $_GET['idcv'] ; ?>"><button type="button" class="btn btn-dark mt-4">View</button></a>
                                    <a href="<?php echo constant('URL') . 'create/downloadPdf?idcv=' . $_GET['idcv'] ; ?>"><button type="button" class="btn btn-danger my-3">Download</button></a>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                            <a href="<?php echo constant('URL') . 'general'  ; ?>"><button type="submit" class="btn btn-secondary">Exit</button></a>                            
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
<script>

    let gohome = document.getElementById("gohome");

    gohome.addEventListener("click", () => {

        window.location.href = "<?php echo constant("URL") . '/general';?>";

    })

    let cvs = document.getElementById("cvs");

    cvs.addEventListener("click", () => {

        window.location.href = "<?php echo constant("URL") . '/user/cvs';?>";

    })

</script>