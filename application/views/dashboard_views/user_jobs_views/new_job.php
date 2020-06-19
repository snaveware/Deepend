<form id="new-job-form">
  <div class="title">
    <p>
      <span>Title</span>
      <sup class="required-star">&#9733</sup>
    </p>
    <p class="error-3" id=""></p>
    <p class="flexbox-row-nowrap" style="margin:0;padding:0;">
      <input type="text" name="title"id="title"  required  autocomplete>
      <span id="title-check" class="fa fa-check-circle " style="display:none;font-size:24px;margin:5px;"></i>
    </p>
  </div>

  <div class="budget">
  <p>
      <span>Budget</span>
      <sup class="required-star">&#9733</sup>
    </p>
  <p class="flexbox-row-nowrap" style="margin:0;padding:0;">
    <span>$</span>
    <input type="number" name="budget" id="budget">
  </p>
  </div>
  <div class="category">
    <p>
      <span>Category</span>
      <sup class="required-star">&#9733</sup>
    </p>
    <p class="flexbox-row-nowrap"style="margin:0;padding:0;">
      <input type="text" name="category"id="category"autocomplete>
    </p>
  </div>
  <ul id="category-list" class="flexbox-column">
    
  </ul>
  <div class="skills">
    <p>
    <span>Skills</span>
      <sup class="required-star">&#9733</sup>
    </p>
    <p id="chosen-skills"></p>
    <p class="flexbox-row-nowrap"style="margin:0;padding:0;">
      <input type="text" name="skills"id="skills"autocomplete>
      <span class="btn"id="add-skill">Add</span>
    </p>
  </div>
  <ul id="skills-list" class="flexbox-column">
    
  </ul>

  <div class="job-description">
      <p>
        <span>Description</span>
        <sup class="required-star">&#9733</sup>
      </p>
      <textarea name="description" rows="20" placeholder="Describe your job in length"id="job-description-textarea"></textarea>
      <small id="job-description-length" style="font-size:10px;"class="just-text-1;opacity:0.8;"></small>
  </div>
  <center><input type="submit" value="Join"id="job-submit-input"></center>
</form>