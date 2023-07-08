<?php

    // session_start();

    $data = $this->d;

    $dataUser = $data["dataUser"];

    // echo exec('cd');

    // print_r($dataUser);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Profile</title>
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
                            <p class="mb-0">Profile 19283</p>
                        </div>
                        <div id="text" class="mx-3 mt-3">
                            <p>If you complete your profile this section will autocomplete</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
                <form action="profile/updateUser" method="post" enctype="multipart/form-data">
                <div class="card card-primary">
                    <div class="card-header bg-secondary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Choose a Photo</label>
                                    <div class="input-group">
                                        <img id="img" src="<?php echo $dataUser["photo"]; ?>">
                                        <div class="custom-file mt-3">
                                            <input type="file" id="user_img" name="photo" class="custom-file-imput" value="" required>
                                            <label class="custom-file-label" for="user_img">Seleccionar archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name"class="form-control" value="<?php echo $dataUser["name"];?>" required>
                                </div> 
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo $dataUser["lastname"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $dataUser["city"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $dataUser["email"]; ?>" required>
                                </div>
                            </div> 

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input type="text" name="street" class="form-control" value="<?php echo $dataUser["street"]; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $dataUser["phone"]; ?>" required>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <div class="p-2">
                                <button type="submit" class="btn btn-dark">Save Changes</button>     
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