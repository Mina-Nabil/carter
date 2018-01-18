
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Line Request</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Line Request Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <select class="form-control" name='linerequestClientID' <?if($disabled) echo 'readonly'; else echo ' required'?>>
                                              <?foreach($Clients as $client){?>
                                                  <option value=<?=$client['CLNT_ID']?> <?if($LNRQ_CLNT_ID == $client['CLNT_ID'])  echo 'selected'; elseif($disabled) echo 'disabled';?> required><?=$client['CLNT_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Start Station Name</label>
                                            <select class="form-control" name='linerequestStrtSttnID' <?if($disabled) echo 'readonly'; else echo ' required'?>>
                                              <?foreach($Stations as $station){?>
                                                  <option value=<?=$station['STTN_ID']?> <?if($LNRQ_CLNT_ID == $station['STTN_ID'])  echo 'selected'; elseif($disabled) echo 'disabled';?> required><?=$station['STTN_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>End Station Name</label>
                                            <select class="form-control" name='linerequestEndSttnID' <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                              <?foreach($Stations as $station){?>
                                                  <option value=<?=$station['STTN_ID']?> <?if($LNRQ_CLNT_ID == $station['STTN_ID'])  echo 'selected'; elseif($disabled) echo 'disabled';?> required><?=$station['STTN_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Number of seats</label>
                                            <input class="form-control" name='linerequestSeats' value='<?=$LNRQ_SEATS?>' <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                            <p class="help-block">Enter Number of seats requested by user.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Line Start Time</label>
                                            <input class=form-control
                                            name='linerequestStartTime'
                                            type=datetime-local
                                            value='<?if($LNRQ_START_TIME != '') echo date("Y-m-d\TH:i", $StartTimestamp); else echo date("Y-m-d\TH:i");?>'
                                            <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                        </div>

                                        <div class="form-group">
                                            <label>isTwo Way Trip</label>
                                            <select class="form-control" name='linerequestisTwoWays' <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                              <option value=1 <?if($LNRQ_TWO_WAYS != 0)  echo 'selected'; else echo 'disabled';?> required>Yes</option>
                                              <option value=0 <?if($LNRQ_TWO_WAYS == 0)  echo 'selected'; else echo 'disabled';?> required>No</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Line Back Time</label>
                                            <input class=form-control name=linerequestBackTime
                                            type=datetime-local
                                            value='<?if($LNQ_END_TIME != '') echo date("Y-m-d\TH:i", $EndTimestamp); else echo date("Y-m-d\TH:i");?>'
                                              <?if($disabled) echo 'readonly'?>>
                                            <p class="help-block">Enter the time of the return trip in case of two way trip.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Special Line Notes</label>
                                            <textarea class="form-control" name='linerequestNotes' <?if($disabled) echo 'readonly'; else echo 'required'?>><?=$LNRQ_NOTES?></textarea>
                                            <p class="help-block">Enter Client Notes.</p>
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
