        <h2>Ажлын байранд шалгуулагчдын мэдээлэл</h2>

        <button class="btn btn-success" onclick="addEstudiante()"><i class="glyphicon glyphicon-plus"></i>Шинэ ажил горилогч</button>

        <button class="btn btn-default" onclick="reloadTable()"><i class="glyphicon glyphicon-refresh"></i>Дахин дуудах</button>

        <button id="deleteList" class="btn btn-danger" style="display: none;" onclick="deleteList()"><i class="glyphicon glyphicon-trash"></i>Жагсаалтаар устгах</button>

        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Нэр</th>
                    <th>Овог</th>
                    <th>Регистер</th>
                    <th>Сорил_өгсөн эсэх</th>
                    <th>Сорилын оноо</th>
                    <th>Сорил өгсөн огноо</th>
                    <th style="width:150px;">Үйлдэл</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Нэр</th>
                    <th>Овог</th>
                    <th>Регистер</th>
                    <th>Сорил_өгсөн эсэх</th>
                    <th>Сорилын оноо</th>
                    <th>Сорил өгсөн огноо</th>
                    <th>Үйлдэл</th>
                </tr>
            </tfoot>
        </table>


        <!--Bootstrap modal -->
        <div class="modal fade"  id="modal_form"  tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title">Шалгуулагч нэмэх</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

              <div class="modal-body">

                <form action="#" id="form" class="form-horizontal needs-validation" novalidate>

                    <input type="hidden" value="" name="id"/>

                    <div class="form-group">
                         <div class="col-md-9">
                             <input name="trainee_id" class="form-control" type="hidden">
                             <span class="help-block"></span>
                         </div>
                     </div>

                    <div class="form-group">

                      <div class="col-md-9">

                        <label for="firstname" class="col-form-label">Овог нэр:</label>

                        <input type="text" class="form-control" id="firstname" name="firstname">

                      </div>

                    </div>

                    <div class="form-group">

                      <div class="col-md-9">

                        <label for="lastname" class="col-form-label">Нэр:</label>

                        <input type="text" name="lastname" class="form-control" id="lastname">

                        <span class="help-block"></span>

                      </div>

                    </div>

                    <div class="form-group">

                      <div class="col-md-9">

                        <label for="register" class="col-form-label">Регистр:</label>

                        <input type="text" name="register" class="form-control" id="register">

                        <span class="help-block"></span>

                      </div>

                    </div>

                    <!-- <div class="form-group">

                      <div class="col-md-9">

                        <label for="active" class="col-form-label">Идэвхтэй:</label>

                        <input type="text" name="test_given" class="form-control" id="test_given">

                        <span class="help-block"></span>

                      </div>

                    </div> -->



                </form>
              </div>
              <div class="modal-footer">
                <button type="button"  onclick="save()" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bootstrap modal-->

        <script src="<?=base_url('public/assets/app/admin.js');?>"></script>
