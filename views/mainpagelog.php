<?php

    $dataUser = $this->d;

    // print_r($dataUser);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'layout/keywords.php';?>
  <title>Página Principal</title>
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo constant('URL') . 'user'; ?>"><button type="button" data-toggle="modal" data-target="#login" class="btn btn-outline-light mr-sm-2 rounded-pill" type="submit">My CV</button></a>
		<a href="<?php echo constant('URL') . 'general/closeSession'; ?>"><button type="button" data-target="" class="btn btn-outline-danger mr-sm-2 rounded-pill" type="submit">Log out</button></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <div class="user-panel mt-1 d-flex">
                    <div class="info">
                        <a class="d-block text-white"><?php echo $dataUser['username']; ?></a>
                    </div>
                    <div class="image">
                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                </div>
            </li>
        </ul>
    </nav>

    <div id="background"  >
        <div id="boton">  
        <a href="<?php echo constant('URL') .'create';?>">
            <button type="button" class="btn btn-light btn-lg rounded-pill" style="background-color: #F9A826 !important; border-color:#f8a51f !important ;padding-top: 16px; padding-bottom:16px; padding-left: 20px; padding-right: 20px;" >Create my CV</button> 
        </a>
        </div>
        <div id="icono">
            <div id="title"> <p>Create Your CV for Free!</p><p id="chiquito">Only need to login</p></div>
            <div id="imagen"></div>
        </div>
    </div>

</body>

<style>
    /* @supports(object-fit: cover){
    #fotocambia{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
    } */
    body
    {
        background-image:url("assets/img/flat-mountains2.svg");
        background-repeat:no-repeat;
        background-size:cover;
        background-position: center center;
    }
    #background
    {
        width:100%;
        display: flex;
        height: calc(100vh - 54px);
        background-size: cover;
        background-position: center center; 
    }
    #title
    {
        font-size:46px;
        font-weight: bold;
        color: white;
        width: 60%;
        
    }
    #title p 
    {
        margin:0px ;
    }
    #chiquito
    {
        font-weight: normal;
        font-size: 1.2rem;
    }
    #icono
    {
        width:70%;
        /* background-color:red; */
        display:flex;
        flex-direction: column;
        justify-content: space-around    ;
        align-items:flex-end;
        /* height: 60vh; */
        /* transform: scaleX(-1); */
    }
    #imagen
    {
        background-image:url("assets/img/icon-background.svg");
        width: 60%;
        height: 70%;
        /* align-self: flex-end; */
        background-repeat:no-repeat;
        background-size:contain;
        background-position: center center;
    }

 
    #boton
    {        
        width: 30%;
        display:flex;
        justify-content: center;
        align-items:center;
        /* algin-items: center; */
        /* background-color: blue; */
    }
    #boton button
    {
        margin: 0 0 0 5%;
        width:30vh;
        height: 11vh;
    }
    @media screen and (max-width: 700px)
    {
        #background
        {
            flex-direction: column;
            /* justify-content: center; */
            align-items: space-between;
        }
        #background #boton 
        {
            width:100%;
            height: 30%;
        }
        #background #icono 
        {
            width:100%;
            text-align: center;
            height: 60%;
            display:flex;
            align-items: center; 
            gap: 20px;
            /* justify-content: center; */
        }
        #title
        {
            width: 100%;
        }
        #icono #imagen
        {
            width: 80%;
            height: 70%;
        }
    }
    @media screen and (max-height: 550px)
    {
        #background #boton button 
        {
            
            padding: 0px 0px 0px 0px;
            width:50%;
            height: 70%;
        }
        #icono
        {
            width:80%;
            /* background-color:red; */
            display:flex;
            flex-direction: column;
            justify-content: center   ;
            align-items:flex-end;
        }
        #icono #imagen
        {
            width: 0%;
            height: 0%;
        }
    }
    /* div#background
    {
        background-image: url('https://inspirationfeed.com/wp-content/uploads/2018/12/david-werbrouck-304966-unsplash.jpg');
        background-repeat:no-repeat;
        background-size:cover;
        background-position:center center;
    } */
    .login_title
    {
        color: #007bff;
    }
    .register_title
    {
        color: #28a745;
    }

    .btn:focus
    {
        outline: none; 
        box-shadow: none;
    }
    .btn
    {
	box-shadow: none !important
    }
</style>
<script>
        var cont=0;
    function cambia() {
        cont = cont % 2;
        if (cont==1){
        document.getElementById('imagen').style.backgroundImage = "url('assets/img/icon-background.svg')";
        }
        else{
        document.getElementById('imagen').style.backgroundImage = "url('assets/img/icon-background2.svg')";
        }
        cont++;
        }
    function inicio() {
    setInterval(cambia, 4000);
    }
    window.onload=inicio;
    // document.getElementById('imagen').style.backgroundImage = "url('assets/img/background1.jpg')";
</script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/js/adminlte.min.js" integrity="sha512-pbrNMLSckfh8yEOr2o1RT+4zMU3Sj7+zP3BOY6nFVI/FLnjTRyubNppLbosEt4nvLCcdsEa8tmKhH3uqOYFXKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
