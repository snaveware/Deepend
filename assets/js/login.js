const loginBtn = document.getElementById('login-btn');
const loginForm = document.getElementById('login-form');
const closeBtn = document.getElementById('close');
const emailField = document.getElementById('email-input');
const passwordField = document.getElementById('password-input');
const keep = document.getElementById('keep');
const errorsField = document.getElementById('login-errors');
const accountBtns = document.getElementById('account-buttons'); 
const accountsPosition = document.getElementById('nav-account');
let image;
loginBtn.addEventListener('click',e=>{
	if(loginForm.style.display='none')
	{
		loginForm.style.display='block';
	}
	else
	{
		loginForm.style.display='none';
	}
})

closeBtn.addEventListener('click',e=>{
	loginForm.style.display ="none";
})

loginForm.addEventListener('submit',e=>{
	e.preventDefault();
	let email =emailField.value;
	let password = passwordField.value;
	let keepValue = keep.checked? 'checked':'not checked';
	console.log(keepValue);
	xhr = new XMLHttpRequest();
	xhr.open('POST','login/validate',true);
	xhr.onreadystatechange = function() 
	{
		if(this.readyState == 4 && this.status == 200)
		{
			let response = JSON.parse(this.responseText);
			if(response[0] == 'success')
			{
				closeBtn.click();
				accountsPosition.innerHTML= `
				<div style="width:100px;height:70px;" id="account">
					<div style="background-color:white;border-radius:25% 2px 2px 25%">
						<img class="avatar" src="assets/images/${response[1]}" alt="profile">
						<span class="caret"></span>
					</div>
					<ul class = "list-e" id="list-e">
						<li><a href="dashboard/profile"> <i style="padding:5px;" class="fa fa-user"></i> Profile</a></li>
						<li><a href="#"><i style="padding:5px;" class="fa fa-wrench"></i>Jobs</a></li>
						<li><a href="#"><i style="padding:5px;" class="fa fa-cog"></i>Settings</a></li>
						<li><a  href="logout"><i style="padding:5px;" class="fa fa-sign-out"></i>logout</a></li>
					</ul>
				</div>`
			}
			else
			{
				errorsField.innerHTML = response.email_error + response.password_error;
				console.log(response);
			}
		
		}
	}
	xhr.setRequestHeader('content-type',
	'application/x-www-form-urlencoded');
	xhr.send(`email=${email}&password=${password}
	&keep=${keepValue}`);
})