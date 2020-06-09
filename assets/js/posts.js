const singlePost = document.getElementById('posts');
const descriptionLength = 50;
let postPerPage = 2;
let page = 1;
let category = "*";
const resultsCount = document.getElementById('results'); 
const baseUrl = 'localhost/deepend/';

function getPassedTime(yourTime,inSeconds=false)
{
	let currentTime= (new Date()- new Date(0))/1000;
	let time =(currentTime - yourTime);
	if(inSeconds)
	{
		return time;
	}
	if(time < 60 && time >= 0)
	{
		let posted = "just now";
	}
	
	else if(time>=60 && time < 3600)
	{
		passedTime =parseInt(time/60);
		posted = passedTime > 1 ? passedTime+"minutes ago" : passedTime+" minute ago";
	}

	else if(time>=3600 && time < 86400)
	{
		passedTime =parseInt(time/3600);
		posted = passedTime >1 ? passedTime+" hours ago" : passedTime+" hour ago";
	}

	else if(time>= 86400 && time < 604800)
	{
		passedTime =parseInt(time/86400);
		posted = passedTime >1 ? passedTime+"days ago" : " Yesterday";
	}

	else if(time>= 86400 && time < 604800)
	{
		passedTime =parseInt(time/604800);
		posted = $passedTime >1 ? passedTime+"weeks ago" : $passed_time+" week ago";
	}
	else{
		posted = "-";
	}
	return posted;
}

function showWords(array,count)
{
	let length = array.length;
	let theCount = count =='all'? length : count;
	show = length > theCount ? theCount : length;
	let text = "";
	for(let i=0; i<show;i++)
   {
		text += array[i] +" "; 
	 }
	return text;
}

function showSkills(array)
{
	let skills = "";
	for (let i in array)
	{
		skills += `<button class="btn-2">${array[i]}</button>`; 
	}
	return skills;
}
function showRating(count)
{
	let rating = "";
	for (let i =0;i<count; i++)
	{
		rating += `<span style="fontsize:14px">&#9733</span>`; 
	}
	for(let i = 0;i<5-count;i++)
	{
		rating+=`<span style="fontsize:14px;">&#9734 </span>`;
	}
	return rating;
}

function showMore(event)
{
	if(event.target.innerHTML =="more")
	{
		event.target.previousSibling.previousSibling.style.display = "none";
		event.target.previousSibling.style.display = 'flex';
		event.target.innerHTML = "less";
	}
	else
	{
		event.target.previousSibling.previousSibling.style.display = "flex";
		event.target.previousSibling.style.display = 'none';
		event.target.innerHTML = "more";
	}
}

function showPage(event)
{
	let pageValue = event.target.innerHTML;
	if(pageValue == "back")
	{
		page =page ==1? page:page-1; 

	} 
	else if(pageValue == 'next')
	{
		page = page==1? page: page+1;
	}
	else if (parseInt(pageValue)>0)
	{
		page = parseInt(pageValue);
	}
	document.getElementById('posts').innerHTML = "";
	document.getElementById('pagination').innerHTML = "";
	createPosts(page,postPerPage,category);
}

function createPosts(thePage,theQuantity,theCategory,theKeywordsRegex = undefined)
{
	xhr = new XMLHttpRequest;
	if(theKeywordsRegex)
	{
		xhr.open('get',`jobs/get_posts?page=${thePage}&quantity=${theQuantity}&
		category=${theCategory}&keywords=${theKeywordsRegex}`,true)
	}
	else
	{
		xhr.open('get',`jobs/get_posts?page=${thePage}&quantity=${theQuantity}&category=${theCategory}`,true)
	}
	xhr.onreadystatechange= function() 
	{
		if(this.readyState == 4 && this.status ==200)
		{
			let posts = JSON.parse(this.responseText);
			const count = posts.length
			const totalResults = posts[count-1];
			for(let i=0; i<count-1; i++)
			{
				let time = getPassedTime(posts[i].created_on) ;
				var  description =posts[i].description.split(' ');
				let descriptionText = showWords(description,descriptionLength)
				let skillsArray = posts[i].skills.split('|');
				let theSkills = showSkills(skillsArray)
				let remainingTime =( posts[i].uptime- getPassedTime(posts[i].created_on,true))/3600
				let expiry =parseInt(remainingTime)+" hours remaining";
				let rating = showRating(posts[i].review);
	
				document.getElementById('loader').style.display ="none";
	
				let post = document.createElement('div');
				post.classList.add('a-post');
	
				let title = document.createElement('h2');
				title.classList.add('just-heading-1');
				title.innerHTML = posts[i].title;
	
				post.appendChild(title);
	
				let postTitle = document.createElement('div');
				postTitle.classList.add('flexbox-column');
				post.appendChild(postTitle);
	
				let postTitleUl =document.createElement('ul');
				postTitleUl.classList.add('flexbox-row-left');
				postTitleUl.classList.add('list-c');
				postTitle.appendChild(postTitleUl);
	
				let postTitleUlLi1= document.createElement('li');
				postTitleUl.appendChild(postTitleUlLi1);
				postTitleUlLi1.innerHTML =posts[i].category;
	
				let postTitleUlLi2= document.createElement('li');
				postTitleUl.appendChild(postTitleUlLi2);
				postTitleUlLi2.innerHTML = "$"+posts[i].budget;
	
				let postTitleUlLi3= document.createElement('li');
				postTitleUl.appendChild(postTitleUlLi3);
				postTitleUlLi3.innerHTML ='posted  '+time;	
	
				let descriptionNode = document.createElement('article');
				descriptionNode.classList.add('job-description');
	
				let descriptionP = document.createElement('p');
	
				let descriptionPSpan1 = document.createElement('span');
				descriptionPSpan1.innerHTML = descriptionText;
				descriptionP.appendChild(descriptionPSpan1);
	
				let descriptionPSpan2 = document.createElement('span');
				descriptionPSpan2.setAttribute('style','display:none;')
				descriptionPSpan2.innerHTML = posts[i].description;
				descriptionP.appendChild(descriptionPSpan2);
	
				descriptionNode.appendChild(descriptionP);
	
				let descriptionButton = document.createElement('button');
				descriptionButton.classList.add("btn-2");
				descriptionButton.classList.add('more-btn');
				descriptionButton.setAttribute('onclick','showMore(event)')
				descriptionButton.innerHTML = "more";
				descriptionP.appendChild(descriptionButton);
	
				post.appendChild(descriptionNode);
	
				let postFooter = document.createElement('div');
	
				let skillsP = document.createElement('p');
				skillsP.classList.add('flexbox-row-left');
				skillsP.innerHTML = theSkills;
				postFooter.appendChild(skillsP);
	
				postMetaP =document.createElement('p');
				postMetaP.classList.add('just-text-2');
				postMetaP.innerHTML =` ${posts[i].bids} of ${posts[i].maximum_bids} proposals sent | ${expiry}`; 
				postFooter.appendChild(postMetaP);
	
				let postFooterUl =document.createElement('ul');
				postFooterUl.classList.add('flexbox-row-left');
				postFooterUl.classList.add('list-c');
				postFooterUl.classList.add('post-footer');
	
				let postFooterUlLi1= document.createElement('li');
				postFooterUlLi1.innerHTML =`<img height = "50px" width="50px"
				style="border-radius:50%;object-fit:cover;"
				src="assets/images/${posts[i].image}">`
	
				//postFooterUlLi1.appendChild(userProfileImg);
				postFooterUl.appendChild(postFooterUlLi1);
	
				let postFooterUlLi2= document.createElement('li');
				postFooterUl.appendChild(postFooterUlLi2);
				postFooterUlLi2.innerHTML =rating;
	
				let postFooterUlLi3= document.createElement('li');
				postFooterUl.appendChild(postFooterUlLi3);
				postFooterUlLi3.innerHTML =`<i class="fa fa-map-marker">&nbsp;</i>
				<span>${posts[i].location}</span>`;
	
				postFooter.appendChild(postFooterUl);
				post.appendChild(postFooter);
				singlePost.appendChild(post);
	
			} //end for
	const pagination = document.getElementById('pagination');
	resultsCount.innerHTML = totalResults+' results were found';
	let pages = parseInt(totalResults/postPerPage);
	for(let i = 0; i<pages; i++)
	{
		if(pages>1 && i == 0)
		{
			if(thePage != 1)
			{
				let back = document.createElement('li');
				back.setAttribute('onclick','showPage(event)')
				back.innerHTML = "back";
				pagination.appendChild(back);
			}
	
			let list = document.createElement('li');
			list.setAttribute('onclick','showPage(event)');
			if(thePage == i+1)
			{
				list.classList.add('active-1');
			}
			list.innerHTML = i+1;
			pagination.appendChild(list);
		}
		else if(pages>1&&i == pages-1)
		{
			let list = document.createElement('li');
			list.setAttribute('onclick','showPage(event)');
			if(thePage == i+1)
			{
				list.classList.add('active-1');
			}
			list.innerHTML = i+1;
			pagination.appendChild(list);
			
			if(pages != thePage)
			{
				let next = document.createElement('li');
				next.setAttribute('onclick','showPage(event)');
				next.innerHTML = "next";
				pagination.appendChild(next);
			}
		}
		else if(pages>1)
		{
			let list = document.createElement('li');
			list.setAttribute('onclick','showPage(event)')
			if(thePage == i+1)
			{
				list.classList.add('active-1');
			}
			list.innerHTML = i+1;
			pagination.appendChild(list);
		}
	}
		}	//end if
	}
	xhr.send();
}
//creating the posts
createPosts(page,postPerPage,category);

//functionality for search field
let searchForm = document.getElementById('searchForm') ;
let searchField = document.getElementById('searchField') ;
searchForm.addEventListener('submit',e=>{
	e.preventDefault();
	let keywords = searchField.value.split(' ');
	let keywordRegex ="(";
	for (let i=0;i<keywords.length;i++) 
	{
		if(i == keywords.length-1)
		{
			keywordRegex+= keywords[i]+')';
		}
		else if(keywords.length==1)
		{
			keywordRegex+= keywords[i];
		}
		else
		{
			keywordRegex+= keywords[i]+'|';
		}
	}
	document.getElementById('posts').innerHTML = "";
	document.getElementById('pagination').innerHTML = "";
	createPosts(page,postPerPage,category,keywordRegex);
});

//functionality for category field
let categorySetterForm = document.getElementById('categorySetterForm') ;
let categorySetter = document.getElementById('categorySetter');
categorySetterForm.addEventListener('submit',e=>
{
	e.preventDefault();
	category = categorySetter.value;
	document.getElementById('posts').innerHTML = "";
	document.getElementById('pagination').innerHTML = "";
	createPosts(page,postPerPage,category);
});

//functionality for quantity field
let quantitySetterForm = document.getElementById('quantitySetterForm')
let quantitySetter = document.getElementById('quantitySetter');
quantitySetterForm.addEventListener('submit',e=>
{
	e.preventDefault();
	postPerPage = quantitySetter.value;
	document.getElementById('posts').innerHTML = "";
	document.getElementById('pagination').innerHTML = "";
	createPosts(page,postPerPage,category);
});

 

