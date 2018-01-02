
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Favourite Line</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Favourite Line Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                      <div class="form-group">
                                          <label>Line Name</label>
                                          <select class="form-control" name='favourite_lineLineID'>
                                            <?foreach($Lines as $line){?>
                                                <option value=<?=$line['LINE_ID']?> <?if($FVLN_LINE_ID == $line['LINE_ID'])  echo 'selected';?> required><?=$line['LINE_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Client Name</label>
                                          <select class="form-control" name='favourite_lineClientID'>
                                            <?foreach($Clients as $client){?>
                                                <option value=<?=$client['CLNT_ID']?> <?if($FVLN_CLNT_ID == $client['CLNT_ID'])  echo 'selected';?> required><?=$client['CLNT_NAME']?></option>
                                            <?}?>
                                          </select>
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
