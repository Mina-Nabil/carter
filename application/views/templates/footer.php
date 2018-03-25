</div>
   <!-- /#wrapper -->

   <!-- jQuery Version 1.11.0 -->
   <script src="<?=base_url() . 'js/jquery-1.11.0.js'?>"></script>

   <!-- Bootstrap Core JavaScript -->
   <script src="<?=base_url() . 'js/bootstrap.min.js'?>"></script>

   <!-- Metis Menu Plugin JavaScript -->
   <script src="<?=base_url() . 'js/metisMenu/metisMenu.min.js'?>"></script>

   <!-- DataTables JavaScript -->
   <script src="<?=base_url() . 'js/jquery/jquery.dataTables.min.js'?>"></script>
   <script src="<?=base_url() . 'js/bootstrap/dataTables.bootstrap.min.js'?>"></script>
   <script src="<?=base_url() . 'js/jquery.dlmenu.js'?>"></script>

   <!-- Custom Theme JavaScript -->
   <script src="<?=base_url() . 'js/sb-admin-2.js'?>"></script>
   <!-- JS for Searchable Dropdown List-->

   <!-- Page-Level Demo Scripts - Tables - Use for reference -->
   <script>
       $(document).ready(function() {
         $('#dataTables-example').dataTable();
       });

       $(function() {
         $('.confirm').click(function() {
             return window.confirm("Are you sure?");
         });

});
   </script>

   <script>
       $(document).ready(function () {
        var allOptions = $('#selectdist option')
        $('#selectcity').change(function () {
            $('#selectdist option').remove()
            var classN = $('#selectcity option:selected').prop('class');
            var opts = allOptions.filter('.' + classN);
            $.each(opts, function (i, j) {
                $(j).appendTo('#selectdist');
            });
        });
    });
   </script>

   <script>
       $(document).ready(function () {
        var allOptions = $('#selectdist option')
        $('#selectdist').change(function () {
            $('#selectdist option').remove()
            var classN = $('#selectcity option:selected').prop('class');
            var opts = allOptions.filter('.' + classN);
            $.each(opts, function (i, j) {
                $(j).appendTo('#selectdist');
            });
        });
    });
   </script>

   <script type='text/javascript'>

          var max = 0;
          var points = [];

          function insertAfter(newNode, referenceNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
          }

          function setMax(x){
            max = x/100;
          }

          function inArray(needle, haystack) {
              var length = haystack.length;
              for(var i = 0; i < length; i++) {
                  if(haystack[i] == needle) return true;
              }
              return false;
          }

          function RemoveInput(x){

            document.getElementById('point' +x).remove()
            document.getElementById('labelPoint' +x).remove()

          }

          function addInnerField(x){
            oldpoint = document.getElementById('point' + x);
            max = max + 1;
            number = x+1;
            while(inArray(number, points)) number++;
            newpoint = document.createElement('point' + (x+1));
            var label     = document.createElement('label')
            label.innerHTML = "New Point " ;
            label.id        = 'labelPoint' + (number);

            insertAfter(label, oldpoint);

            var input = document.createElement("div");
            input.className = 'form-group';
            input.id = 'point' + number;
            var label2     = document.createElement('label')
            label2.innerHTML = "Station Name";
            input.appendChild(label2);
            var list = document.createElement('select');
            list.className = 'form-control';
            list.name  = 'pathStationID[' + number + ']';
            <? $i=0;
            if(isset($Stations)){
             foreach($Stations as $station){?>
              var option<?=$i?> = document.createElement('option');
              option<?=$i?>.value = <?=$station['STTN_ID']?>;
              option<?=$i?>.innerHTML = '<?=$station['DIST_NAME'] . ' - ' . $station['STTN_NAME']?>';
              list.appendChild(option<?=$i?>);

            <?  $i++; } }?>
            var label2 = document.createElement('label')
            label2.innerHTML = 'Enter Relative Time'

            var time = document.createElement('input');
            time.type = 'text';
            time.className = 'form-control';
            time.name = 'pathRelTime[' + number + ']';
            time.required = true;

            var help = document.createElement('p')
            help.className = 'help-block'
            help.innerHTML ='Enter Number of minutes from the starting Point.\n' +
           'Example: In case of, adding Station which is 2 hours away from the starting point, Enter 120';

           input.appendChild(list);
           input.appendChild(label2)
           input.appendChild(time)
           input.appendChild(help)

            var remove = document.createElement('div');
            remove.innerHTML = 'Remove Point';
            remove.className = 'btn btn-warning'
            remove.addEventListener('click', function(){
              RemoveInput( number );
            });

            var add = document.createElement('div');
            add.innerHTML = 'Add Point After';
            add.className = 'btn btn-info'
            add.addEventListener('click', function(){
              addInnerField( number );
            });


            input.appendChild(add);
            input.appendChild(remove);

            insertAfter(input, label)

          }



           function addFields(){

             // Container <div> where dynamic content will be placed
             var container = document.getElementById("container");
             var number    = container.childElementCount /2;
             number = 100 * number;
             max = max + 1;
             var label     = document.createElement('label')
             label.innerHTML = "New Point " ;
             label.id        = 'labelPoint' + (number);
             // Append a node with a random text
             container.appendChild(label);
             // Create an <input> element, set its type and name attributes

             var input = document.createElement("div");
             input.className = 'form-group';
             input.id = 'point' + number;
             var label2     = document.createElement('label')
             label2.innerHTML = "Station Name";
             input.appendChild(label2);
             var list = document.createElement('select');
             list.className = 'form-control';
             list.name  = 'pathStationID[' + number + ']';
             <? $i=0;
             if (isset($Stations)){
              foreach($Stations as $station){?>
               var option<?=$i?> = document.createElement('option');
               option<?=$i?>.value = <?=$station['STTN_ID']?>;
               option<?=$i?>.innerHTML = '<?=$station['DIST_NAME'] . ' - ' . $station['STTN_NAME']?>';
               list.appendChild(option<?=$i?>);

             <?  $i++; } }?>


             var label2 = document.createElement('label')
             label2.innerHTML = 'Enter Relative Time'

             var time = document.createElement('input');
             time.type = 'text';
             time.className = 'form-control';
             time.name = 'pathRelTime[' + number + ']';
             time.required = true;

             var help = document.createElement('p')
             help.className = 'help-block'
             help.innerHTML ='Enter Number of minutes from the starting Point.\n' +
            'Example: In case of, adding Station which is 2 hours away from the starting point, Enter 120';

            input.appendChild(list);
            input.appendChild(label2)
            input.appendChild(time)
            input.appendChild(help)

             container.appendChild(input);

             var remove = document.createElement('div');
             remove.innerHTML = 'Remove Point';
             remove.className = 'btn btn-warning'
             remove.addEventListener('click', function(){
               RemoveInput( number );
             });

             var add = document.createElement('div');
             add.innerHTML = 'Add Point After';
             add.className = 'btn btn-info'
             add.addEventListener('click', function(){
               addInnerField( number );
             });


             input.appendChild(add);
             input.appendChild(remove);

             points.push(number);

           }
       </script>

</body>

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

</html>
