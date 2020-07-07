<?php 
//print_r($general_profile);
//print_r($general_profile_portfolios);

$profiles_navigation="";
if(!count($profiles) < 1 )
{
	foreach ($profiles as $profile ) 
	{
		$element_id = strtolower($profile['profile_title']);
		$profiles_navigation =$profiles_navigation. "
		<li id='$element_id' profile-id='$profile[id]' onclick='showProfile(event)'>
			$profile[profile_title]
		</li>";
	}
}
$profiles_navigation=$profiles_navigation."
<li id='add-profile'style='font-size:1.2rem;'title= 'add profile' onclick= 'add()'>
	+ 
</li>";
?>
<ul id="profiles-list"class="list-h flexbox-row-left">
	<?= $profiles_navigation?>
</ul>
<?php
if(!count($profiles) <1 )
{
	?>
	<div style="position:relative;" id="profile-data">
		<div class="just-text-1">
			<p class ="options">
				<button id="edit-profile-description"onclick="edit(event)">edit</button>
			</p>
			<div id='profile-description-container'>
				<span id="full-profile-description" style="display:none;">
					<?php  echo $general_profile[0]['profile_description'];?>
				</span>
				<div id="profile-description"><?=$general_profile[0]['profile_description'];?></div>
				<button id="description-more"  onclick="showMoreText(event,'full-profile-description',
				'profile-description')"class="btn-2" >less</button>
			</div>
		</div>
		<div id="editor-container" style="display:none;margin:10px auto; width:90%;">
			<div id="editor"><?=$general_profile[0]['profile_description'];?></div>
			</div>
		<div id="portfolio">
			<h2  style="text-align:center;text-decoration:underline;"class="just-heading-1">
				Portfolios
			</h2>
			<ul id="portfolio-list"class="list-c flexbox-row-left">
				<?php 
				if(!count($general_profile_portfolios)<1)
				{
					foreach ($general_profile_portfolios as $portfolio ) 
					{
						$image =empty($portfolio['images'])?'deepend-landing.png': create_array($portfolio['images'],'|','first');
						?> 
						<li id="<?=$portfolio['portfolio_title']?>" portfolio-id="<?=$portfolio['id'] ?>" onclick="showPortfolio(event)">
							<img class="img-1" src="<?= base_url()."assets/images/".$image?>" 
							alt="portfolio image">
							<p class="heading-2"><?=$portfolio['portfolio_title'] ?></p>
						</li>
						<?php
					}
				}
				?>
				<li style="border:0.5px dotted var(--base-outline-color);min-height:100px;"title="add new" onclick="add('portfolios')" >
					<span style="position:relative;top:49%;left:49%;font-size:3rem;font-weight:lighter;">+</span>
				</li>
			</ul>
		</div>
	</div>
	<form id="file-upload"style="display:none;">
		<input type="file"name="file"id="select-file"onchange="upload(event)">
	</form>
	<?php 
}
?>
