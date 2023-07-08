<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Start CV</title>
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
                            <p class="mb-0">Create Your CV For Free</p>
                        </div>
                        <div id="text" class="mx-3 my-3">
                            <p>It's free and always been</p>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content px-4 d-flex align-items-center flex-column">
                <div id="imagen">
                    <img id="img" src="<?php echo constant('URL'). 'assets/img/cv.jpg';?>" alt="">
                </div>
                <div class="text-center ">
                <a href="<?php echo constant('URL') . 'create/init?status=1'; ?>">
                    <button class="btn btn-block btn-dark btn-lg mt-4"> Start Now</button>        </a>   
                    <button class="btn btn-block btn-secondary btn-lg mt-3">Exit</button>
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
    #imagen
    {
        width: 210px;
        height: 300px;

    }
    #img 
    {
        width: 100%;
        height: 100%;
        object-fit: contain;
        box-shadow: 2px 2px 2px 1px gray;
    }
</style>