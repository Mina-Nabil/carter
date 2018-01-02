
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Message</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Message Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Message English Title</label>
                                            <input class="form-control" name='messageTitle' value='<?=$MSGS_TITLE?>' <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                            <p class="help-block">Enter Message Title, Example: Late Driver?.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Message English Text</label>
                                            <textarea class="form-control" name='messageText' <?if($disabled) echo 'readonly'; else echo 'required'?>><?=$MSGS_TEXT?></textarea>
                                            <p class="help-block">Enter Message Text.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <select class="form-control" name='messageClientID' <?if($disabled) echo 'readonly'; else echo 'required'?>>
                                              <?foreach($Clients as $client){?>
                                                  <option value=<?=$client['CLNT_ID']?> <?if($MSGS_CLNT_ID == $client['CLNT_ID'])  echo 'selected';?> required><?=$client['CLNT_NAME']?></option>
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
