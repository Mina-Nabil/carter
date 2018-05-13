
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enter Report Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Report Parameters
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Driver Name</label>
                                            <select class="form-control" name='repDriverID'>
                                              <?foreach($Drivers as $driver){?>
                                                  <option ><?=$driver['DRVR_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>
                                        <label>Start Time</label>
                                        <input
                                        class=form-control name=startTime
                                        type=datetime-local
                                        required>

                                        <label>End Time</label>
                                        <input
                                        class=form-control name=endTime
                                        type=datetime-local
                                        required>

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
