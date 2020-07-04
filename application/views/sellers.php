<?php $this->load->view('head');?>
<?php $this->load->view('menus/main_menu');?>
  <?php
  switch ($view) 
  {
    case 'many_sellers':
      $this->load->view("seller_views/$view",$sellers);
      break;
    case 'single_seller':
      $this->load->view("seller_views/$view",$seller);
      break;
    default:
      $this->load->view("seller_views/$view");
      break;
  }?>
<?php $this->load->view('footer')?>
<script src="<?=base_url()?>assets/js/sellers.js"></script>
