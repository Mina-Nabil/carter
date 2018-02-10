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
                                        <td><?=$data['PSHL_TITLE']?></td>
                                        <td><?=$data['PSHL_TEXT']?></td>
                                        <td><?
                                        if($data['PSHL_TARGET'] == 1) echo 'All Users';
                                        if($data['PSHL_TARGET'] == 2) echo 'Top Users';
                                        if($data['PSHL_TARGET'] == 1) echo 'Specific User';
                                        ?></td>
                                        <td><?=$data['USR_NAME']?></td>
                                        <td><?=$data['CLNT_NAME']?></td>
                                        <td><?=$data['CLNT_TEL']?></td>
                                    </tr>
                                   <?}?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?=base_url() . "push"?>" class="btn btn-submit">Back</button>
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
