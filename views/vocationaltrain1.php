<?php

    $dataCreate = $this->d;

    // print_r($dataCreate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>Vocational Training</title>
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
                            <p class="mb-0">Vocational Training</p>
                        </div>
                        <div id="text" class="mx-3 mt-3">
                            <p>Have you work in somewhere? Tell us all your jobs and work position.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
                <form action="<?php echo constant('URL') . 'create/createEducation?idcv=' . $_GET['idcv']; ?>" method="post">
                <div class="card card-primary">
                    <div class="card-header bg-secondary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Educational Center</label>
                                    <input type="text" class="form-control" value="" name="education_center" required>
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" value="" name="location" required>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" value="" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label>Graduation Date</label>
                                    <input type="date" class="form-control" value="" name="graduation_year" required>
                                </div>
                            </div> 

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Some Description (Optional)</label>
                                    <textarea name="description" class="form-control" rows="8" placeholder="Enter..."></textarea>
                                </div>
                                <div class="form-group pt-1">
                                    <label>Fields of Study</label>
                                    <input name="speciality" type="text" class="form-control" value="" required>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <a href="<?php echo constant('URL') . 'create/works/3?idcv=' . $_GET['idcv']; ?>"><button type="button" class="btn btn-secondary">Back</button></a>
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
    .btn
    {
        font-size: 1.1rem;
        padding: 0.375rem 1.4rem;
    }
</style>