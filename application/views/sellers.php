<?php 
  $this->load->view('head');
  $base_url =base_url();
?>
	<?php $this->load->view('menus/main_menu')?>
  <?php //print_r($sellers)?>
  <script src="<?=$base_url?>assets/js/sellers.js"></script>
  <section id="sellers">
  <?Php
    
    foreach ($sellers as $seller) {
      ?>
      <div class="seller">
        <img src="<?= $base_url.'assets/images/'.$seller['image']?>" alt="">
        <div>
          <p class="heading-1"style="font-size:15px;"><?= $seller['first_name']?> &nbsp;<?= $seller['last_name']?></p>
          <p class="heading-2"><?= $seller['user_description']?></p>
          <p class="heading-2"><?= show_rating($seller['review'])?></p>
        </div>
        <div>
          <p class="heading-2"><i class="fa fa-map-marker">&nbsp;</i> <?= $seller['location']?></p>
          <p class="heading-2"><?= $seller['languages']?></p>
        </div>
        <?php //print_r($seller);?>
      </div>
      <?Php
    }
  ?>
  </section>
	<?php $this->load->view('footer')?>
