		<section id="footer" class="flexbox-column">
			<div id="footer-1" class="flexbox-row-wrap">
				<?php $this->load->view('menus/footer_menu')?>
				<ul class="flexbox-column list-b">
					<li><a href="#">How to sell</a></li>
					<li><a href="#">How to buy</a></li>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Support</a></li>
				</ul>
				<ul class="flexbox-row-wrap list-b" style="align-content:center;">
					<li><a href="#"><img class="icon-1" src="<?= base_url()?>/assets/images/facebook.png" alt="facebook"></a></li>
					<li><a href="#"><img class="icon-1" src="<?= base_url()?>/assets/images/twitter.png" alt="twitter"></a></li>
					<li><a href="#"><img class="icon-1" src="<?= base_url()?>/assets/images/instagram.png" alt="instagram"></a></li>
				</ul>
			</div>
			<div id="footer-2" class="flexbox-row-wrap" style="align-content:center;">
				<p>&copy <?= date('Y')?> 
					<a href="<?php echo base_url();?>">
						<img width="100px" height="20px" class="logo" src="
						<?= base_url()?>assets/images/deepend-logo-white.png" alt="deepend">
					</a>
				</p>
			</div>
			<script src="<?=base_url()?>assets/js/login.js"></script>
		</section>
	</body>
</html>