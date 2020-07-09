<?php 
  //print_r($portfolios);
?>
<style>
td{
 border:20px solid #f4f4f4 !important;
}
#modal-container{
  position:absolute;
  top:0;
  margin:10px auto;
  width:100%;
  border:1px solid green;
  background-color:white;
  padding:5px;
  box-shadow:1px 1px 6px var(--base-bg-color-3);
}
#modal{
  display:flex;
  justify-content:center;
  align-items:center;
  margin:0;
  
}
#modal li{
    list-style-type:none;
    width:25%;
    padding:5px;
  }
#modal-close{
  position:relative;
  left:95%;
  top:0;
  padding:5px;
  font-size:2rem;
  cursor:pointer;
  color:var(--base-button-color);
  margin:0;
  padding:0;
}
</style>
<p style="text-align:center;">
  <span class="btn-3"id="personal-details">Personal Details</span>
  <span class="btn-3"id="profiles">Profiles</span>
  <span class="btn-3"id="portfolios">Portfolios</span>
</p>
<div id="profiles-element" style="display:none;">
  <table style="border-collapse:collapse;margin:50px auto;">
    <?php
    foreach($profiles as $profile)
    {?>
      <tr style="border:20px solid #f4f4f4;">
        <td class="just-text-1" style="text-transform:capitalize;font-size:1.4rem !important;" ><?=$profile['profile_title']?></td>
        <td class="btn-3"onclick="deleteProfile(event,'<?=$profile['id']?>')">Delete Profile</td>
    </tr>
      <?php
    }?>
  </table>
</div>

<div id="portfolios-element" style="display:none;position:relative;">
  <table style="border-collapse:collapse;margin:50px auto;">
    <?php
    foreach($portfolios as $portfolio)
    {?>
      <tr style="border:20px solid #f4f4f4;">
        <td class="just-text-1" style="text-transform:capitalize;font-size:1.4rem !important;" ><?=$portfolio['portfolio_title']?></td>
        <td class="btn-3"onclick="deletePortfolio(event,'<?=$portfolio['id']?>')">Delete portfolio</td>
        <td class="btn-3"onclick="showPortfolioImages(event,'<?=$portfolio['id']?>')">Images</td>
        <td class="btn-3" onclick="showPortfolioVideos(event,'<?=$portfolio['id']?>')">Videos</td>
    </tr>
      <?php
    }?>
  </table>
  <div id="modal-container"style="display:none;">
    <p id="modal-close">&times;</p>
    <ul id="modal">
      
    </ul>
  </div>
</div>
 <form id="signup-form" >
    <div class="name">
      <p>
      <span>Name</span>
      </p>
      <input value="<?= $personal_data[0]['first_name']?>" type="text" name="first_name"placeholder="First Name"id="first-name" required  autocomplete>
      <input value="<?= $personal_data[0]['last_name']?>" type="text" name="last_name"placeholder="Last Name"id="last-name"  required  autocomplete>
    </div>
    <div class="email">
      <p>
      <span>Email</span>
      </p>
      <p class="flexbox-row-nowrap" style="margin:0;padding:0;">
        <input value="<?= $personal_data[0]['email']?>"type="email" name="email"id="email"  required  autocomplete>
      </p>
    </div>

    <div class="gender">
      <p>
      <span>Gender</span>
      </p>
      <p class="flexbox-row-nowrap" style="margin:0;padding:0;"id="gender-container">
        <input value="<?= $personal_data[0]['gender']?>"type="text" name="gender" id="gender"disabled>
        <span class="caret"></span>
      </p>
    </div>
    <ul id="gender-list" class="flexbox-column">
      <li id="male">Male</li>
      <li id="female">Female</li>
      <li id="other">Other</li>
    </ul>
    <div class="location">
      <p>
      <span>Location</span>
      </p>
      <?php
        $location = explode('|',trim($personal_data[0]['location']));
      ?>
      <input value="<?=$location[0] ?>"type="text" name="city"placeholder="City"id="city" required   autocomplete>
      <input value="<?= $location[1]?>"type="text" name="country"placeholder="Country" id="country" required   autocomplete>
    </div>
    <div class="languages">
      <p>
      <span>Languages</span>
      </p>
      <p id="chosen-languages"></p>
      <p class="flexbox-row-nowrap"style="margin:0;padding:0;">
        <input value="<?= $personal_data[0]['languages']?>"type="text" name="languages"id="languages"autocomplete>
      </p>
    </div>
    <div class="telephone">
      <p>
      <span>Telephone</span>
      </p>
      <input value="<?= $personal_data[0]['telephone']?>"type="text" name="telephone"id="telephone" autocomplete>
    </div>
    <div class="occupation-description">
      <p>
        <span>Occupation Description</span>
      </p>
      <textarea name="description"  cols="50" rows="3"maxlength="50" id="description-textarea"><?= $personal_data[0]['user_description']?></textarea>
      <small id="description-length" style="font-size:10px;"class="just-text-1;opacity:0.8;"></small>
    </div>
    <center><input type="submit" value="Save"id="submit-input"  autocomplete></center>
  </form>
  <script src="<?= base_url()?>assets/js/settings.js"></script>