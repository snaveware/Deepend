<div class="flexbox-row-nowrap">
  <div  id="single-post"class="a-post" style="padding:10px;">
    <h2 class="heading-1"style="font-size:1.5rem;" ><?=$job[0]['title']?></h2>
    <p class="heading-2">
      <span>&nbsp;<?=$job[0]['category']?>&nbsp;</span>
      <span>&nbsp;$<?=$job[0]['budget']?>&nbsp;</span>
      <span>&nbsp;Posted <?=passed_time($job[0]['created_on'])?></span>
    </p>
    <p class="job-description"style="max-width:90%;"><?= $job[0]['description']?></p>
    <p>
      <?php 
      $skills = explode('|',$job[0]['skills']);
      foreach ($skills as $skill) {
        ?>
        <span style="color:var(--base-text-color-1);background-color:var(--base-outline-color);border-radius:2px;">&nbsp;<?= $skill?>&nbsp;</span>
        <?php
      }?>
    </p>
  </div>
  <div style="box-shadow:1px 1px 6px var(--base-bg-color-3);width:25vw;min-height:100%!important;margin:30px 0;">
    <img class="avatar-2" src="<?= base_url().'assets/images/'.$job[0]['image']?>" 
    alt="profile picture">
    <center><a style="text-align:center;width:max-content;text-decoration:none;"class="btn" href="">Submit Proposal</a></center>
  </div>
</div>


<?php


?>

