<section id="job-posts">
		<form id="searchForm" class=" search-conditions flebox-column">
			<input id="searchField" class="lg-1" type="search"name="search"
			placeholder="Enter keywords">
			<button class="btn" type="submit">Go</button>
		</form>
		<div flexbox-row-wrap>
			<form id="categorySetterForm" class=" search-conditions flebox-column">
				<span class="just-text-2">Sort</span>
				<input id="categorySetter" class="md-1" 
				type="category"name="category"value="" placeholder="category">&nbsp;&nbsp;
				<span id ="results" class=" just-text-2"></span>
			</form>
		</div>
		<div id="loader" class="loader"></div>
		<div id="posts" class="flexbox-column">
		</div>
		<div class="flexbox-row-wrap"style="background:white;border-top:0.5px 
		solid var(--base-outline-color);">

			<form id="quantitySetterForm" class="search-conditions flexbox-column">
					<input id = "quantitySetter"class="sm-1" type="number"name="per_page"value="" 
					placeholder="10 per page">
			</form>
			<ul id="pagination" class="list-d flexbox-row-left">
			</ul>
		</div>
	
	</section>
	<script src = "<?php echo base_url()?>/assets/js/posts.js"></script>