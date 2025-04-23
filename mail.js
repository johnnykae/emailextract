  //select file wrapper click
  document.querySelector(".wrap").onclick = ()=>{
    document.querySelector("#file").click();
  }
  // change background
  document.querySelector("#mode").onclick = ()=>{
    if(document.querySelector("#mode").classList.contains("bx-moon")){
      document.querySelector("meta[name='color-scheme']").content = "dark";
      document.querySelector("#mode").classList.add("bx-sun");
      document.querySelector("#mode").classList.remove("bx-moon");
      
    }
    else{
      document.querySelector("meta[name='color-scheme']").content = "light";
      document.querySelector("#mode").classList.add("bx-moon");
      document.querySelector("#mode").classList.remove("bx-sun");
      
    }
  }

  function copyToClipboard() {
    alert("copied");
    document.querySelector(".chunk").style.border = "2px solid deepskyblue";
    const textToCopy = document.querySelector(".chunk");

    // Copy to clipboard
    textToCopy.select();
    document.execCommand("copy");
  }

  
//extract button onclick
document.getElementById('extract').onclick = (e)=>{
  alert("hey");
  e.preventDefault();
  document.getElementById('wrapChunk').style.display= 'flex';
  
}