
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Station</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Station Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Station Name</label>
                                            <input class="form-control" name='stationName' value='<?=$STTN_NAME?>' required>
                                            <p class="help-block">Enter Station Name, Example: Madinet Nasr - Awel Abbas.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Station Latitude</label>
                                            <input class="form-control" name='stationLatitude' type="number" step="0.000000000000001" value='<?=$STTN_LATT?>' required>
                                            <p class="help-block">Enter Station Latitude.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Station Longitude</label>
                                            <input class="form-control" name='stationLong' type="number" step="0.000000000000001" value='<?=$STTN_LONG?>'>
                                            <p class="help-block">Enter Station Longitude.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Station Arabic Address</label>
                                            <input class="form-control" name='stationArbcAdrs' type="text" value='<?=$STTN_ARBC_ADRS?>'>
                                            <p class="help-block">Enter Station Arabic Address.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Station English Address</label>
                                            <input class="form-control" name='stationAddress' type="text" value='<?=$STTN_ADRS?>' required>
                                            <p class="help-block">Enter Station English Address.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <select class="form-control" id="selectcity" >
                                              <?foreach($Cities as $city){?>
                                                  <option class="<?=$city['CITY_ID']?>" required><?=$city['CITY_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>District Name</label>
                                            <select class="form-control" id="selectdist" name='stationDistrictID'>
                                              <?foreach($Districts as $district){?>
                                                  <option value=<?=$district['DIST_ID']?> class="selectors <?=$district['DIST_CITY_ID']?>" <?if($STTN_DIST_ID == $district['DIST_ID'])  echo 'selected';?> required><?=$district['DIST_NAME']?></option>
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
