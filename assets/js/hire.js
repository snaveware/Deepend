baseUrl = document.getElementById('base-url').innerHTML
hireBtn = document.getElementById('hire');
hireBtn.addEventListener('click',e=>{
  xhr = new XMLHttpRequest
  xhr.open('post',`${baseUrl}dashboard/jobs/hire`,true)
  xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
  xhr.send()
})