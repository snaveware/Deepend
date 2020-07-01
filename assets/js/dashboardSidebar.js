const uploader = document.getElementById('profile-uploader')
const profileOverly = document.getElementById('profile-overly')
const profileChangeBtn = document.getElementById('change-btn')
const baseUrl = document.getElementById('base-url').innerHTML
profileChangeBtn.addEventListener('click',()=> uploader.click())
uploader.addEventListener('change',e=>{
  e.preventDefault()
  let file = e.target.files[0];
  let formData = new FormData();
	formData.append('file',file);
  xhr= new XMLHttpRequest;
  xhr.open('post',`${baseUrl}upload`,true);
  xhr.onreadystatechange = function()
  {
    if(this.status==200 && this.readyState == 4)
    {
      let response = JSON.parse(this.responseText)
      //console.log(response.upload_data.file_name)
      xhr2 = new XMLHttpRequest;
      xhr2.open('post',`${baseUrl}dashboard/settings/change_profile`,true)
      xhr2.onreadystatechange = function()
      {
        if(this.status==200 && this.readyState == 4)
        {
          let response = JSON.parse(this.responseText)
          console.log(response)
          location.reload();
        }
      }
      xhr2.setRequestHeader('content-type','application/x-www-form-urlencoded')
      xhr2.send(`profile=${response.upload_data.file_name}`)
    } 
  }
  xhr.send(formData)
  
})