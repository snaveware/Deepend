function selectProfile()
{
  let title = document.getElementById('profile-title').innerHTML
  console.log(title)
  const currentProfileNavigationElement = document.getElementById(title)
  console.log(currentProfileNavigationElement)
  currentProfileNavigationElement.style.backgroundColor="#f4f4f4"
}
selectProfile()