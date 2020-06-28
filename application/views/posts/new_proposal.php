<?php //print_r($proposal['status']);?>  
<form id="proposal-form">
<div class="amount">
  <p>
      <span>Amount</span>
      <sup class="required-star">&#9733</sup>
    </p>
  <p class="flexbox-row-nowrap" style="margin:0;padding:0;">
    <span>$</span>
    <input type="number" name="amount" id="amount"required>
  </p>
  </div>
<div class="cover-letter">
      <p>
        <span>Cover Letter</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <textarea name="description" rows="20" id="cover-letter-textarea" required></textarea>
      <small id="cover-letter-length" style="font-size:10px;"class="just-text-1;opacity:0.8;"></small>
  </div>
  <center><input type="submit" value="Send"id="proposal-submit-input"></center>
  <center><p id="success"></p></center>
</form>
<script src="<?=base_url()?>assets/js/proposal.js"></script>
<?php
if(!$proposal['status'][0])
  {
    ?>
    <script>
      showError("<?= $proposal['status'][1]?>","<?=base_url()?>jobs")
    </script>
    <?php
  }
?>