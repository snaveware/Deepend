<?php $this->load->view('head'); ?>
<?php $this->load->view('menus/main_menu'); ?>
<div class="flexbox-row-nowrap"id="signup">
  <div id="signup-image-container">
  <img src="<?= base_url() ?>assets/images/join.png" alt="illustration of girl working">
  </div>
  <form id="signup-form" >
  <center><img style="margin-top:5px;"src="<?= base_url()?>/assets/images/deepend-logo-border-sm.png" alt="Logo"></center>
    <div class="name">
      <p>
      <span>Name</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <input type="text" name="first_name"placeholder="First Name"id="first-name" required autocomplete>
      <input type="text" name="last_name"placeholder="Last Name"id="last-name" required autocomplete>
    </div>
    <div class="email">
      <p>
      <span>Email</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <input type="email" name="email"id="email" required autocomplete>
    </div>
    <div class="password">
      <p>
      <span>Password</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <p class="flexbox-row-nowrap" style="margin:0;padding:0;">
      <input type="password" name="password" placeholder="Password"id="password"required autocomplete>
      <input type="password" name="confirm_password"placeholder="Confirm Password"id="confirm-password" required autocomplete>
      <i class="fa fa-eye"id="show-password" style="font-size:24px"></i>
      </p>
    </div>
    <div class="account-type"id="account-type-container">
      <p>
      <span>Account Type</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <p class="flexbox-row-nowrap" style="margin:0;padding:0;"id="account-type-container">
        <input type="text" name="account_type" id="account-type"disabled>
        <span class="caret"></span>
      </p>
    </div>
    <ul id="account-type-list" class="flexbox-column">
        <li id="employer">Employer</li>
        <li id="seller">Seller</li>
      </ul>
    <div class="location">
      <p>
      <span>Location</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <input type="text" name="city"placeholder="City"id="city" required autocomplete>
      <input type="text" name="country"placeholder="Country" id="country" required autocomplete>
    </div>
    <div class="languages">
      <p>
      <span>Languages</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <p id="chosen-languages"></p>
      <p class="flexbox-row-nowrap"style="margin:0;padding:0;">
        <input type="text" name="languages"id="languages"autocomplete>
        <span class="btn"id="add-language">Add</span>
      </p>
    </div>
    <div class="telephone">
      <p>
      <span>Telephone</span>
      </p>
      <input type="text" name="telephone"id="telephone" autocomplete>
    </div>
    <div class="occupation-description">
      <p>
        <span>Occupation Description</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <textarea name="description"  cols="50" rows="3"maxlength="50" placeholder="eg Skilled software engineer"id="description-textarea"></textarea>
    </div>
    <center><input type="submit" value="Join"id="submit-input" required autocomplete></center>
  </form>
</div>
<script src="<?= base_url()?>assets/js/join.js"></script>
<?php $this->load->view('footer'); ?>