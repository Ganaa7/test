  <div class="text-left mb-5">

      <h2>Шалгуулагчийн мэдээлэл</h2>

  </div>

  <?php $message = $this->session->flashdata('message');

       if(isset($message['status'])){
        ?>

        <div class="alert alert-danger" role="alert">

          <?php echo $message['message']; ?>

        </div>

    <?php    } ?>

  <div class="row">

        <div class="col-md-4 order-md-2 mb-4"></div>

       <div class="col-md-8 order-md-1">

          <form class="needs-validation" validate="true" action="<?=base_url('trainee/create');?>" method="post">
            <div class="row">

              <div class="col-md-6 mb-3">

                <label for="firstName">Эцэг эхийн нэр:</label>

                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Эцэг эхийн нэрээ оруулна уу" value="" required>

                <div class="invalid-feedback">

                  Эцэг эхийн нэрээ оруулах шаардлагтай

                </div>
              </div>

              <div class="col-md-6 mb-3">

                <label for="lastName">Өөрийн нэр:</label>

                <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Өөрийн нэрээ оруулна уу" value="" required>

                <div class="invalid-feedback">

                  Valid last name is required.

                </div>

              </div>

            </div>

            <div class="mb-3">
              <label for="username">Регистрийн дугаар:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="register"  name="register" placeholder="Регистрийн дугаараа оруулна уу!" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Регистрийн дугаар утга шаардлагатай
                </div>
              </div>
            </div>

            <div class="mb-3">

              <label for="job">Ажилд орохыг хүсэж буй ажлын  байр</label>

                  <?=form_dropdown('test_id', $test, null, 'class="custom-select d-block w-100"');?>

                   <!-- <select class="custom-select d-block w-100" id="jobtype" name="jobtype" required=""> -->
                   <!-- <option value="">Сонгох...</option> -->
                   <!-- <option value="1">Програм хангамжийн инженер</option> -->
                   <!-- <option value="2">Холбооны инженер</option> -->
                   <!-- <option value="3">Навигацийн инженер</option> -->
                   <!-- <option value="4">Ажиглалтын инженер</option> -->
                   <!-- <option value="5">United States</option> -->
                 <!-- </select> -->


            </div>


<!--             <hr class="mb-4">

            <div class="custom-control custom-checkbox">

              <input type="checkbox" class="custom-control-input" id="same-address">

              <label class="custom-control-label" for="same-address">Цахим шалгалтын дүнг би хүлээн зөвшөөрч байна</label>

            </div>


            <hr class="mb-4"> -->

            <button class="btn btn-primary btn-lg btn-block" type="submit">Бүртгүүлэх</button>

          </form>
        </div>

      </div>
