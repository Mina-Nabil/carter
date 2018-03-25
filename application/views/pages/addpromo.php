
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Promo</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Promo Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">
                                        <div class="form-group">
                                            <label>Promo Code</label>
                                            <input id='A1' class="form-control" name='promoCode' value='<?=$PRMO_CODE?>' required>
                                            <a onclick="makeid" class="btn btn-success">Generate</a>
                                            <p class="help-block">Generate Promo Code</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Promo Expiration Type</label>
                                            <select class="form-control" name="promoType" required>
                                              <option value='Date'>Date</option>
                                              <option value='Count'>Count</option>
                                              <option value='Both'>Both</option>
                                            </select>
                                            <p class="help-block">Select Promo Type, Date means promocode will expire after a certain date and Count means Promocode will expire after a certain date.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Promo Discount Percent</label>
                                            <input class="form-control" name='promoPercent' type=number step=1 value='<?=$PRMO_PRCNT?>' required>
                                            <p class="help-block">Enter Promo Discount Value. Example: 20 => 20% Discount on a Ticket</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Promo Limit</label>
                                            <input class="form-control" name='promoCount' type=number step=1 value='<?=$PRMO_CNT?>'>
                                            <p class="help-block">Enter The Promo Code Limit. The Maximum number this promocode cane be used per person.</p>
                                        </div>

                                        <div class="form-group" id=time1>
                                            <label>Promo Expiry Date</label>
                                            <input
                                            class=form-control name=promoExpire
                                            type=datetime-local
                                            value='<?if($PRMO_EXPIRE != '') echo date("Y-m-d\TH:i", $Timestamp); else echo date("Y-m-d\TH:i");?>' required>
                                            <br>

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
        <script type='text/javascript' defer="defer">

        function makeid() {

          var text = "";
          var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
          console.log('ID: ');

          for (var i = 0; i < 9; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
            console.log(text);
            var input = document.getElementById('A1')
            input.value = text;
        }

        </script>
