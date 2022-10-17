function lockBaseWord(){
    if(document.getElementById("base").textContent.length() > 0){
        document.getElementById("locker").style.visibility = "hidden";
        document.getElementById("guess").style.visibility = "visible";
        document.getElementById("try").style.visibility = "visible";
    }
}
