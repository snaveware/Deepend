const proposalForm = document.getElementById('proposal-form')
const amountInput = document.getElementById("amount")
const coverLetterTextarea = document.getElementById("cover-letter-textarea")
const submitBtn = document.getElementById('proposal-submit-input')
const coverLetterLengthElement = document.getElementById('cover-letter-length')
const baseUrl = document.getElementById('base-url').innerHTML
function showError(error)
{
  if(error =="job")
  {
    alert("No Job has been selected")
    location.replace(`${baseUrl}jobs`)
  }
  else
  {
    alert("Please Login or Create an account first")
    submitBtn.disabled=true
    submitBtn.style.opacity="50%"
    submitBtn.title="please login and reload the page"
    
  }
  
}
coverLetterTextarea.addEventListener('keyup',()=>{
  charLength = parseInt(coverLetterTextarea.value.length)
  wordLength = parseInt(coverLetterTextarea.value.trim().split(' ').length)
  coverLetterLengthElement.innerHTML=`${charLength} Characters ${wordLength} Words `
})

proposalForm.addEventListener('submit',e=>{
  e.preventDefault()
  submitBtn.disabled=true
  let jobId =proposalForm.getAttribute('job-id')
  let amount = amountInput.value
  let coverLetter = coverLetterTextarea.value
  let params = `job_id=${jobId}&amount=${amount}&cover_letter=${coverLetter}` 
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUrl}jobs/send_proposal`,true)
  xhr.onreadystatechange = function (){
    if(this.status== 200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      if(response[0])
      {
        let successElement =document.getElementById('success')
        successElement.innerHTML=`Your Proposal has been sent<a class="btn" href="${baseUrl}dashboard/proposals">View</a>`
      }
    }
  }
  xhr.setRequestHeader('content-type',"application/x-www-form-urlencoded")
  xhr.send(params)
})