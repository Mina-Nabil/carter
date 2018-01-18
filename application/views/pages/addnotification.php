
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Notification</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Notification Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Notification English Title</label>
                                            <input class="form-control" name='notificationTitle' value='<?=$NOTF_TITLE?>' required>
                                            <p class="help-block">Enter Notification English Title, Example: Did you know that?.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Notification English Text</label>
                                            <textarea class="form-control" name='notificationText' required><?=$NOTF_TEXT?></textarea>
                                            <p class="help-block">Enter Notification Text.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Notification Arabic Title</label>
                                            <input class="form-control" name='notificationArbcTitle' type="text" value='<?=$NOTF_ARBC_TITLE?>' required>
                                            <p class="help-block">Enter Notification Arabic Title.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Notification Arabic Text</label>
                                            <textarea class="form-control" name='notificationArbcText' required><?=$NOTF_ARBC_TEXT?></textarea>
                                            <p class="help-block">Enter Notification Arabic Text.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Notification From Time</label>
                                            <input class=form-control
                                            name='notificationFrom'
                                            type=datetime-local
                                            value='<?if($NOTF_FROM != '') echo date("Y-m-d\TH:i", $FromTimestamp); else echo date("Y-m-d\TH:i");?>'
                                            required>
                                        </div>

                                        <div class="form-group">
                                            <label>Notification To Time</label>
                                            <input class=form-control
                                            name='notificationTo'
                                            type=datetime-local
                                            value='<?if($NOTF_TO != '') echo date("Y-m-d\TH:i", $ToTimestamp); else echo date("Y-m-d\TH:i");?>'
                                            required>
                                        </div>
                                        <div class="form-group">
                                            <label>Notification Image</label>
                                            <input class="form-control" name='notificationImage' type="text" value='<?=$NOTF_IMG?>' required>
                                            <p class="help-block">Enter Notification Arabic Title.</p>
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
