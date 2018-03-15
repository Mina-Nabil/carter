
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add AboutUs</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter About Us Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>About Us English Title</label>
                                            <input class="form-control" name='aboutusTitle' value='<?=$ABUT_TITLE?>' required>
                                            <p class="help-block">Enter About Us English Title, Example: How to login?.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>About Us English Text</label>
                                            <textarea class="form-control" name='aboutusText' required><?=$ABUT_TEXT?></textarea>
                                            <p class="help-block">Enter About Us Text.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>About Us Arabic Title</label>
                                            <input class="form-control" name='aboutusArbcTitle' type="text" value='<?=$ABUT_ARBC_TITLE?>' required>
                                            <p class="help-block">Enter About Us Arabic Title.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>About Us Arabic Text</label>
                                            <textarea class="form-control" name='aboutusArbcText' required><?=$ABUT_ARBC_TEXT?></textarea>
                                            <p class="help-block">Enter About Us Arabic Text.</p>
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
