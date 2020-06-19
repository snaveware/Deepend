const titleInput = document.getElementById('title')
const budgetInput =document.getElementById('budget')
const categoryInput = document.getElementById('category')
const categoryList = document.getElementById('category-list')
const skillsInput = document.getElementById('skills')
const skillsList = document.getElementById('skills-list')
const addSkillBtn = document.getElementById('add-skill')
const submitBtn = document.getElementById('job-submit-input')
const form = document.getElementById('new-job-form')
const baseUri = document.getElementById('base-url').innerHTML
const chosenSkillsContainer = document.getElementById('chosen-skills')
const jobDescriptionTextarea = document.getElementById('job-description-textarea')
const jobDescriptionLengthElement =document.getElementById('job-description-length')
let skills = []





function view(event,jobId)
{
  location.replace(`${baseUri}dashboard/jobs/${jobId}`)
}
function chooseSkill(item)
{
  alert(`choose skill ${item}`)
}
function chooseCategory(item)
{
  alert(`choose category ${item}`)
}

function getCategory()
{
  let beginWith = categoryInput.value.trim()
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUri}dashboard/jobs/category`,true)
  xhr.onreadystatechange = function(){
    if(this.status == 200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      if(response[0])
      {
        categoryList.innerHTML=""
        categoryList.style.display="block"
        response[1].forEach(element => {
          let newCategoryElement = document.createElement('li')
          newCategoryElement.setAttribute('onclick',`chooseCategory('${element.name}')`)
          newCategoryElement.innerHTML=element.name
          categoryList.appendChild(newCategoryElement)
        });   
      }
      else
      {
        categoryList.style.display="none";
      }
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(`begin_with=${beginWith}`)
}
function getSkills()
{
  let beginWith =skillsInput.value.trim()
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUri}dashboard/jobs/skills`,true)
  xhr.onreadystatechange = function(){
    if(this.status == 200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      if(response[0])
      {
        skillsList.style.display= "block";
        skillsList.innerHTML=""
        response[1].forEach(element => {
          let newSkillElement = document.createElement('li')
          newSkillElement.setAttribute('onclick',`chooseSkill('${element.name}')`)
          newSkillElement.innerHTML=element.name
          skillsList.appendChild(newSkillElement)
        });   
      }
      else
      {
        skillsList.style.display= "none";
      }
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(`begin_with=${beginWith}`)
}
function remove(event,index)
{
  event.target.parentNode.remove()
  languages.splice(parseInt(index),1)
}
addSkillBtn.addEventListener('click', ()=>{
  let value =skillsInput.value 
  if( value !== '')
  {
    let length = skills.push(value)
    let newSkill  = document.createElement('span')
    newSkill.setAttribute('class','new-skill')
    newSkill.innerHTML=`${value}<span onclick="remove(event,${length-1})">&times;</span>`
    chosenSkillsContainer.appendChild(newSkill)
    skillsInput.value=""
  }
})
skillsInput.addEventListener('keypress',e=>{
  if (e.key.toLocaleLowerCase() =='enter')
  {
    e.preventDefault()
    addSkillBtn.click()
    skillsList.style.display="none"
  }
})
function chooseCategory(value)
{
  categoryInput.value= value
  categoryList.style.display="none"
}
function chooseSkill(value)
{
  skillsInput.value= value
  skillsList.style.display="none"
  addSkillBtn.click()
}
categoryInput.addEventListener('keyup',()=> getCategory())
skillsInput.addEventListener('keyup',()=> getSkills())

jobDescriptionTextarea.addEventListener('keyup',()=>{
  charLength = parseInt(jobDescriptionTextarea.value.length)
  wordLength = parseInt(jobDescriptionTextarea.value.trim().split(' ').length)
  jobDescriptionLengthElement.innerHTML=`${charLength} Characters ${wordLength} Words `
})

form.addEventListener('submit',e=>{
  e.preventDefault()
  let title = titleInput.value
  let budget = budgetInput.value
  let  category = categoryInput.value
  let skillsString = skills.join('|').trim()
  let description = jobDescriptionTextarea.value
  let params = `title=${title}&budget=${budget}&category=${category}&skills=${skillsString}&description=${description}`
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUri}dashboard/jobs/add_job`,true)
  xhr.onreadystatechange = function()
  {
    if(this.status ==200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      console.log(response)
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(params)
})

