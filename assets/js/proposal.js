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
  submitBtn.style.cursor="none"
  submitBtn.style.opacity="0.3"
  let searchArray =window.location.search.trim().split('=')
  let jobId =searchArray.pop()
  console.log(jobId);
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
        successElement.innerHTML=`Your Proposal has been sent<a class="btn-3" href="${baseUrl}dashboard/proposals">View</a>`
        submitBtn.disabled=false
        submitBtn.style.cursor="pointer"
        submitBtn.style.opacity="1"
      }
      else
      {
        alert(response[1])
        submitBtn.disabled=false
        submitBtn.style.cursor="pointer"
        submitBtn.style.opacity="1"
      }
    }
  }
  xhr.setRequestHeader('content-type',"application/x-www-form-urlencoded")
  xhr.send(params)
})