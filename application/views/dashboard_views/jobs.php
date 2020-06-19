<?php
$account_type = get_details('account_type');
if(!count($jobs)<1)
{
  if($account_type =='seller')
  {
    ?>
    <table id="user-jobs-table">
      <tr class="table-title-row">
        <td>Job Id</td>
        <td>Job Title</td>
        <td>Job Category</td>
        <td>Job Status</td>
        <td>Employer Name</td>
        <td>Earnings</td>
        <td>View Job</td>
      </tr>
      <?php    
      for ($i=0; $i <count($jobs) ; $i++) 
      { 
        ?>
        <tr job-id = "<?= $jobs[$i]['id']?>" class="job-row">
          <?php
          foreach($jobs[$i] as $key => $value )
          { 
            ?>
            <td class="<?= $key?>"><?= $value?></td>
            <?php
          }?>     
            <td class="btn" onclick="view(event,'<?= $jobs[$i]['id']?>')">View</td>
        </tr>
        <?php
      }
      ?>
    </table>
    <?php  
  }
  elseif($account_type == 'buyer')
  {
    ?>
    <p style="border-bottom:0.5px solid var(--base-outline-color);padding:15px;">
      <a class="btn" style="text-decoration:none;margin:5px;" href="<?=base_url()?>dashboard/jobs">Jobs</a>
      <a class="btn"style="text-decoration:none;margin:5px;" href="<?=base_url()?>dashboard/jobs/new">New Job</a>
    </p>
    <?php
    switch ($view) {
      case 'jobs':
        $this->load->view('dashboard_views/user_jobs_views/jobs',$jobs);
        break;
      default:
        $this->load->view("dashboard_views/user_jobs_views/$view");
    }
  }
}
else
{
  echo "<p class='just-text-2'> No jobs available</p>";

}
//print_r($jobs);
?>
<script src="<?= base_url()?>assets/js/userJobs.js"></script>