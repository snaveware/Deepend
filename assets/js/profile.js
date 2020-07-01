let activeProfile = document.getElementById('profiles-list').firstElementChild.getAttribute('id');
let activeProfileId=document.getElementById('profiles-list').firstElementChild.getAttribute('profile-id');
var descriptionMore = document.getElementById('description-more');
let baseUrl = document.getElementById('base-url').innerHTML;
let editor;
let porfolioDescriptionEditor;
let portfolioTitle;
let imagesString;
let videosString
let activePortfolioId;

document.getElementById(activeProfile.toLowerCase()).classList.add('active-2');
descriptionMore.click();
ClassicEditor
.create( document.querySelector( '#editor' ) )
.then( myEditor => {
	editor = myEditor;
	console.log( editor)
} )
.catch( error => {
				console.error( error );
} );

function showProfile(event)
{
	document.getElementById(activeProfile).classList.remove('active-2');
	activeProfile = event.target.getAttribute('id');
	document.getElementById(activeProfile).classList.add('active-2');
	let id = parseInt(event.target.getAttribute('profile-id'));
	xhr = new XMLHttpRequest;
	xhr.open('get',`${baseUrl}profile/get?id=${id}`);
	xhr.onreadystatechange = function()
	{
		if(this.readyState==4 && this.status==200)
		{
			let profileData = JSON.parse(this.responseText);
			console.log(profileData);
			if(profileData[0]['id']=id)
			{
			document.getElementById('full-profile-description').innerHTML=
			profileData[0]['profile_description'];
			editor.setData(profileData[0]['profile_description']);
			let moreBtn= document.getElementById('description-more');
			moreBtn.innerHTML="less";
			moreBtn.click();

			let portfolioList =document.getElementById('portfolio-list');
			let addNew = portfolioList.lastElementChild;
			portfolioList.innerHTML="";
			for(let i in profileData[1])
			{
				portfolio = document.createElement('li');
				portfolio.setAttribute('portfolio-id',profileData[1][i].id);
				portfolio.setAttribute('onclick','showPortfolio(event)');
				let images = profileData[1][i].images.split('|');
				portfolio.innerHTML=
				`<img class="img-1" src="${baseUrl}assets/images/${images[0]}" 
				alt="portfolio image">
				<p class="heading-2">${profileData[1][i].portfolio_title}</p>`;
				portfolioList.appendChild(portfolio);
			}
			portfolioList.appendChild(addNew);

			}
		
		}
	}
	xhr.send();
}
function add(table="profiles")
{
	let title = prompt('Title: ','General');
	if(title != null)
	{
		let theData;
		if(table=='profiles')
		theData = 
		[
			['profile_title'],
			[title],
			'profiles'
		]
		else
		{
			theData = 
		[
			['portfolio_title','profile_id'],
			[title,activeProfileId],
			'portfolios'
		]
		}
		let data = JSON.stringify(theData);
		console.log(data);
		xhr = new XMLHttpRequest;

		xhr.open('POST',`${baseUrl}profile/add`,true);
		xhr.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				console.log(this.responseText);
				location.reload(true);
			}
		}
		xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
		xhr.send(`data=${data}`);

	}
}
function showMoreText(event,fullDescription,description)
{
	const data = document.getElementById(fullDescription).innerHTML;
	if(event.target.innerHTML =="more")
	{
		let mytext =data.substring(0,);
		event.target.previousElementSibling.innerHTML = mytext;
		event.target.innerHTML = "less";
	}
	else if(event.target.innerHTML =="less")
	{
		let mytext;
		if(data.length<800)
		{
			event.target.style.display="none";
			 mytext = data.substring(0,);
		}
		else
		{
			if(event.target.style.display="none")
			{
				event.target.style.display="block";
			}
			mytext =data.substring(0,800);
		}
		
		document.getElementById(description).innerHTML =mytext;
		event.target.innerHTML = "more";
	}
	else
	{
		console.log('error');
	}
}
function createImageLists(images)
{
	let lists = ``;
	for (let i in images) {
		if(images[i] !="" && images[i] != " ")
		{
			lists +=
			`
			<li>
				<img class="img-1" src="${baseUrl}assets/images/${images[i]}">
			</li>
			`
		}
		
	}
	return lists;
}
function createVideoLists(videos)
{
	let lists = ``;
	for (let i in videos) {
		if(videos[i]!=""&& videos[i] !=" ")
		{
			lists +=
			`
			<li>
				<video class="img-1" src="${baseUrl}assets/videos/${videos[i]}" controls Autoplay muted></video>
			</li>
			`
		}
		
	}
	return lists;
}
function edit(event)
{
	let editBtn = event.target;
	editBtn.style.display="none";
	let profileId = parseInt(document.getElementById(activeProfile).getAttribute('profile-id'));
	let id = event.target.getAttribute('id');
	if(id == 'edit-profile-description')
	{
		document.getElementById("profile-description-container").style.display="none";
		document.getElementById('editor-container').style.display="flex";
		let save = document.createElement('button');
		save.setAttribute('class','btn-2');
		save.innerHTML="save";
		save.addEventListener('click',e=>{
			e.target.style.display="none";
			editBtn.style.display="block";
			const descriptionMore = document.getElementById('description-more');
			let	xhr = new XMLHttpRequest;
			let value= `${editor.getData()}`;
			
			xhr.open('post',`${baseUrl}profile/update`,true);
			xhr.onreadystatechange = function()
			{
				if(this.readyState == 4 && this.status == 200)
				{
					document.getElementById('full-profile-description').innerHTML= value;
					profDescriptionMore = document.getElementById('description-more');
					profDescriptionMore.innerHTML="less";
					profDescriptionMore.click();
					document.getElementById("profile-description-container").style.display="block";
					document.getElementById('editor-container').style.display="none";
				}
			}
			xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
			console.log(value);
			xhr.send(`id=${profileId}&value=${value}&column=profile_description`);
		});
		event.target.parentNode.appendChild(save);
	}

}

function showPortfolio(event)
{
	let id = parseInt(event.target.parentNode.getAttribute('portfolio-id'));
	portfolioTitle = id;
	activePortfolioId=id;
 	let	xhr = new XMLHttpRequest;
	xhr.open('get',`${baseUrl}profile/get?table=portfolios&id=${id}`,true);
	xhr.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			const portfolio = JSON.parse(this.responseText);
			console.log(portfolio);
			const fullPortfolioParentNode = document.getElementById('profile-data');

			let  fullPortfolioDiv = document.createElement('div');
			fullPortfolioDiv.setAttribute('id','fullPortfolioDiv');

			let closeBtn = document.createElement('p')
			closeBtn.style.textAlign="right";
			closeBtn.style.fontSize = "2rem";
			closeBtn.style.marginRight="30px";
			closeBtn.style.color="var(--base-link-color-2)";
			closeBtn.style.cursor="pointer";
			closeBtn.addEventListener('click', e =>{
				e.target.parentNode.remove();
			})
			closeBtn.innerHTML = "&times;"
			fullPortfolioDiv.appendChild(closeBtn);

			let title = document.createElement('p');
			title.innerHTML=portfolio[0]['portfolio_title']
			title.style.margin= "30px"
			title.style.textAlign="center";
			title.setAttribute('class','just-heading-1');
			title.style.borderBottom ="0.5px solid var(--base-outline-color)"
			title.style.paddingBottom="5px";
			fullPortfolioDiv.appendChild(title);

			let subheading1 = document.createElement('h2');
			subheading1.innerHTML = "Images";
			subheading1.setAttribute('class','heading-2');
			subheading1.style.textAlign="center";
			fullPortfolioDiv.appendChild(subheading1);

			let fullPortfolioImages = document.createElement('ul');
			fullPortfolioImages.setAttribute('class','list-i flexbox-row-left');
			fullPortfolioImages.setAttribute('id','full-portfolio-images');
			if(portfolio[0]['images'].length != 0)
			{
				imagesString=portfolio[0]['images'];
			let imagesArray = imagesString.split('|');
			console.log(imagesArray);
			fullPortfolioImages.innerHTML= createImageLists(imagesArray) ;
			}
			fullPortfolioImages.innerHTML += 
			`<li style="border:0.5px dotted var(--base-outline-color);min-height:150px;" onclick="addPortfolioItem()" >
				<span style="color:var(--base-link-color-2);
				position:relative;top:45%;left:45%;font-size:3rem;font-weight:lighter;">+
				</span>
			</li>`;
			fullPortfolioDiv.appendChild(fullPortfolioImages);

			let subheading2 = document.createElement('h2');
			subheading2.innerHTML = "Videos";
			subheading2.setAttribute('class','heading-2');
			subheading2.style.textAlign="center";
			fullPortfolioDiv.appendChild(subheading2);

			let fullPortfolioVideos = document.createElement('ul');
			fullPortfolioVideos.setAttribute('class','list-i flexbox-row-left');
			fullPortfolioVideos.setAttribute('id','full-portfolio-videos')
			if(portfolio[0]['videos'] != "");
			{
				videosString = portfolio[0]['videos'].trim()
				let videosArray = portfolio[0]['videos'].split('|');
				console.log(videosArray);
				fullPortfolioVideos.innerHTML= createVideoLists(videosArray) ;
			}
			fullPortfolioVideos.innerHTML += 
			`<li style="border:0.5px dotted var(--base-outline-color)" onclick="addPortfolioItem()" >
				<span style="color:var(--base-link-color-2);
				position:relative;top:45%;left:45%;font-size:3rem;font-weight:lighter;">+
				</span>
			</li>`;
			fullPortfolioDiv.appendChild(fullPortfolioVideos);

			let subheading3 = document.createElement('h2');
			subheading3.innerHTML = "Description";
			subheading3.setAttribute('class','heading-2');
			subheading3.style.textAlign="center";
			fullPortfolioDiv.appendChild(subheading3);

			let fullPortfolioDescription = document.createElement('article');
			fullPortfolioDescription.classList.add('just-text-1');
			fullPortfolioDescriptionOptions = document.createElement('p')
			fullPortfolioDescriptionOptions.innerHTML = 
			`
			<p class="options"><button style="margin:10px;" id="edit-portfolio-description"
			onclick="editPortfolio(event)">edit</button></p>
			`
			fullPortfolioDescription.appendChild(fullPortfolioDescriptionOptions);

			let fullPortfolioDescriptionContent = document.createElement('div');
			fullPortfolioDescriptionContent.setAttribute("id","full-portfolio-description-content")
			fullPortfolioDescriptionContent.style.position="relative";
			fullPortfolioDescriptionContent.innerHTML = 
			`
			<span style="display:none;" id="full-portfolio-description">
				${portfolio[0]['portfolio_description']}
			</span>
			<span id="portfolio-description"></span>
			<button id="portfolio-description-more" class="btn-2" onclick="
			showMoreText(event,'full-portfolio-description','portfolio-description')">less</button>
			`
			fullPortfolioDescription.appendChild(fullPortfolioDescriptionContent);
			fullPortfolioDiv.appendChild(fullPortfolioDescription);
			
			let editorContainer = document.createElement('div');
			editorContainer.setAttribute('id','portfolio-editor-container');
			editorContainer.style.display="none";
			let thePortfolioDescriptionEditor = document.createElement('div');
			thePortfolioDescriptionEditor.setAttribute('id','portfolio-description-editor');
			thePortfolioDescriptionEditor.innerHTML = portfolio[0]['portfolio_description'];
			editorContainer.appendChild(thePortfolioDescriptionEditor);
			fullPortfolioDiv.appendChild(editorContainer);

			fullPortfolioParentNode.appendChild(fullPortfolioDiv);
			const portfolioDescriptionMore = document.getElementById('portfolio-description-more');
			portfolioDescriptionMore.click();
			console.log(document.getElementById('portfolio-description-editor'))
			ClassicEditor
			.create( document.querySelector( '#portfolio-description-editor') )
			.then( myEditor => {
				porfolioDescriptionEditor = myEditor;
				console.log( myEditor);
			} )
			.catch( error => {
				console.error(error);
			} );

		}
	}
	xhr.send();
}

function editPortfolio(event)
{
	let portfolioDescriptionEditBtn = event.target
	portfolioDescriptionEditBtn.style.display="none";
	let id = event.target.getAttribute('id');
	if(id == 'edit-portfolio-description')
	{
		document.getElementById("full-portfolio-description-content").style.display="none";
		document.getElementById('portfolio-editor-container').style.display="block";
		let save = document.createElement('button');
		save.setAttribute('class','btn-2');
		save.innerHTML="save";
		save.addEventListener('click',e=>{
			e.target.style.display="none";
			portfolioDescriptionEditBtn.style.display="block";
			const descriptionMore = document.getElementById('portfolio-description-more');
			let	xhr = new XMLHttpRequest;
			let portfolioDescriptionvalue= porfolioDescriptionEditor.getData();
			console.log(portfolioDescriptionvalue);
			xhr.open('post',`${baseUrl}profile/update`,true);
			xhr.onreadystatechange = function()
			{
				if(this.readyState == 4 && this.status == 200)
				{
					document.getElementById('full-portfolio-description').innerHTML=portfolioDescriptionvalue;
					let portDescriptionMore =document.getElementById('portfolio-description-more');
					portDescriptionMore.innerHTML = 'less';
					portDescriptionMore.click();

					document.getElementById("full-portfolio-description-content").style.display="block";
					document.getElementById('portfolio-editor-container').style.display="none";
				}
			}
			xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
			xhr.send(`table=portfolios&title=${portfolioTitle}&value=${portfolioDescriptionvalue}&column=portfolio_description`);
		});
		event.target.parentNode.appendChild(save);
	}

}
function addPortfolioItem()
{
	let uploader= document.getElementById('select-file');
	uploader.click();
}
function updatePortfolioImages(newValue)
{
	xhr = new XMLHttpRequest;
	xhr.open('post',`${baseUrl}profile/update`,'true')
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	console.log(activePortfolioId);
	xhr.send(`table=portfolios&column=images&value=${newValue}&id=${activePortfolioId}`);
}
function updatePortfolioVideos(newValue)
{
	xhr = new XMLHttpRequest;
	xhr.open('post',`${baseUrl}profile/update`,'true')
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	console.log(activePortfolioId);
	xhr.send(`table=portfolios&column=videos&value=${newValue}&id=${activePortfolioId}`);
}

function upload(e)
{
	let portfolioId = document.getElementById('')
	let file = e.target.files[0];
	let formData = new FormData();
	formData.append('file',file);
	xhr= new XMLHttpRequest;
	xhr.open('post',`${baseUrl}upload`,true);
	xhr.onreadystatechange= function()
	{
		if(this.readyState==4 &&this.status==200)
		{
			let data = JSON.parse(this.responseText);
			console.log(data)
			if(data.upload_data.file_type.search('image') !=-1)
			{
				let newImages;
				console.log('image string: '+imagesString);
				newImages=`${imagesString}|${data.upload_data.file_name}`;
				imagesString=newImages;
				updatePortfolioImages(newImages);
				let newImage = document.createElement('li');
				newImage.innerHTML=`<img class="img-1" src="${baseUrl}assets/images/${data.upload_data.file_name}">`
				let imageList =document.getElementById('full-portfolio-images')
				let lastChild = imageList.lastElementChild;
				imageList.lastElementChild.remove();
				imageList.appendChild(newImage);
				imageList.appendChild(lastChild);	
			}
			else if(data.upload_data.file_type.search('video') !=-1)
			{
				let newVideos;
				console.log('image string: '+videosString);
				newVideos=`${videosString}|${data.upload_data.file_name}`;
				videosString=newVideos;
				updatePortfolioVideos(newVideos);
				let newVideo = document.createElement('li');
				newVideo.innerHTML=`<video class="img-1" src="${baseUrl}assets/videos/${data.upload_data.file_name}" controls Autoplay muted></video>`
				let videoList=document.getElementById('full-portfolio-videos')
				let lastChild = videoList.lastElementChild;
				videoList.lastElementChild.remove();
				videoList.appendChild(newVideo);
				videoList.appendChild(lastChild);	
			}
		}
	}
	xhr.send(formData);
}
