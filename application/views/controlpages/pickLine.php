
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pick Line</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pick the line to edit from the list
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . 'paths/redirect'?>' method="post">
                                      <div class="form-group">
                                          <label>Line Name</label>
                                          <select class="form-control" name='ID' required>
                                            <?foreach($Lines as $lines){?>
                                                <option value=<?=$lines['LINE_ID']?> required><?=$lines['LINE_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                        <button type="submit" class="btn btn-submit">Submit Button</button>
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
