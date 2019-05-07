    <header>
      <!-- Fixed navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		  <a class="navbar-brand" href="#">Цахим шалгалтын систем</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarColor01">

		    <ul class="navbar-nav mr-auto">

		    	<?php if($this->session->userdata('loggedin')==TRUE) { ?>

		      <li class="nav-item">

		        <a class="nav-link" href="<?=base_url('admin')?>">Ажил сонирхогчид <span class="sr-only">(current)</span></a>

		      </li>
		      <li class="nav-item">

		        <a class="nav-link" href="<?=base_url('test')?>">Сорилууд</a>

		      </li>

		      <li class="nav-item">

		        <a class="nav-link" href="#">Шалгалтын үр дүн</a>

		      </li>

		     <?php } ?>

		      <li class="nav-item">

		        <a class="nav-link" href="#">Системийн тухай</a>

		      </li>
		    </ul>
		    <form class="form-inline my-2 my-lg-0">

		    <?php if($this->session->userdata('loggedin')==TRUE) { ?>

					<div class="btn-group">

					  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

					    <?=$this->session->userdata('name');?>

					  </button>

					  <div class="dropdown-menu">

					    <a class="dropdown-item" href="#">Action</a>
					    <a class="dropdown-item" href="#">Something else here</a>

					    <div class="dropdown-divider"></div>

					    <a class="dropdown-item" href="#">Гарах</a>

					  </div>
					</div>


		    		<?php } else { ?>

		            <a href="<?=base_url('/admin/login')?>" class="btn btn-secondary my-2 my-sm-0" type="submit">Админ</a>

		         <?php } ?>


		    </form>
		  </div>
		</nav>
	</header>

	<div class="container">
