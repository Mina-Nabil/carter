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
                                        <td><?=$data['DIST_ID']?></td>
                                        <td><?=$data['DIST_NAME']?></td>
                                        <td><?=$data['DIST_ARBC_NAME']?></td>
                                        <td><?=$data['CITY_NAME']?></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/modify/' . $data['DIST_ID']?>'><img src=<?=base_url() . 'images/edit.png'?> style='width:30px;height:30px;'></a></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/delete/' . $data['DIST_ID']?>'><img src=<?=base_url() . 'images/del.png'?> style='width:30px;height:30px;'></a></td>
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
