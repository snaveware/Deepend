<?php 
$image = get_details('image');
$first_name = get_details('first_name');
$last_name = get_details('last_name');
$account_type = get_details('account_type');
$description = get_details('description');
$rating = get_details('review');
$rating = show_rating($rating);
?>
<div id="dashboard-sidebar">
<div class="profile-container">
<img class="avatar-2" src="<?= base_url().'assets/images/'.$image?>" 
alt="profile picture">
<div id="profile-overly"><i id="change-btn"  class="fa fa-edit"></i></div>
</div>
<h3 class="heading-2 center"><?=$first_name.' '.$last_name?></h3>
<h3 class="heading-2 center"><?=$description?></h3>
<h3 class="heading-2"><?= $rating?></h3>
<ul class="list-d-a ">
  <li>
    <a href="<?=base_url()?>dashboard">Profiles</a>
  </li>
  <li>
    <a href="<?=base_url()?>dashboard/jobs">Jobs</a>
  </li>
  <li>
    <a href="<?=base_url()?>dashboard/settings">Settings</a>
  </li>
  <li>
    <a href="<?=base_url()?>dashboard/proposals">Proposals</a>
  </li>
<?php
  if($account_type == "seller")
  {?>
 <!-- <li>
    <a href="<?=base_url()?>dashboard/gigs">Gigs</a>
  </li>-->
  <?php
  }
?>
</ul>
</div>
<form style="display:none;" >
<input type="file"name="profile-uploader"id="profile-uploader">
</form>
<script src="<?=base_url()?>assets/js/dashboardSidebar.js"></script>