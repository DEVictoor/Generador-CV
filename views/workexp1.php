<?php

    $dataCreate = $this->d;

    $dataWork = $dataCreate["dataWork"] ?? [];

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
                            <p>Have you work in somewhere? Tell us all your jobs and work position.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
                <form action="<?php
                if(isset($dataCreate["dataWork"])){
                    echo constant('URL') . 'create/editWork?idcv=' . $dataCreate['id_curriculum'] . '&idwork=' . $dataWork['id'];
                } else{
                    echo constant('URL') . 'create/createWork?idcv=' . $dataCreate['id_curriculum'];
                }
                ?>" method="post">
                    <div class="card card-primary">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Work Position</label>
                                        <input type="text" class="form-control" name="position" value="<?php echo $dataWork['position'] ?? '' ;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" class="form-control" name="company" value="<?php echo $dataWork['company'] ?? '' ;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo $dataWork['city'] ?? '' ;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>State Date</label>
                                        <input type="date" class="form-control" name="start_date" value="<?php echo $dataWork['start_date'] ?? '' ;?>" required>
                                    </div>
                                </div> 
    
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>What did you do?</label>
                                        <textarea class="form-control" name="description" rows="6" placeholder="□ Determinated the accuracy of the data
    □ Performed preductuve analytics to determine the furure"><?php echo $dataWork['description'] ?? '' ;?></textarea>
                                    </div>
                                    <div class="form-group pt-3">
                                        <label>Finish Date</label>
                                        <input type="date" class="form-control" value="<?php echo $dataWork['finish_date'] ?? '' ;?>" name="finish_date" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="continue_work" value="<?php echo $dataWork['continue_work'] ?? 0 ;?>">
                                            <label class="custom-control-label" for="customSwitch1">Continue working?</label>
                                        </div>
                                    </div>
                                </div> 
    
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <a href="<?php echo constant('URL') . 'create/profile/2?idcv=' . $_GET['idcv'];?>"><button type="button" class="btn btn-secondary">Back</button></a>                            
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