
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add District</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter District Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>District Name</label>
                                            <input class="form-control" name='districtName' value='<?=$DIST_NAME?>'>
                                            <p class="help-block">Enter District Name, Example: Nasr City, El Rehab.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>District Arabic Name</label>
                                            <input class="form-control" name='districtArbcName' value='<?=$DIST_ARBC_NAME?>'>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Cities</label>
                                            <select class="form-control" name='districtCityID'>
                                              <?foreach($Cities as $city){?>
                                                  <option value=<?=$city['CITY_ID']?> <?if($DIST_CITY_ID == $city['CITY_ID'])  echo 'selected';?> ><?=$city['CITY_NAME']?></option>
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
