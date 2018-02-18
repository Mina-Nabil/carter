<div id="page-wrapper">
<!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?=$Table_Name?>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                      <?foreach($TableHeaders as $header){?>
                                       <th><?=$header?></th>
                                     <?}?>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?foreach($TableData as $data){?>
                                    <tr class="odd gradeX">
                                      <td><?=$data['PAGE_TYPE']?></td>
                                      <td><?=$data['PAGE_NAME']?></td>
                                      <td><?=$data['USR_NAME']?></td>
                                    </tr>
                                   <?}?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?=base_url() . "users"?>" class="btn btn-primary btn-lg" role="button">Back</a>
                        <a href="<?=base_url() . "addprivilages/" . $USR_ID?>" class="btn btn-primary btn-lg" role="button">Add</a>
                        <!-- /.table-responsive -->
                        <div class="well">
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div>
