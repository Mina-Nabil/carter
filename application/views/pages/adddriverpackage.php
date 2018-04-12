
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Driver Package</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Driver Package Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                        <div class="form-group">
                                            <label>Driver Package Name</label>
                                            <input class="form-control" name='pckgName' type="text" value='<?=$DPKG_NAME?>' required>
                                            <p class="help-block">Enter Driver Package Name: A</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Package Trips Per Day</label>
                                            <input class="form-control" name='pckgTrips' type="text" value='<?=$DPKG_TRIPS?>' required>
                                            <p class="help-block">Enter Driver Package Trips Per Day: 3.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Driver Package Price Per Day</label>
                                            <input class="form-control" name='pckgPrice' type="text" value='<?=$DPKG_PRICE?>' required>
                                            <p class="help-block">Enter Driver Package Price Per Day, Example: 140.</p>
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
