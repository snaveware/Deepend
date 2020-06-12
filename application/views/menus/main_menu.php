<?php 
$data = $this->Select->get_content("featured_files",'website_content',True,"category='logo'",'','');
$logo=$data[0]['featured_files'];
?>
<div id="main-menu"class="flexbox-row-wrap">
	<div class="flexbox-row-nowrap">
		<a href="<?php echo base_url();?>"><img class="logo" src="<?php echo base_url()?>assets/images/<?php echo $logo;?>" alt="logo"></a>
	</div>
	<div class="flexbox-row-nowrap">
		<ul class="flexbox-row-nowrap list-a">
			<li><a href="<?=base_url()?>jobs">Jobs</a></li>
			<li><a href="<?=base_url()?>gigs">Gigs</a></li>
			<li><a href="<?=base_url()?>sellers">Sellers</a></li>                                                                                                       
		</ul>
	</div>
	<div id="nav-account"class="flexbox-row-nowrap">
		<?php if(get_details('id'))
		{
			$image = get_details('image');?>
			<div style="width:100px;height:70px;" id="account">
				<div style="background-color:white;border-radius:25% 2px 2px 25%">
					<img class="avatar" src="<?= base_url().'assets/images/'.$image?>" alt="profile">
					<span class="caret"></span>
				</div>
				<ul class = "list-e" id="list-e">
					<li><a href="<?=base_url()?>dashboard"> <i style="padding:5px;" class="fa fa-user"></i> Profile</a></li>
					<li><a href="<?=base_url()?>dashboard/jobs"><i style="padding:5px;" class="fa fa-wrench"></i>Jobs</a></li>
					<li><a href="<?=base_url()?>dashboard/settings"><i style="padding:5px;" class="fa fa-cog"></i>Settings</a></li>
					<li><a  href="<?= base_url()?>logout"><i style="padding:5px;" class="fa fa-sign-out"></i>logout</a></li>
				</ul>
			</div>
			<?php	
		}
		else
		{?>
			<ul class="flexbox-row-nowrap list-a" id="account-buttons">                                                                                      
			<li><a style="cursor:pointer" id="login-btn">Login</a></li>
			<li><a class="btn-border" href="<?= base_url()?>join">Join</a></li>
			</ul>
			<?php
		}?>
	</div>
</div>   
<?php $this->load->view('login');?>                   