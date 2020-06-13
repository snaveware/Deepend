const form = document.getElementById("signup-form")
const firstNameInput = document.getElementById('first-name')
const lastNameInput = document.getElementById('last-name')
const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')
const confirmPasswordInput = document.getElementById('confirm-password')
const showPasswordBtn = document.getElementById('show-password')
const accountTypeContainer = document.getElementById('account-type-container')
const accountTypeInput = document.getElementById('account-type')
const accountTypeList = document.getElementById('account-type-list')
const accountTypeEmployerBtn = document.getElementById('employer')
const accountTypeSellerBtn = document.getElementById('seller')
const cityInput = document.getElementById("city")
const countryInput = document.getElementById('country')
const chosenLanguagesContainer = document.getElementById("chosen-languages")
const languagesInput = document.getElementById('languages')
const addLanguageBtn = document.getElementById('add-language')
const telephoneInput = document.getElementById('telephone')
const descriptionTextarea = document.getElementById('description-textarea')
const submitBtn = document.getElementById('submit-input')
let languages=[];

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

accountTypeContainer.addEventListener('click',e => accountTypeList.style.display="block")
accountTypeSellerBtn.addEventListener('click',e=>{
  accountTypeInput.value = "seller"
  accountTypeList.style.display="none"
})
accountTypeEmployerBtn.addEventListener('click',e=>{
  accountTypeInput.value = "employer"
  accountTypeList.style.display="none"
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

form.addEventListener('submit',e=>{
  e.preventDefault()
  submitBtn.disabled=true
  submitBtn.style.cursor="progress"
  submitBtn.style.opacity="50%"
  
})


