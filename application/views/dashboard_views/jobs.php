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
          }
          ?>
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
    <script src="<?= base_url()?>assets/js/userJobs.js"></script>
    <p>
      <a class="btn" style="text-decoration:none;margin:5px;" href="<?=base_url()?>dashboard/jobs">Jobs</a>
      <a class="btn"style="text-decoration:none;margin:5px;" href="<?=base_url()?>dashboard/jobs/new">New Job</a>
    </p>
    <table id="user-jobs-table">
      <tr class="table-title-row">
        <td>Job Id</td>
        <td>Job Title</td>
        <td>Job Category</td>
        <td>Job Status</td>
        <td>Budget</td>
        <td>Proposals</td>
        <td>Edit</td>

      </tr>
      <?php
      for ($i=0; $i <count($jobs) ; $i++) { 
        ?>
        <tr job-id = "<?= $jobs[$i]['id']?>" class="job-row">
          <?php
          foreach($jobs[$i] as $key => $value )
          { 
            ?>
            <td class="<?= $key?>"><?= $value?></td>
            <?php
          }
          ?>
            <td class="btn" onclick="editUserJob(event,'<?= $jobs[$i]['id']?>')">Edit</td>
            <?php
          ?>
        </tr>
        <?php
      }
      ?>
    </table>
    <?php
  }
}
else
{
  echo "<p class='just-text-2'> No jobs available</p>";

}
//print_r($jobs);
?>