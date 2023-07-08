<?php

    $dataCreate = $this->d;

    $dataPage = $dataCreate['dataPage'];

    // print_r($dataCreate);
//    echo exec('whoami');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Personal Information</title>
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
                            <p class="mb-0">Personal Information</p>
                        </div>
                        <div id="text" class="mx-3 mt-3">
                            <p>If you complete your profile this </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
                <form action="<?php echo constant('URL') . 'create/updatecv?idcv=' . $dataCreate['id_curriculum']; ?>" method="post" enctype="multipart/form-data">
                <div class="card card-primary">
                    <div class="card-header bg-secondary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Choose a Photo</label>
                                    <div class="input-group">
                                        <img id="img" src="<?php echo $dataPage['photo']; ?> ">
                                        <div class="custom-file mt-3">
                                            <input type="file" id="user_img" name="user_img" class="custom-file-imput" value="" >
                                            <label class="custom-file-label" for="user_img">Seleccionar archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $dataPage['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" name="lastnames" value="<?php echo $dataPage['lastnames']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo $dataPage['city']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $dataPage['email']; ?>" required>
                                </div>
                            </div> 

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input type="text" class="form-control" name="street" value="<?php echo $dataPage['street'];?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Zip code</label>
                                    <input type="number" class="form-control" name="postalcode" value="<?php echo $dataPage['postalcode']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $dataPage['phone']; ?>" required>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <a href="<?php echo constant('URL') . 'create';?>"><button type="button" class="btn btn-secondary">Back</button></a>                            
                            </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-dark">Next</button>     
                            </div>
                        </div>


                    </div>
                </div>
                </form>
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
    /* .custom-file-label::after 
    {
        content: "Buscar";
    } */
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
