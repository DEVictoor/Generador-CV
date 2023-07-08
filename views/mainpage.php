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
                <button type="button" data-toggle="modal" data-target="#login" class="btn btn-outline-primary mr-sm-2 rounded-pill" type="submit">Login</button>            
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <button type="button" data-toggle="modal" data-target="#register" class="btn btn-outline-light my-2 my-sm-0 rounded-pill" type="submit">Sign Up</button>
            </li>
        </ul>
    </nav>
    <div id="background"  >
        <div id="boton">  
	    <button type="button" data-toggle="modal" data-target="#login" class="btn btn-light btn-lg rounded-pill" style="background-color: #F9A826 !important; border-color:#f8a51f !important ;padding-top: 16px; padding-bottom:16px; padding-left: 20px; padding-right: 20px;" >Create my CV</button> 
        </div>
        <div id="icono">
            <div id="title"> <p>Create Your CV for Free!</p><p id="chiquito">Only need to login</p></div>
            <div id="imagen"></div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mx-5">
                <div class="modal-header text-center">
                    <h1 class="modal-title w-100 login_title"><b>Log In</b></h1>
                </div>

                <div class="modal-body mx-3">
                    <form action="general/login" method="post">
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Email or Username" name="username">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                    <div class="row">
                        <div class="col-12 text-center mb-2">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                    </div>
                    
                    <p class="mb-4 text-xs">
                        <a href="#">Forgot Password?</a>
                    </p>
                    
                    
                    <div class="text-center">
                        <p>Don't have an account? <a href="#register" data-toggle="modal" data-dismiss="modal">Create one</a></p>
                    </div>
                    </form>    
                </div>
    
            </div>
        </div>
    </div>
    
    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mx-5">
                <div class="modal-header text-center">
                    <h1 class="modal-title w-100 register_title"><b>Sign Up</b></h1>
                </div>

                <div class="modal-body mx-3">
                    <form action="general/register" method="post">
                    <p class="login-box-msg">Register a new membership</p>
                    <form action="general/register" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <button type="submit" class="btn btn-success btn-block">Sign Up</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<!-- style="height: 667px;" -->

    <!-- <div class="allign-middle">
            <button type="button" class="btn btn-secondary btn-lg">CREATE MY CV</button>
    </div> -->

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
