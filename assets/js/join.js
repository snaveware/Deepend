const form = document.getElementById("signup-form")
const firstNameInput = document.getElementById('first-name')
const lastNameInput = document.getElementById('last-name')
const emailCheck = document.getElementById('email-check')
const emailErrorElement = document.getElementById('email-error')
const emailInput = document.getElementById('email')
const passwordErrorElement = document.getElementById('password-error')
const passwordInput = document.getElementById('password')
const passwordCheck = document.getElementById('password-check')
const confirmPasswordInput = document.getElementById('confirm-password')
const showPasswordBtn = document.getElementById('show-password')
const accountTypeContainer = document.getElementById('account-type-container')
const accountTypeInput = document.getElementById('account-type')
const accountTypeList = document.getElementById('account-type-list')
const accountTypeEmployerBtn = document.getElementById('employer')
const accountTypeSellerBtn = document.getElementById('seller')
const genderContainer = document.getElementById('gender-container')
const genderInput = document.getElementById('gender')
const genderList = document.getElementById('gender-list')
const genderMaleBtn = document.getElementById('male')
const genderFemaleBtn = document.getElementById('female')
const genderOtherBtn = document.getElementById('other')
const cityInput = document.getElementById("city")
const countryInput = document.getElementById('country')
const chosenLanguagesContainer = document.getElementById("chosen-languages")
const languagesInput = document.getElementById('languages')
const addLanguageBtn = document.getElementById('add-language')
const telephoneInput = document.getElementById('telephone')
const descriptionTextarea = document.getElementById('description-textarea')
const submitBtn = document.getElementById('submit-input')
const baseUri = document.getElementById('base-url').innerHTML
const errorsContainer = document.getElementById('errors')
let languages=[]

function verifyPassword(){
  let password = passwordInput.value
  if(password.length<6)
  {
    passwordErrorElement.innerHTML='password should be more than 6 characters'
  }
  else
  {
    passwordErrorElement.innerHTML=''
  }
}
passwordInput.addEventListener('keyup',()=> verifyPassword())
passwordInput.addEventListener('change',()=> verifyPassword())
confirmPasswordInput.addEventListener('keyup',e=>{
  let password = passwordInput.value
  let confirmedPassword = confirmPasswordInput.value
  if(password != confirmedPassword)
  {
    passwordErrorElement.innerHTML='passwords do not match'
  }
  else
  {
    passwordErrorElement.innerHTML=''
    passwordCheck.style.display="block"
  }
})

showPasswordBtn.addEventListener('click',e=>{
  let typeAttribute = passwordInput.getAttribute('type');
  if(typeAttribute === "password")
  {
    passwordInput.setAttribute('type','text')
    confirmPasswordInput.setAttribute('type','text')
  }
  else
  {
    passwordInput.setAttribute('type','password')
    confirmPasswordInput.setAttribute('type','password')
  }
})

accountTypeContainer.addEventListener('click',e => {
  let display = accountTypeList.style.display
  if(display !=="block")
  {
    accountTypeList.style.display="block"
  }
  else
  {
    accountTypeList.style.display="none"
  }
})

accountTypeSellerBtn.addEventListener('click',e=>{
  accountTypeInput.value = "seller"
  accountTypeList.style.display="none"
})

accountTypeEmployerBtn.addEventListener('click',e=>{
  accountTypeInput.value = "employer"
  accountTypeList.style.display="none"
})




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

function remove(event,index)
{
  event.target.parentNode.remove()
  languages.splice(parseInt(index),1)
}

languagesInput.addEventListener('keypress',e=>{
  if (e.key.toLocaleLowerCase() =='enter')
  {
    e.preventDefault()
    addLanguageBtn.click()
  }
})

function verifyEmail(){
  let email = emailInput.value.trim()
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUri}join/check_email`,true)
  xhr.onreadystatechange = function(){
    if(this.status == 200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      if(response[0])
      {
        emailErrorElement.innerHTML=''
        emailCheck.style.display="block";
      }
      else
      {
        emailCheck.style.display="none"
        emailErrorElement.innerHTML=response[1]
      }
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(`email=${email}`)
}
emailInput.addEventListener('keyup',() => verifyEmail())
emailInput.addEventListener('change',() => verifyEmail())

addLanguageBtn.addEventListener('click', ()=>{
  let value =languagesInput.value 
  if( value !== '')
  {
    let length = languages.push(value)
    let newLanguage  = document.createElement('span')
    newLanguage.setAttribute('class','new-language')
    newLanguage.innerHTML=`${value}<span onclick="remove(event,${length-1})">&times;</span>`
    chosenLanguagesContainer.appendChild(newLanguage)
    languagesInput.value=""
  }
})
descriptionTextarea.addEventListener('keyup',()=>{
  length = parseInt(descriptionTextarea.value.length)
  const descriptionLengthElement = document.getElementById('description-length')
  descriptionLengthElement.innerHTML=`<span class="just-text-2"style="font-size:0.9rem;">${50-length}</span> Characters Remaining `
})
form.addEventListener('submit',e=>{
  e.preventDefault()
  let firstName = firstNameInput.value.trim()
  let lastName = lastNameInput.value.trim()
  let email=emailInput.value.trim()
  let password = passwordInput.value.trim()
  let accountType = accountTypeInput.value.trim()
  let gender = genderInput.value.trim()
  let city = cityInput.value.trim()
  let country = countryInput.value.trim()
  let telephone = telephoneInput.value.trim()
  let description =descriptionTextarea.value.trim()
  let languagesString='';
  if(languages.length > 0)
  {
    languagesString = languages.join('|').trim()
  }
  submitBtn.disabled=true
  submitBtn.style.cursor="progress"
  submitBtn.style.opacity="50%"
  let xhr = new XMLHttpRequest
  xhr.open('post',`${baseUri}join`,true)
  xhr.onreadystatechange= function(){
    if(this.status==200 && this.readyState == 4)
    {
      submitBtn.disabled=false
      submitBtn.style.cursor="pointer"
      submitBtn.style.opacity="100%"
      let response = JSON.parse(this.responseText)
      if(response="joined")
      {
        location.replace(baseUri);
      }
      else
      {
        errorsContainer.innerHTML=response
        alert('please correct the errors above')
      }
     
    }
  }
  params=`first_name=${firstName}&last_name=${lastName}&email=${email}&password=${password}
  &account_type=${accountType}&gender=${gender}&city=${city}&country=${country}&telephone=${telephone}
  &description=${description}&languages=${languagesString}`
  console.log(params)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(params)
})


