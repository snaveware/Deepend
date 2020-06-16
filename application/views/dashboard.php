<?php $this->load->view('head');?>
    <?php $this->load->view('menus/main_menu');?>
    <div id="dashboard">
      <section id="sidebar">
        <?php $this->load->view('dashboard_views/sidebar')?>
      </section>
      <section id="dashboard-content">
        <?php
        if($view == "profiles")
        {
          $this->load->view("dashboard_views/$view",$profiles);
        }
        elseif($view == "jobs")
        {
          $this->load->view("dashboard_views/$view",$jobs);
        }
        else
        {
          $this->load->view("dashboard_views/$view");
        }?>
      </section>
      </div>
      <?php $this->load->view('footer')?>
      <script src="<?=base_url()?>assets/js/profile.js"></script>
