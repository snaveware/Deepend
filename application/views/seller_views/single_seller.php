<div id="dashboard">
  <section id="sidebar">
    <?php
     $this->load->view('seller_views/sidebar',$personal_details);
     ?>
  </section>
  <section id="sellers-content">
  <?php 
 if(count($profiles) >0 )
 { ?>
   <ul class="list-h flexbox-row-left">
      <?php
      foreach ($profiles as $profile ) 
      {
        ?>
        <li id="<?=strtolower($profile['profile_title'])?>" profile-id="<?= $profile['id']?>">
          <a href="<?=base_url().'sellers/'.$personal_details[0]['id'].'?profile='.$profile['id']?>" style="text-decoration:none;color:var(--base-button);">
            <?=$profile['profile_title']?>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
    <?php
 }
 
  //print_r($profiles);
  //print_r($personal_details);
 //print_r($main_profile);
  ?>
  <?php 
  if(count($main_profile)>0)
  {?>
    <p id="profile-title" style="display:none;"><?php echo $main_profile[0]['profile_title'] ?></p>
    <div class="profile-description">
      <h1 class="heading-2">Description</h1>
      <p class="just-text-1">
        <?=
        empty($main_profile[0]['profile_description'])?
        'The profile description is empty.':
        $main_profile[0]['profile_description']; ?>
      </p>
    </div>
    <?php
  }
  else
  {?>
    <h1 class="heading-2">No Profile Available</h1>
    <?php 
  }?>
  <?php
  if(count($portfolios)>0)
  {?>
    <div class="portfolios">
      <h1 class="heading-2">Portfolios</h1>

      <?php 
      //print_r($portfolios);
      //print_r($main_portfolio);
      ?>
      <ul class="list-c flexbox-row-left">
        <?php 
        foreach ($portfolios as $portfolio ) 
        {
          $image = create_array($portfolio['images'],'|','first');
          ?> 
          <li id="<?=$portfolio['portfolio_title']?>" portfolio-id="<?=$portfolio['id'] ?>">
            <img class="img-1" src="<?= base_url()."assets/images/".$image?>" 
            alt="portfolio image">
            <a href="<?=base_url().'sellers/'.$personal_details[0]['id'].'?profile='.$main_profile[0]['id'].'&portfolio='.$portfolio['id']?>"  class="heading-2">
              <?=$portfolio['portfolio_title'] ?>
            </a>
          </li>
          <?php
        }
        ?>
      </ul>
      <h1 class="heading-2"><?=$main_portfolio[0]['portfolio_title']?></h1>
      <h1 class="heading-1"style="font-size:1rem;padding:10px;">Images</h1>
      <ul class="list-i flexbox-row-left"id="full-portfolio-images">
        <?php
        $images_array =explode('|',trim($main_portfolio[0]['images']));
        foreach ($images_array as $image) 
        {
          if($image==""||$image==" ")
          {continue;}
          ?>
          <li>
            <img class="img-1" src="<?=base_url().'assets/images/'.$image?>">
          </li>
          <?php
        }
        ?>
      </ul>
      <h1 class="heading-1" style="font-size:1rem;padding:10px;">Videos</h1>
      <ul class="list-i flexbox-row-left"id="full-portfolio-videos">
        <?php
        $video_array = explode('|',trim($main_portfolio[0]['videos']));
        foreach ($video_array as $video) 
        {
          if($video==""||$video==" ")
          {continue;}
          ?>
          <li>
            <video class="img-1" src="<?=base_url().'assets/videos/'.$video?>" controls Autoplay muted loop></video>
          </li>
          <?php
        }?>
      </ul>
      <h1 class="heading-2" style="font-size:1rem;padding:10px;"> Portfolio Description</h1>
      <p class="just-text-1">
        <?= 
        empty($main_portfolio[0]['portfolio_description'])? 'The portfolio description is empty':
        $main_portfolio[0]['portfolio_description'];
        ?>
      </p>
    </div>
    <?php
  }
  else
  {?>
    <h1 class="heading-2">No Portfolio Available</h1>
    <?php 
  }?>
  </section>
</div>