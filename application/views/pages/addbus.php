
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Bus</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Bus Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Bus Type</label>
                                            <input class="form-control" name='busType' value='<?=$BUS_TYPE?>' required>
                                            <p class="help-block">Enter Bus Type, Example: Toyota.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Bus Plate Number</label>
                                            <input class="form-control" name='busNumber' type="text" value='<?=$BUS_NUMBER?>' required>
                                            <p class="help-block">Enter Bus Plate Number: ف ق ف 855.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Bus Seat Count</label>
                                            <input class="form-control" name='busSeats' type="text" value='<?=$BUS_SEATS?>' required>
                                            <p class="help-block">Enter Bus Seats Number, Example: 14.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Name</label>
                                            <select class="form-control" name='busDriverID'>
                                              <?foreach($Drivers as $driver){?>
                                                  <option value=<?=$driver['DRVR_ID']?> <?if($BUS_DRVR_ID == $driver['DRVR_ID'])  echo 'selected';?>><?=$driver['DRVR_NAME']?></option>
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
