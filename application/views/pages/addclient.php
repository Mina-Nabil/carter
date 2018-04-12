
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Client</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Client Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <input class="form-control" name='clientName' value='<?=$CLNT_NAME?>' required>
                                            <p class="help-block">Enter Client Full Name, Example: Ahmed Kamel.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Telephone</label>
                                            <input class="form-control" name='clientTel' value='<?=$CLNT_TEL?>' required>
                                            <p class="help-block">Enter Client Mobile Number, Example: 0115214036.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Email</label>
                                            <input class="form-control" name='clientEmail' type="email" value='<?=$CLNT_EMAIL?>'>
                                            <p class="help-block">Enter Client Email Example: ahmed@domain.com.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Image URL</label>
                                            <input class="form-control" name='clientImg' type="text" value='<?=$CLNT_IMG?>'>
                                            <p class="help-block">Enter Client Image Url, Example: www.imageserver.com/14as14gb.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Password</label>
                                            <input class="form-control" name='clientPass' type="password" value='<?=$CLNT_PASS?>' required>
                                            <p class="help-block">Enter Client Password.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Balance</label>
                                            <input class="form-control" name='clientBalance' type="number" step="0.01" value='<?=$CLNT_BLNC?>'>
                                            <p class="help-block">Enter Client Balance, Example: 150.25. Default Balance is 0</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Tag</label>
                                            <input class="form-control" name='clientTag' type="text" value='<?=$CLNT_TAG?>'>
                                            <p class="help-block">Enter Client Tag[Development Use], Example: Ashnas45as7a4.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>District Name</label>
                                            <select class="form-control" name='clientDistID'>
                                              <?foreach($Districts as $district){?>
                                                  <option value=<?=$district['DIST_ID']?> <?if($CLNT_DIST_ID == $district['DIST_ID'])  echo 'selected';?> required><?=$district['DIST_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Client's Favourite District</label>
                                            <select class="form-control" name='clientFavDistID'>
                                              <?foreach($Districts as $district){?>
                                                  <option value=<?=$district['DIST_ID']?> <?if($CLNT_FAV_DIST == $district['DIST_ID'])  echo 'selected';?> required><?=$district['DIST_NAME']?></option>
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
