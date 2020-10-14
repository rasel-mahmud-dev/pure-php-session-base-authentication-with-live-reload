

// Global 
const backdrop = document.querySelector("#backdrop")
const container = document.querySelector(".container") 


// Nav Item Active
const mainNav = document.querySelector(".main_nav");
const route = window.location.pathname
for (let i = 0; i < mainNav.children.length; i++) {
  const item = mainNav.children[i]
  if(item.pathname === route ){
    item.classList.add("active");
  }
}

// auth Dropdown Toggle
const dropdown_panel = document.querySelector(".dropdown_panel")
const authAvatar = document.querySelector(".auth_menu img")

authAvatar.addEventListener("click", (e)=>{
  if(dropdown_panel.classList.contains("show_dropdown_panel")){
    dropdown_panel.classList.add("hide_dropdown_panel")
    dropdown_panel.classList.remove("show_dropdown_panel")
    backdrop.classList.add("hide_backdrop")
    backdrop.classList.remove("show_backdrop")
    container.classList.remove("bg_blur")
  }else{
    dropdown_panel.classList.remove("hide_dropdown_panel")
    dropdown_panel.classList.add("show_dropdown_panel")
    container.classList.add("bg_blur")
    backdrop.classList.add("show_backdrop")
    backdrop.classList.remove("hide_backdrop")
  }
})

if(backdrop){
  
  backdrop.addEventListener("click", function(e){
    dropdown_panel.classList.add("hide_dropdown_panel")
    dropdown_panel.classList.remove("show_dropdown_panel")
    backdrop.classList.add("hide_backdrop")
    backdrop.classList.remove("show_backdrop")
    container.classList.remove("bg_blur")
  })
}


