<div id="page-wrapper">
<!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Driver Report
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
                                        <td><?=$data['LVLN_TIME']?></td>
                                        <td><?=$data['LINE_NAME']?></td>
                                        <td><?=$data['DPKG_NAME']?></td>
                                        <td><?=$data['DRVR_NAME']?></td>
                                        <td><?=$data['LVLN_TCKT_PRICE']?></td>
                                        <td><?=$data['Tickets'] . '/' . $data['Tickets_Canc']?></td>
                                        <td><?=$data['Clients_Arr'] . '/' . $data['Clients_Missed']?></td>
                                        <td><?=$data['Paid_total']?></td>
                                        <td><?=$data['Paid_cash'] . '/' . $data['Paid_Visa']?></td>
                                        <td><?=$data['Promo_Count'] . '/' . $data['Promo_total']?></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/modify/' . $data['CLNT_ID']?>'><img src=<?=base_url() . 'images/edit.png'?> style='width:30px;height:30px;'></a></td>
                                        <td class="center"><a href='<?=base_url() . $Url_Name . '/delete/' . $data['CLNT_ID']?>'><img src=<?=base_url() . 'images/del.png'?> style='width:30px;height:30px;'></a></td>
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
