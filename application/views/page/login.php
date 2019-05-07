  <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>ИНЕГ-ын цахим шалгалтын систем</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('public/assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url('public/assets/css/signin.css');?>" rel="stylesheet">
  </head>

  <body class="text-center">



  <form class="form-signin" method="post" action="<?=base_url('admin/login/');?>">

      <?php  if($this->session->flashdata('error')){ ?>

        <div class="alert alert-danger" role="alert">

          <?=$this->session->flashdata('error')?>

        </div>

      <?php } ?>

      <h1 class="h3 mb-3 font-weight-normal">Нэвтрэх хэсэг</h1>

      <label for="inputEmail" class="sr-only">Имэйл хаяг</label>

      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">

      <label for="inputPassword" class="sr-only">Password</label>

      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">

      <div class="checkbox mb-3">

<!--         <label>

          <input type="checkbox" name="rememberme" value="remember-me"> Сануулах

        </label> -->

      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Нэвтрэх</button>

      <a class="btn btn-lg btn-block btn-warning">Буцах</a>


      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>


    </form>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>

    <script src="<?=base_url('public/assets/js/bootstrap.min.js');?>"></script>

  </body>

</html>
