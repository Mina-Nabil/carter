
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Line</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Line Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                        <div class="form-group">
                                            <label>Line Name</label>
                                            <input class="form-control" name='lineName' type="text" value='<?=$LINE_NAME?>' required>
                                            <p class="help-block">Enter Line Name, Example: Rehab - EL Giza 1 </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Line Arabic Name</label>
                                            <input class="form-control" name='lineArbcName' type="text" value='<?=$LINE_ARBC_NAME?>' required>
                                        </div>
                                        <div class="form-group">
                                            <label>Line Description</label>
                                            <input class="form-control" name='lineDesc' type="text" value='<?=$LINE_DESC?>'>
                                            <p class="help-block">Enter Line Description.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Line Tags</label>
                                            <input class="form-control" name='lineTags' type="text" value='<?=$LINE_TAGS?>'>
                                            <p class="help-block">Enter Line Tags, Keyword used for search. Example: مستشفي السلام, محطه مصر</p>
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
