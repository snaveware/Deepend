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


