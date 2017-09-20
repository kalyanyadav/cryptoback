<?php 
$plan = getProfileImg();
if($plan){
	$img = "/uploads/uploads/" . $plan[0]['profileImg'];
}
else{
	$img="";
}
?>

<div class="row">
    <div class="col-md-12">
        <form id="img" method="post" enctype="multipart/form-data">
			<input type='file' name='img' id="imgInp" onchange="this.form.submit();"/>
			<img src="<?php echo $img; ?>" alt="Smiley face" height="42" width="42">
			<img id="blah" src="#" alt="your image" />
		</form>
    </div>
</div>
