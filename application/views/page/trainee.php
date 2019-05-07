 <div class="row">

   <div class="col-md-4 order-md-2 mb-4"></div>
       
 	<div class="col-md-8 order-md-1">

 		<?php if($this->session->userdata('register')) {?>

       <form class="needs-validation" validate="true" action="<?=base_url('trainee/create');?>" method="post">

         <div class="row">

           <div class="col-md-6 mb-3">

             <label for="firstName">Эцэг эхийн нэр:</label>

             <input type="text" readonly class="form-control-plaintext" name="firstname" id="firstname" placeholder="Эцэг эхийн нэрээ оруулна уу" value="<?=$trainee->firstname;?>" >

             <div class="invalid-feedback">

               Эцэг эхийн нэрээ оруулах шаардлагтай

             </div>

           </div>

           <div class="col-md-6 mb-3">

             <label for="lastName">Өөрийн нэр:</label>

             <input type="text" readonly class="form-control-plaintext"  id="lastName" name="lastname" placeholder="Өөрийн нэрээ оруулна уу" value="<?=$trainee->lastname;?>" required>

             <div class="invalid-feedback">

               Valid last name is required.

             </div>

           </div>

         </div>

         <div class="mb-3">
           <label for="username">Регистрийн дугаар:</label>

           <div class="input-group">

             <input type="text" readonly class="form-control-plaintext" id="register"  name="register" placeholder="Регистрийн дугаараа оруулна уу!" required="" value="<?=$trainee->register;?>">

             <div class="invalid-feedback" style="width: 100%;">

               Регистрийн дугаар утга шаардлагатай

             </div>
           </div>
         </div>

         <div class="mb-3">
           
           <label for="job">Ажилд орохыг хүсэж буй ажлын  байр</label>
               
               <select class="custom-select d-block w-100" id="jobtype" name="jobtype" required="">
               <option value="">Сонгох...</option>
               <option value="1">Програм хангамжийн инженер</option>
               <option value="2">Холбооны инженер</option>
               <option value="3">Навигацийн инженер</option>
               <option value="4">Ажиглалтын инженер</option>
               <option value="5">United States</option>
             </select>


         </div>


         <button class="btn btn-primary btn-lg btn-block" type="submit">Бүртгүүлэх</button>

       </form>

    <?php } ?>

   </div>

 </div>
