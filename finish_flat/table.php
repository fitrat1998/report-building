<?php 
	include '../config.php';

	$num = $_POST['num'];

	$sql = mysqli_query($link,"SELECT * FROM extra_object WHERE flat = '$num'");
  if(mysqli_num_rows($sql) > 0){

	while($row = mysqli_fetch_assoc($sql)){

	$ready = explode(",",$row['surface']);
	array_pop($ready);

  $worker = explode(",",$row['workers']);
  array_pop($worker);

?>
 <div class="row" id="test">
      <?php 
         $sql2 = mysqli_query($link,"SELECT * FROM sections WHERE parent='flat'");
         $i = 0;
         $row2 = mysqli_fetch_assoc($sql2);

             ?>
                <?php foreach($ready as $key => $value){ 
                   $sql3 = mysqli_query($link,"SELECT * FROM workers WHERE id='$worker'");

                   $row3 = mysqli_fetch_assoc($sql3);
                   print_r($row3);
                  ?>
               <div class="col-lg-2 ">
                 
                <i class="fa fa-bath "></i>
                <label><?=$row2['section_name']?></label>
                <input type="text" name="section[]" class="form-control object" placeholder="<?=$value?>" value="<?=$value?>">
                
            </div>  

            <div class="col-lg-2">
                <i class="mdi mdi-worker"></i>

               <label>Worker | <?=$row3['name']?></label>
               <select name="worker[]" class="js-example-basic-multiple form-control" multiple="multiple" style="background-color: #F8F8F8 !important;width:180px !important; " >
                <?php 
                  $sql3 = mysqli_query($link,"SELECT * FROM workers");
                  while($rows = mysqli_fetch_assoc($sql3)){
                     ?>
                        <option class="form-control" value="<?=$rows['id']?>"><?=$rows['name']?></option>
                     <?
                  }
                ?>
               </select>
            </div>
               <? } ?>

             <?
         // }
      
    ?>
</div>

<div class="col-lg-3">
   <label>Comment</label><br>
    <div class="row">
        <div class="col-md-2">
            <input name="check" class=" form-control flexCheckDefault " type="checkbox" value="true" id="flexCheckDefault" style="width:50px !important;height: 35px;background-color:red !important;" onchange="com()" id="">
        </div>
        <div class="col-md-10 comment" id="com">
            <input type="text" name="comment" class="form-control "
            style="background-color: #F8F8F8 !important;">
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
              $(".js-example-basic-multiple").select2();
              $(".js-example-basic-multiple").css("background-color","gray");
            });
</script>
<?
}
}
else {
  ?>
 <div class="row" id="test">
      <?php 
         $sql2 = mysqli_query($link,"SELECT * FROM sections WHERE parent='flat'");
         $i = 0;
         while ($row2 = mysqli_fetch_assoc($sql2)) {
               $i++;
               // echo $row['surface']." ";
             ?>
             <!-- <br /> -->
               <div class="col-lg-2 ">
                 
                <i class="fa fa-bath "></i>
                <label><?=$row2['section_name']?></label>
                <input type="text" name="section[]" class="form-control object" placeholder="<?=$row2['section_name']?> section" >
                
            </div>     
            <div class="col-lg-2">
                <i class="mdi mdi-worker"></i>
               <label>Workers</label>
               <select name="worker[]" class="js-example-basic-multiple form-control" multiple="multiple" style="background-color: #F8F8F8 !important;width:180px !important; " >
                <?php 
                  $sql3 = mysqli_query($link,"SELECT * FROM workers");
                  while($rows = mysqli_fetch_assoc($sql3)){
                     ?>
                        <option class="form-control" value="<?=$rows['id']?>"><?=$rows['name']?></option>
                     <?
                  }
                ?>
               </select>
            </div>
               

             <?
         }
      
    ?>
</div>

<div class="col-lg-3">
   <label>Comment</label><br>
    <div class="row">
        <div class="col-md-2">
            <input name="check" class=" form-control flexCheckDefault " type="checkbox" value="true" id="flexCheckDefault" style="width:50px !important;height: 35px;background-color:red !important;" onchange="com()" id="">
        </div>
        <div class="col-md-10 comment" id="com">
            <input type="text" name="comment" class="form-control "
            style="background-color: #F8F8F8 !important;">
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
              $(".js-example-basic-multiple").select2();
              $(".js-example-basic-multiple").css("background-color","gray");
            });
</script>
<?
}

?>