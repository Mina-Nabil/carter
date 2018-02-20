
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Privilage</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Page and User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                      <div class="form-group">
                                          <label>User Name</label>
                                          <select class="form-control" name='privilageUserID' required>
                                            <?foreach($Users as $users){?>
                                                <option value=<?=$users['USR_ID']?>  required><?=$users['USR_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <select class="form-control" name='privilagePageID' required>
                                              <?foreach($Pages as $pages){?>
                                                  <option value=<?=$pages['PAGE_ID']?> required><?=$pages['PAGE_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                          <label>All Privilages</label> <br>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" name="allPriv" value="1"   >Give All Privilages
                                          </label>
                                        </div>
                                        <button type="submit" class="btn btn-submit">Submit Button</button>
                                        <button type="reset" class="btn btn-danger">Reset Button</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
