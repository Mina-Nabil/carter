
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Path</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Path Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6" >
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                        <div class="form-group">
                                            <label>Line Name</label>
                                            <select class="form-control" name='pathLineID'>
                                              <?foreach($Lines as $line){?>
                                                  <option value=<?=$line['LINE_ID']?> <?if($PATH_LINE_ID == $line['LINE_ID'])  echo 'selected';?> readonly><?=$line['LINE_NAME']?></option>
                                              <?}?>
                                            </select>
                                        </div>

                                          <?$number = 0;?>
                                          <div id="container">
                                          <?foreach ($Path as $point){?>

                                              <label id="labelPoint<?=$number?>">New Point </label>
                                                <div class="form-group" id="point<?=$number?>">
                                                  <label>Station Name</label>
                                                  <select class="form-control" name="pathStationID[<?=$number?>]">
                                                    <?foreach($Stations as $station){?>
                                                        <option value=<?=$station['STTN_ID']?> <?if($point['PATH_STTN_ID'] == $station['STTN_ID'])  echo 'selected';?> required>
                                                          <?=$station['DIST_NAME'] . ' - ' . $station['STTN_NAME']?>
                                                        </option>
                                                    <?}?>
                                                  </select>
                                                  <label>Enter Relative Time</label>
                                                  <input type="text" class="form-control" name="pathRelTime[<?=$number?>]" value='<?=$point['PATH_REL_TIME']?>' required>
                                                  <p class="help-block">Enter Number of minutes from the starting Point.
                                                    Example: In case of, adding Station which is 2 hours away from the starting point, Enter 120</p>
                                                  <a onclick="addInnerField(<?=$number?>)"  class="btn btn-info">Add Point After</a>
                                                  <a onclick="RemoveInput(<?=$number?>)"  class="btn btn-warning">Remove Point</a>
                                                </div>


                                          <?$number = $number + 100; }?>
                                          </div>
                                          <button type="submit" class="btn btn-submit">Submit</button>
                                          <button type="reset" class="btn btn-danger">Reset</button>
                                          <a  onload='setMax(<?=$number?>)' onclick="addFields()" class="btn btn-success">Add New Point</a>

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
