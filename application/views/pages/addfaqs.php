
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Faqs</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Faqs Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Faqs English Title</label>
                                            <input class="form-control" name='faqsTitle' value='<?=$FAQS_TITLE?>' required>
                                            <p class="help-block">Enter Faqs English Title, Example: How to login?.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Faqs English Text</label>
                                            <textarea class="form-control" name='faqsText' required><?=$FAQS_TEXT?></textarea>
                                            <p class="help-block">Enter Faqs Text.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Faqs Arabic Title</label>
                                            <input class="form-control" name='faqsArbcTitle' type="text" value='<?=$FAQS_ARBC_TITLE?>' required>
                                            <p class="help-block">Enter Faqs Arabic Title.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Faqs Arabic Text</label>
                                            <textarea class="form-control" name='faqsArbcText' required><?=$FAQS_ARBC_TEXT?></textarea>
                                            <p class="help-block">Enter Faqs Arabic Text.</p>
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
