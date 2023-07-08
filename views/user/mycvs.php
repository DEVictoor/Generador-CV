<?php 

    $cvs = $this->d["cvs"];

    // print_r($cvs);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'layout/keywords.php';?>
    <title>My CVs</title>
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
                            <p class="mb-0">My CVs</p>
                        </div>
                        <div id="text" class="mx-3 mt-3">
                            <p>Here you will find the CVs you have created, sorted by date and time of creation.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-4">
               
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">CV List</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Hour</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                                foreach ($cvs as $key => $value) {
                                    
                                    ?>

                                        <tr id="rg<?php echo $value['id'];?>" >
                                            <td><?php echo $key + 1 ; ?></td>
                                            <td><?php echo $value["Fecha"]; ?></td>
                                            <td><?php echo $value["Hora"];?></td>
                                            <td>
                                                <a href="<?php echo constant('URL') . 'create/viewPdf?idcv=' . $value['id'];?>" ><button class="btn btn-secondary"><i class="fas fa-search"></i></button></a>
                                                <a href="<?php echo constant('URL') . 'create/profile/1?idcv=' . $value['id'];?>" ><button class="btn btn-dark" type="button"><i class="fas fa-pencil-alt"></i></button></a>
                                                <button class="btn btn-danger btn-delete" data-id="<?php echo $value['id'];?>" type="button"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>

                                    <?php

                                }

                                
                                ?>

                            </tbody>
                        </table>


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

</style>    

<script>

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

    btncvs = document.querySelectorAll(".btn-delete");

    console.log(btncvs);

    [...btncvs].map( element => {

        element.addEventListener("click" , (e) => {

            let target = e.target.getAttribute("data-id");

            // let divPadre = document.getElementById("rg" + target);

            // console.log(divPadre);

            const Work = Base('create/deletecv?id=' + target);

            Work.delete().then( msg => {
                
                console.log(msg);

                target.parentNode.removeChild(target);
            
            })
        })

    })

</script>