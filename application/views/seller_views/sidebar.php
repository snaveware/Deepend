<?php 

$image = $personal_details[0]['image'];
$first_name = $personal_details[0]['first_name'];
$last_name = $personal_details[0]['last_name'];
$account_type = $personal_details[0]['account_type'];
$description = $personal_details[0]['user_description'];
$location = $personal_details[0]['location'];
$languages = $personal_details[0]['languages'];
$rating = $personal_details[0]['review'];
$rating = show_rating($rating);
?>
<div id="sellers-sidebar">
<div class="profile-container">
<img class="avatar-2" src="<?= base_url().'assets/images/'.$image?>" 
alt="profile picture">
</div>
<h3 class="heading-2 center"><?=$first_name.' '.$last_name?></h3>
<h3 class="heading-2 center"><?=$description?></h3>
<h3 class="heading-2"><?= $rating?></h3>
<h3 class="heading-2"><i class="fa fa-map-marker">&nbsp;</i> <?=$location ?></h3>
<h3 class="heading-2 center"><?=$languages?></h3>
</div>