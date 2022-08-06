

<!-- <div class="card bg-primary" style="width: 18rem;">
  <div class="card-body">
 <h1>Home</h1>
  </div>
</div> -->
echo <?php echo $name  . "value ". $value  . "error " . $error . "strlen" . strlen($error)?>
<div class="mb-3">
    <label for=$name class="form-label"><?php echo $name ?></label>
    <input type=$type value="<?php echo $value ?>"  class="form-control <?php  echo strlen($error) ? "is-invalid"  :  ""?> " id="exampleInputName" aria-describedby=$name>
    <div id=$name class="form-text"> <?php echo $name ?></div>