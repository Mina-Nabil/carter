
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Balance Log</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter BalanceLog Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                      <div class="form-group">
                                          <label>Client Name</label>
                                          <select class="form-control" name='balancelogClientID' <?if($DropdownDisabled) echo 'readonly'?> required>
                                            <?foreach($Clients as $client){?>
                                                <option value=<?=$client['CLNT_ID']?> <?if($BLOG_CLNT_ID == $client['CLNT_ID'])  echo 'selected';?>><?=$client['CLNT_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>
                                        <div class="form-group">
                                            <label>Balance Change</label>
                                            <input class="form-control" name='balancelogChange' type=number step=0.01 value='<?=$BLOG_CHNG?>' <?if($DropdownDisabled) echo 'readonly'?> required>
                                            <p class="help-block">Enter Change value, Example: 52.50</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Balance Change Date</label>
                                            <input class="form-control" name='balancelogDate' type=datetime-local value='<?if($BLOG_DATE != '') echo date("Y-m-d\TH:i", $Timestamp); else echo date("Y-m-d\TH:i");?>' <?if($DropdownDisabled) echo 'readonly'?> required>
                                            <p class="help-block">Pick the date</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <input class="form-control" name='balancelogComment' type="text" value='<?=$BLOG_CMMT?>' required>
                                            <p class="help-block">Enter a Relative Comment</p>
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
