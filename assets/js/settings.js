const form = document.getElementById("signup-form")
const firstNameInput = document.getElementById('first-name')
const lastNameInput = document.getElementById('last-name')
const emailInput = document.getElementById('email')
const genderContainer = document.getElementById('gender-container')
const genderInput = document.getElementById('gender')
const languagesInput = document.getElementById('languages')
const cityInput = document.getElementById("city")
const countryInput = document.getElementById('country')
const telephoneInput = document.getElementById('telephone')
const descriptionTextarea = document.getElementById('description-textarea')
const submitBtn = document.getElementById('submit-input')
const genderList = document.getElementById('gender-list')
const genderMaleBtn = document.getElementById('male')
const genderFemaleBtn = document.getElementById('female')
const genderOtherBtn = document.getElementById('other')
const base = document.getElementById('base-url').innerHTML
const personalDetailsBtn = document.getElementById('personal-details')
const profilesBtn = document.getElementById("profiles")
const profilesElement = document.getElementById('profiles-element')
const personalDetailsForm=document.getElementById('signup-form')
const portfoliosBtn = document.getElementById('portfolios')
const portfoliosElement = document.getElementById('portfolios-element')
const modalContainerCloseBtn = document.getElementById('modal-close')
let originalImagesArray;
let originalVideosArray;
function getPortfolioMedia(id,column="images")
{
  let xhr = new XMLHttpRequest
  if(column =='images')
  {
    xhr.open('post',`${base}dashboard/settings/get_portfolio_images/${id}`,true)
  }
  else
  {
    xhr.open('post',`${base}dashboard/settings/get_portfolio_videos/${id}`,true)
  }
  
  xhr.onreadystatechange = function()
  {
    if(this.status==200 && this.readyState ==4)
    {
      let response = JSON.parse(this.responseText)
      if(column=='images')
      {
        originalImagesArray = response.trim().split('|')
      }
      else
      {
        originalVideosArray=response.trim().split('|')
      }
      
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send()
}
genderContainer.addEventListener('click',e => {
  let display = genderList.style.display
  if(display !=="block")
  {
    genderList.style.display="block"
  }
  else
  {
    genderList.style.display="none"
  }
})

genderMaleBtn.addEventListener('click',e=>{
  genderInput.value = "male"
  genderList.style.display="none"
})

genderFemaleBtn.addEventListener('click',e=>{
  genderInput.value = "female"
  genderList.style.display="none"
})
genderOtherBtn.addEventListener('click',e=>{
  genderInput.value = "other"
  genderList.style.display="none"
})

form.addEventListener('submit',e=>{
  e.preventDefault()
  let location= `${cityInput.value}|${countryInput.value}`
  personalDetails = {first_name:firstNameInput.value,last_name:lastNameInput.value,email:emailInput.value,
  gender:genderInput.value,telephone:telephoneInput.value,languages:languagesInput.value,location:location,
  user_description:descriptionTextarea.value}
  xhr = new XMLHttpRequest;
  xhr.open('post',`${base}dashboard/settings/save`,true)
  xhr.onreadystatechange = function()
  {
    if(this.status==200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText);
      console.log(response)
      if(response[0])
      {
        alert('Saved successfully')
        window.location.reload();
      }
      else
      {
        alert(response[1])
      }
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(`personal_data=${JSON.stringify(personalDetails)}`)
})
function deleteProfile(event,id)
{

  let isSure= confirm(`Are you sure you want to delete ${event.target.previousSibling.previousSibling.innerHTML} profile`)
  if(!isSure)
  {
    return;
  }
  xhr = new XMLHttpRequest
  xhr.open('post',`${base}dashboard/settings/delete_profile/${id}`,true)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.onreadystatechange = function()
  {
    if(this.status == 200 && this.readyState == 4)
    {
      response = this.responseText
      console.log(response)
      event.target.parentNode.remove();
    }
  }
  xhr.send()
}

function deletePortfolio(event,id)
{

  let isSure= confirm(`Are you sure you want to delete ${event.target.previousSibling.previousSibling.innerHTML} portfolio`)
  if(!isSure)
  {
    return;
  }
  xhr = new XMLHttpRequest
  xhr.open('post',`${base}dashboard/settings/delete_portfolio/${id}`,true)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.onreadystatechange = function()
  {
    if(this.status == 200 && this.readyState == 4)
    {
      response = this.responseText
      console.log(response)
      event.target.parentNode.remove();
    }
  }
  xhr.send()
}
personalDetailsBtn.addEventListener('click',()=>{
  profilesElement.style.display="none"
  portfoliosElement.style.display="none"
  personalDetailsForm.style.display="block";

})
profilesBtn.addEventListener('click',()=>{
  personalDetailsForm.style.display="none"
  portfoliosElement.style.display="none"
  profilesElement.style.display="block"
  
})
portfoliosBtn.addEventListener('click',()=>{
  personalDetailsForm.style.display="none"
  profilesElement.style.display="none"
  portfoliosElement.style.display="block"
  
})

function showPortfolioImages(event,id)
{
  getPortfolioMedia(id,'images')
  let modalContainer = document.getElementById('modal-container')
  let modal = document.getElementById('modal')
  let imagesArray = originalImagesArray
  for (const i in imagesArray) 
  {
    let newItem = document.createElement('li')
    newItem.innerHTML= `<img class="avatar-2" src="${base}assets/images/${imagesArray[i]}">
    <p style="position:relative;left:46%;"class="btn-3 fa fa-trash"onclick="deletePortfolioImage(event,'${id}','${i}')"></p>`
    modal.appendChild(newItem)
    modalContainer.style.display="block"
  }
}

function showPortfolioVideos(event,id)
{
  getPortfolioMedia(id,'videos')
  let modalContainer = document.getElementById('modal-container')
  let modal = document.getElementById('modal')
  let videosArray =originalVideosArray
  for (const i in videosArray) 
  {
    let newItem = document.createElement('li')
    newItem.innerHTML= `<video class="avatar-2" src="${base}assets/videos/${videosArray[i]}" autoplay muted loop></video>
    <p style="position:relative;left:46%;"class="btn-3 fa fa-trash"onclick="deletePortfolioVideo(event,'${id}','${i}')"></p>`
    modal.appendChild(newItem)
    modalContainer.style.display="block"
  }
}
modalContainerCloseBtn.addEventListener('click',e=>{
  modal = document.getElementById('modal')
  e.target.parentNode.style.display="none"
  modal.innerHTML=''
})

function deletePortfolioImage(event,id,index)
{
  
  let isSure= confirm(`Are you sure you want to delete this image`)
  if(!isSure)
  {
    return;
  }
  originalImagesArray.splice(index,1)
  console.log(originalImagesArray)
  let newImagesString  = originalImagesArray.join('|')
  xhr = new XMLHttpRequest
  xhr.open('post',`${base}profile/update`,true)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.onreadystatechange = function()
  {
    if(this.status == 200 && this.readyState == 4)
    {
      response = this.responseText
      console.log(response)
      event.target.parentNode.remove();
    }
  }
  xhr.send(`table=portfolios&column=images&value=${newImagesString}&id=${id}`);
}

function deletePortfolioVideo(event,id,index)
{
  
  let isSure= confirm(`Are you sure you want to delete this video?`)
  if(!isSure)
  {
    return;
  }
  originalVideosArray.splice(index,1)
  console.log(originalVideosArray)
  let newVideosString  = originalVideosArray.join('|')
  xhr = new XMLHttpRequest
  xhr.open('post',`${base}profile/update`,true)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.onreadystatechange = function()
  {
    if(this.status == 200 && this.readyState == 4)
    {
      response = this.responseText
      console.log(response)
      event.target.parentNode.remove();
    }
  }
  xhr.send(`table=portfolios&column=videos&value=${newVideosString}&id=${id}`);
}


