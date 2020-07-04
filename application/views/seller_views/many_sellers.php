<?php 
  $base_url =base_url();
?>
  <?php //print_r($sellers)?>
  <script src="<?=$base_url?>assets/js/sellers.js"></script>
  <table id="sellers">
  <?Php
    
    foreach ($sellers as $seller) {
      ?>
      <tr>
        <td style="position:relative;left:0 !important;">
          <img src="<?= $base_url.'assets/images/'.$seller['image']?>" alt="">
        </td>
        <td>
          <p class="heading-1"style="font-size:15px;"><?= $seller['first_name']?> &nbsp;<?= $seller['last_name']?></p>
          <p class="heading-2"><?= $seller['user_description']?></p>
          <p class="heading-2"><?= show_rating($seller['review'])?></p>
        </td>
        <td>
          <p class="heading-2"><i class="fa fa-map-marker">&nbsp;</i> <?= $seller['location']?></p>
          <p class="heading-2" style="padding-top:10px !important;"><a href="<?= base_url().'sellers/'.$seller['id']?>"class="btn-3" style="text-decoration:none;">View Seller</a></p>
        </td>
        <?php //print_r($seller);?>
    </tr>
      <?Php
    }
  ?>
  </table>
