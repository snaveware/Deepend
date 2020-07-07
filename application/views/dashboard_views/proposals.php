<?php
$account_type = strtolower(get_details('account_type'))
?>
</style>
<section id="proposals"class="flexbox-column">
  <?php
  foreach ($proposals as $proposal) 
  { ?>
    <div class="proposal">
      <p style="background-color:green;color:white;text-align:center;">
      <span>Job ID</span>
      <span><?=$proposal['job_id']?></span>
      </p>
      <p>
      <span class="just-text-2">Title</span>
      <span class="just-text-1"><?=$proposal['title']?></span>
      </p>
      <p>
      <span class="just-text-2">Budget</span>
      <span class="just-text-1">$<?=$proposal['budget']?></span>
      </p>
      <p class="just-text-2" style="text-decoration:underline;">Proposal</p>
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
    </div>
    <?php 
  }
  ?>
</section>
<?php //print_r($proposals)?>