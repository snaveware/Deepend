<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('head.php');?>

<section id="header" style="background-image: 
	url('<?= base_url()?>assets/images/deepend-landing.png');">

	<?php $this->load->view('menus/main_menu.php')?>
	<div id="header-banner">
		<div id="action"> 
			<h2 class="heading-1"> <?php echo $heading;?> </h2>
			<h4 class="heading-2"><?php echo $sub_heading;?></h4>
		</div>
		<div id="users" >
			<ul id="slidesContainer" class="list-f">
			<ul>
		</div>
	</div>
	<script src="<?= base_url()?>assets/js/home.js"></script>
</section>
<ul id="user-count"class="flexbox-row-left list-g">
	
</ul>
<?php $this->load->view('footer');?>