        <h2>Сорилууд</h2>

        <!-- <button class="btn btn-success" onclick="addEstudiante()"><i class="glyphicon glyphicon-plus"></i>Шинэ ажил горилогч</button> -->

        <a class="btn btn-primary" role="button" target="_blank" href="<?=base_url('public/import/index.php');?>">Шалгалт импортлох</a>

        <button class="btn btn-default" onclick="reloadTable()"><i class="glyphicon glyphicon-refresh"></i>Дахин дуудах</button>

        <button id="deleteList" class="btn btn-danger" style="display: none;" onclick="deleteList()"><i class="glyphicon glyphicon-trash"></i>Жагсаалтаар устгах</button>

        <!-- <div>
            <label>Шалгалт сонгох <label>
              <select class="custom-select d-block w-30" id="jobtype" name="jobtype" required="">
                <option value="">Сонгох...</option>
                <option value="1">Програм хангамжийн инженер</option>
                <option value="2">Холбооны инженер</option>
                <option value="3">Навигацийн инженер</option>
                <option value="4">Ажиглалтын инженер</option>
              </select>

          </div> -->

  <!-- Ene hesegt Dropdown-d songoson haragalzah shalgaltiig asuulttai ni haruuldag on chance event ajiluulya -->
      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>
                  <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Сорил</th>
                    <!-- <th>Ажлын байр</th> -->
                    <th>Үүсгэсэн</th>
                    <th style="width:150;">Үйлдэл</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Сорил</th>
                    <!-- <th>Ажлын байр</th> -->
                    <th>Үүсгэсэн</th>
                    <th style="width:150;">Үйлдэл</th>
                </tr>
            </tfoot>
        </table>

        <!--Bootstrap modal -->
        <div class="modal fade"  id="modal_form"  tabindex="-1" role="dialog">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title">Сорил нэмэх</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

              <div class="modal-body">


                <form method="get" action="<?=base_url('/test/import');?>" id="form" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" class="form-horizontal needs-validation">

                    <input type="hidden" value="" name="id"/>

                    <div class="form-group">

                         <div class="col-md-9">

                             <input name="test_id" class="form-control" type="hidden">

                             <span class="help-block"></span>

                         </div>
                     </div>

                    <!-- <div class="form-group">

                      <div class="col-md-9">

                        <label for="register" class="col-form-label">Ажлын байрнууд</label>



                        <span class="help-block"></span>

                      </div>

                    </div> -->

                    <div class="form-group">
                      <div class="col-md-9">

                        <label>Choose Excel
                            File</label> <input type="file" name="file"
                            id="file" accept=".xls,.xlsx">


                      </div>
                    </div>




              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submit" name="import">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <!-- End Bootstrap modal-->

        <script src="<?=base_url('public/assets/app/test.js');?>"></script>
