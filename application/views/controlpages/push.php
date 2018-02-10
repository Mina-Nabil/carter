<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Push Notifications</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-center">
                                    <div class="huge"><?=$AllUsersCount?></div>
                                    <div>Total PN sent</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>push/getAllPn">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-center">
                                    <div class="huge"><?=$TopUsersCount?></div>
                                    <div>Top Users PN</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>push/getTopUsersPn">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-center">
                                    <div class="huge"><?=$SpcUsersCount?></div>
                                    <div>Specific User PN</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>push/getSpmsgsPn">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
          <!--HeaderRow-->
          <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                         Send Push Notification
                      </div>
                      <div class="panel-body">
                          <div class="row">
                              <div class="col-lg-6">
                                  <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                      <div class="form-group">
                                          <label>Message Title</label>
                                          <input class="form-control" name='messageTitle' required>
                                      </div>
                                      <div class="form-group">
                                          <label>Message Text</label>
                                          <textarea class="form-control" name='messageText' required></textarea>
                                      </div>

                                      <div class="form-group">
                                          <label>Client Name</label>
                                          <select class="form-control" name='messageClient' required>

                                            <option value='0##All' required>AllClients</option>
                                            <option value='0##Top' required>TopUsers</option>
                                            <?foreach($Clients as $client){?>
                                                <option value=<?=$client['CLNT_ID'] . '##' . $client['CLNT_TAG']?> required><?=$client['CLNT_NAME'].' - '. $client['CLNT_TEL']?></option>
                                            <?}?>
                                          </select>
                                      </div>
                                      <button type="submit" class="btn btn-submit">Submit Button</button>
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
</div>
