<?php $this->load->view('head');?>
    <?php $this->load->view('menus/main_menu');?>
    <div id="dashboard">
      <section id="sidebar">
        <?php $this->load->view('dashboard_views/sidebar')?>
      </section>
      <section id="dashboard-content">
        <?php
        switch ($view) 
        {
          case 'profiles':
            $this->load->view("dashboard_views/$view",$profiles);
            break;
          case 'jobs':
            $this->load->view("dashboard_views/$view",$jobs);
            break;
          case 'proposals':
            $this->load->view("dashboard_views/$view",$proposals);
            break;
          default:
            $this->load->view("dashboard_views/$view");
            break;
        }?>
      </section>
      </div>
      <?php $this->load->view('footer')?>
      <script src="<?=base_url()?>assets/js/profile.js"></script>
