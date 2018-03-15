
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Article</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Article Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Article English Title</label>
                                            <input class="form-control" name='articleTitle' value='<?=$RTCL_TITLE?>' required>
                                            <p class="help-block">Enter Article English Title, Example: Did you know that?.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Article English Text</label>
                                            <textarea class="form-control" name='articleText' required><?=$RTCL_TEXT?></textarea>
                                            <p class="help-block">Enter Article Text.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Article Arabic Title</label>
                                            <input class="form-control" name='articleArbcTitle' type="text" value='<?=$RTCL_ARBC_TITLE?>' required>
                                            <p class="help-block">Enter Article Arabic Title.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Article Arabic Text</label>
                                            <textarea class="form-control" name='articleArbcText' required><?=$RTCL_ARBC_TEXT?></textarea>
                                            <p class="help-block">Enter Article Arabic Text.</p>
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
