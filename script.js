
document.querySelectorAll('.nav-link').forEach(link => {
    console.log(link)
    if(link.href === window.location.href){
      link.setAttribute('aria-current', 'page')
      link.classList.add('active')
    }
  })
   