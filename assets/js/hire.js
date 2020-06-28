const baseUrl = document.getElementById('base-url').innerHTML
const hireBtn = document.getElementById('hire');

function hire(jobId,sellerId,amount)
{
  console.log(jobId,sellerId,amount)
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUrl}dashboard/jobs/hire`,true)
  let params = `job_id=${jobId}&seller_id=${sellerId}&amount=${amount}`
  xhr.onreadystatechange = function()
  {
    if(this.status==200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      if(response[0])
      {
        alert(response[1])
      }
    }
  }
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send(params)
}