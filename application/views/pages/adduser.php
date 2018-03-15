
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter User Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input class="form-control" name='userName' value='<?=$USR_NAME?>' required>
                                            <p class="help-block">Enter Usename, Example: ahmed12.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>User Password</label>
                                            <input class="form-control" name='userPass' type="password" value='<?=$USR_PASS?>' required>
                                            <p class="help-block">Enter User Password</p>
                                        </div>

                                        <div class="form-group">
                                            <label>User Type</label>
                                            <select class="form-control" name='userCityID'>
                                              <option value=ADMIN>Admin User</option>
                                              <option value=USER>Normal User</option>
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
