
	<?php $this->load->view('head')?>
	<?php $this->load->view('menus/main_menu')?>
	
	<?php 
	switch ($view) {
		case 'many_posts':
			$this->load->view('posts/many_posts');
			break;
		case 'single_post':
			$this->load->view('posts/single_post');
			break;
		default:
			$this->load->view('posts/'.$view);
	}
	
	?>
	<?php $this->load->view('footer')?>
