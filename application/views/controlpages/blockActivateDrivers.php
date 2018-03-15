
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activate/Block Drivers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pick Driver
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . 'Drivers/ActivateDriver'?>' method="post">
                                      <div class="form-group">
                                          <label>Activate Driver</label>
                                          <select class="form-control" name='driverID'>
                                            <?foreach($Blocked as $driver){?>
                                                <option value=<?=$driver['DRVR_ID']?>><?=$driver['DRVR_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>
                                        <button type="submit" class="btn btn-submit">Submit Button</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . 'Drivers/BlockDriver'?>' method="post">
                                      <div class="form-group">
                                          <label>Block Driver</label>
                                          <select class="form-control" name='driverID'>
                                            <?foreach($Active as $driver){?>
                                                <option value=<?=$driver['DRVR_ID']?>><?=$driver['DRVR_NAME']?></option>
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
