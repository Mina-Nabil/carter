
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Station</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Live Line Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                      <div class="form-group">
                                          <label>Line Name</label>
                                          <select class="form-control" name='livelineLineID'>
                                            <?foreach($Lines as $line){?>
                                                <option value=<?=$line['LINE_ID']?> <?if($LVLN_LINE_ID == $line['LINE_ID'])  echo 'selected';?> required><?=$line['LINE_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Driver Name</label>
                                          <select class="form-control" name='livelineDriverID'>
                                            <?foreach($Drivers as $driver){?>
                                                <option value=<?=$driver['DRVR_ID']?> <?if($LVLN_DRVR_ID == $driver['DRVR_ID'])  echo 'selected';?> required><?=$driver['DRVR_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Line Name</label>
                                          <select class="form-control" name='livelineBusID'>
                                                <option value='' >Not Available</option>
                                            <?foreach($Buses as $bus){?>
                                                <option value=<?=$bus['BUS_ID']?> <?if($LVLN_BUS_ID == $bus['BUS_ID'])  echo 'selected';?> required><?=$bus['BUS_TYPE'] . '/' . $bus['BUS_NUMBER']?></option>
                                            <?}?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Line Time</label>
                                          <input class=form-control name=livelineTime type=datetime-local value='<?if($LVLN_TIME != '') echo date("Y-m-d\TH:i", $Timestamp); else echo date("Y-m-d\TH:i");?>' required>
                                      </div>


                                        <div class="form-group">
                                            <label>Live Line Completed?</label>
                                            <select class="form-control" name='livelineisComplete'>
                                              <option value=0 <?if($LVLN_COMP == 0)  echo 'selected';?>>False</option>
                                              <option value=1 <?if($LVLN_COMP == 1)  echo 'selected';?>>True</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Live Line Cancelled?</label>
                                            <select class="form-control" name='livelineisCancelled'>
                                              <option value=0 <?if($LVLN_CANC == 0)  echo 'selected';?>>False</option>
                                              <option value=1 <?if($LVLN_CANC == 1)  echo 'selected';?>>True</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Live Line Arabic Revenue</label>
                                            <input class="form-control" name='livelineRevenue' type="number" step="0.01" value='<?=$LVLN_REVN?>'>
                                            <p class="help-block">Enter Live Line Revenue.</p>
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
