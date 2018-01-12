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
                                        <td><?=$data['LINE_NAME']?></td>
                                        <td><?=$data['CLNT_NAME']?></td>
                                        <td><?=$data['START_STTN']?></td>
                                        <td><?=$data['END_STTN']?></td>
                                        <td><?=$data['PATH_REL_TIME']?></td>
                                        <td><?=$data['TRTK_CANC']?></td>
                                        <td><?=$data['TRTK_COMP']?></td>
                                        <td><?=$data['TRTK_REVN']?></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/modify/' . $data['TRTK_ID']?>'><img src=<?=base_url() . 'images/edit.png'?> style='width:30px;height:30px;'></a></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/delete/' . $data['TRTK_ID']?>'><img src=<?=base_url() . 'images/del.png'?> style='width:30px;height:30px;'></a></td>
                                    </tr>
                                   <?}?>
                                </tbody>
                            </table>
                        </div>
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
