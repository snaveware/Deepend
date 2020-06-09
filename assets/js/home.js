const usersElement = document.getElementById('slidesContainer');
const usersContainer = document.getElementById('users');
let slideElements ;
function create_users(accountType) 
{
	xhr = new XMLHttpRequest();
	xhr.open('get',`home/get_users`,true);	
	xhr.onreadystatechange = function() 
	{
		let users = [];
		if(this.readyState==4 && this.status==200)
		{
			users =JSON.parse(this.responseText);
			console.log(users);
			/*for (let i=0;i<users.length-2;i++) {
				let li = document.createElement('li');
				li.innerHTML = `<img src="assets/images/${users[i].image}"> 
				<p> ${users[i].first_name}&nbsp;${users[i].last_name}</p>
				<p>Top Rated<i class="fa fa-shield just-text-2"></i> ${users[i].account_type}</p>`;
				li.classList.add('user');
				li.style.width="200px";
				usersElement.appendChild(li);
			}//end loop*/
				slideElements = document.getElementsByClassName('user');
			setInterval(slide,2000);
			function slide()
			{
				data = slideElements[0].innerHTML;
				slideElements[0].style.transition= "2s linear 0.5s";
				slideElements[0].parentNode.removeChild(slideElements[0]);
				let newLi= document.createElement('li');
				newLi.innerHTML = data;
				newLi.classList.add('user');
				usersElement.appendChild(newLi);
			}
			const userCountElement = document.getElementById('user-count');
			let sellers = document.createElement('li');
			var sellersSpan1 = document.createElement('span');
			sellersSpan1.innerHTML = 0;
			sellers.appendChild(sellersSpan1);
			let sellersSpan2 = document.createElement('small');
			sellersSpan2.innerHTML =` Sellers`;
			sellers.appendChild(sellersSpan2);
			userCountElement.appendChild(sellers);
			let buyers = document.createElement('li');
			var buyersSpan1 = document.createElement('span');
			buyersSpan1.innerHTML = 0;
			buyers.appendChild(buyersSpan1);
			let buyersSpan2 = document.createElement('small');
			buyersSpan2.innerHTML =` Employers`;
			buyers.appendChild(buyersSpan2);
			userCountElement.appendChild(buyers);
			var number1 = parseInt(users[users.length-1].sellers)
			var number2 = parseInt(users[users.length-2].buyers)
			var counter1 = 1;
			var counter2 = 1;
			let interval1 = setInterval(() => {
				if (counter1 == number1)
				{
					clearInterval(interval1);
				}
				sellersSpan1.innerHTML =counter1+'+';
				counter1++;
			}, 100);
			let interval2 = setInterval(() => {
				if (counter2 == number2)
				{
					clearInterval(interval2);
				}
				buyersSpan1.innerHTML =counter2+'+';
				counter2++;
			}, 100);
		}//end if
	}//end function
	xhr.send();
}//end function
create_users();

