
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Driver</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Driver Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label>Driver Image</label>
                                        <?if($DRVR_IMG != '') {?>
                                          <center><img src=<?=base_url() ."uploads/drivers/" . $DRVR_IMG?> style="width:200px;height:300px;"></center>
                                          <input hidden="true" type="text" value ="<?=$DRVR_IMG?>" name='driverOldImg'>
                                        <?}?>
                                        <input class="form-control" name='driverImg' type="file">
                                        <p class="help-block">Choose Image File from the computer. <br><strong>If driver's image appear don't choose a new image</strong></p>
                                      </div>

                                      <div class="form-group">
                                          <label>Driver Username</label>
                                          <input class="form-control" name='driverUsername' type="text" value='<?=$DRVR_UNAME?>'>
                                          <p class="help-block">Enter Driver Username, Example: mmohamed123.</p>
                                      </div>
                                        <div class="form-group">
                                            <label>Driver Name</label>
                                            <input class="form-control" name='driverName' value='<?=$DRVR_NAME?>' required>
                                            <p class="help-block">Enter Driver Full Name, Example: Ahmed Kamel.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Mobile</label>
                                            <input class="form-control" name='driverMobile' value='<?=$DRVR_MOB?>' required>
                                            <p class="help-block">Enter Driver Mobile Number, Example: 0115214036.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver License Number</label>
                                            <input class="form-control" name='driverLicenseNo' type="text" value='<?=$DRVR_LICENSE_NO?>'>
                                            <p class="help-block">Enter Driver License Number Example: 755854.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Driver Password</label>
                                            <input class="form-control" name='driverPass' type="password" value='<?=$DRVR_PASS?>' required>
                                            <p class="help-block">Enter Driver Password.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Balance</label>
                                            <input class="form-control" name='driverBalance' type="number" step="0.01" value='<?=$DRVR_BLNC?>'>
                                            <p class="help-block">Enter Driver Balance, Example: 150.25. Default Balance is 0</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Address</label>
                                            <input class="form-control" name='driverAddress' type="text" value='<?=$DRVR_ADRS?>'>
                                            <p class="help-block">Enter Driver Address. Example: 8 Abbas el Akad St. Nasr City.</p>
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
