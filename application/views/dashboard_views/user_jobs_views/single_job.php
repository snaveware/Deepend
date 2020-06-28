<div  class="a-post" style="padding:10px;background-color:#f4f4f4;">
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
    <?php
$account_type = strtolower(get_details('account_type'))
?>
<p style="background-color:green;color:white;text-align:center;"">Proposals</p>
<table id="proposals"class="flexbox-column">
  <?php
  foreach ($proposals as $proposal) 
  { 
    ?>
    <tr>
    <div style="background:white;padding:10px;margin:10px auto;">
        <p>
          <span class="just-text-2"><?= $account_type== 'seller'?'Employer':'Seller'?></span>
          <span class="just-text-1"><?=$proposal['first_name']?>&nbsp;<?=$proposal['last_name']?></span>
        </p>
        <p>
          <span class="just-text-2">Cover Letter</span>
          <p class="just-text-1"><?=$proposal['cover_letter']?></p>
        </p>
        <p>
          <span class="just-text-2">Price</span>
          <span class="just-text-1"><?=$proposal['bid_amount']?></span>
        </p>
        <center><button class="btn-3"id="hire" style="text-decoration:none;"onclick="hire('<?=$job[0]['id']?>','<?=$proposal['seller_user_id']?>','<?=$proposal['bid_amount']?>')">Hire This Seller</button></center>
      </div>
    </tr>
    <?php 
  }
  ?>
</table>
  </div>


<?php
//print_r($job);
//print_r($proposals);
?>
<script src="<?=base_url()?>assets/js/hire.js"></script>