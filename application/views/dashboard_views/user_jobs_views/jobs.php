<table id="user-jobs-table">
      <tr class="table-title-row">
        <td>Job Id</td>
        <td>Job Title</td>
        <td>Job Category</td>
        <td>Job Status</td>
        <td>Budget</td>
        <td>Proposals</td>
        <td>View Job</td>
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
            <td class="btn"style="cursor:pointer;" onclick="view(event,'<?= $jobs[$i]['id']?>')">View</td>
            <?php
          ?>
        </tr>
        <?php
      }
      ?>
    </table>