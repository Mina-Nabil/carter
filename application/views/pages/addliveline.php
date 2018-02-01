
<script type='text/javascript'>

  function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }

  function checkboxes(){
    var NoRepeat = document.getElementById('DR')
    if(NoRepeat.value == true){
      var d1 = document.getElementById('d1').checked = false
      var d2 = document.getElementById('d2').checked = false
      var d3 = document.getElementById('d3').checked = false
      var d4 = document.getElementById('d4').checked = false
      var d5 = document.getElementById('d5').checked = false
      var d6 = document.getElementById('d6').checked = false
      var d7 = document.getElementById('d7').checked = false

    }
  }

  function addTime(id){

    var oldInput = document.getElementById('time' + id);

    var div1 = document.createElement('div');
    div1.className = 'form-group';
    div1.id = 'time' +  (id + 1);
    var label = document.createElement('label');
    label.innerHTML = 'Line Start Time'

    div1.appendChild(label);



    var input = document.createElement('input');
    input.className = 'form-control';
    input.name = 'livelineTime[' + id + ']';
    input.type = 'datetime-local'
    input.value = <?="'" . date("Y-m-d\TH:i") . "'"?>
    input.required = true

    div1.appendChild(input)

    var a = document.createElement('a')
    a.addEventListener('click', function(){
      addTime(id+1);
    });
    a.className='btn btn-success'
    a.innerHTML='Add Line Time'

    div1.appendChild(a)

    insertAfter(oldInput, div1)

    var br = document.createElement('br')
    insertAfter(div1, br)

  }

</script>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Live Line</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Live Line Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='<?=base_url() . $formURL?>' method="post">

                                      <div class="form-group">
                                          <label>Line Name</label>
                                          <select class="form-control" name='livelineLineID'>
                                            <?foreach($Lines as $line){?>
                                                <option value=<?=$line['LINE_ID']?> <?if($LVLN_LINE_ID == $line['LINE_ID'])  echo 'selected';?> required><?=$line['LINE_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Driver Name</label>
                                          <select class="form-control" name='livelineDriverID'>
                                            <?foreach($Drivers as $driver){?>
                                                <option value=<?=$driver['DRVR_ID']?> <?if($LVLN_DRVR_ID == $driver['DRVR_ID'])  echo 'selected';?> required><?=$driver['DRVR_NAME']?></option>
                                            <?}?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Bus Name</label>
                                          <select class="form-control" name='livelineBusID'>
                                                <option value='' >Not Available</option>
                                            <?foreach($Buses as $bus){?>
                                                <option value=<?=$bus['BUS_ID']?> <?if($LVLN_BUS_ID == $bus['BUS_ID'])  echo 'selected';?> required><?=$bus['BUS_TYPE'] . '/' . $bus['BUS_NUMBER']?></option>
                                            <?}?>
                                          </select>
                                      </div>



                                        <div class="form-group">
                                            <label>is Completed?</label>
                                            <select class="form-control" name='livelineisComplete'>
                                              <option value=0 <?if($LVLN_COMP == 0)  echo 'selected';?>>False</option>
                                              <option value=1 <?if($LVLN_COMP == 1)  echo 'selected';?>>True</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>is Cancelled?</label>
                                            <select class="form-control" name='livelineisCancelled'>
                                              <option value=0 <?if($LVLN_CANC == 0)  echo 'selected';?>>False</option>
                                              <option value=1 <?if($LVLN_CANC == 1)  echo 'selected';?>>True</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Ticket Price</label>
                                            <input class="form-control" name='livelineTicketPrice' type="number" step="0.01" value='<?=$LVLN_TCKT_PRICE?>'>
                                            <p class="help-block">Enter Live Line Revenue.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Revenue</label>
                                            <input class="form-control" name='livelineRevenue' type="number" step="0.01" value='<?=$LVLN_REVN?>' readonly>
                                            <p class="help-block">Enter Live Line Revenue.</p>
                                        </div>

                                        <div class="form-group">
                                          <label>Days</label> <br>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id='d1' name="d1">Saturday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id='d2' name="d2">Sunday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id='d3' name="d3">Monday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox"  id='d4' name ="d4">Tuesday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox"  id='d5' name="d5">Wednesday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox"  id='d6' name="d6">Thursday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox"  id='d7' name="d7">Friday
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id='DR' onchange="checkboxes()" name="DR">Dont Repeat
                                          </label>
                                        </div>

                                        <div class="form-group" id=time1>
                                            <label>Line Start Time</label>
                                            <input
                                            class=form-control name=livelineTime[1]
                                            type=datetime-local
                                            value='<?if($LVLN_TIME != '') echo date("Y-m-d\TH:i", $Timestamp); else echo date("Y-m-d\TH:i");?>' required>
                                            <br>
                                            <a onclick="addTime(1)" class="btn btn-success">Add Line Time</a>
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
