function showAddToCartForm(pid) {
  var popup = document.getElementById("popup-" + pid);
  popup.style.display = "block";
}

function hideAddToCartForm(pid) {
  var popup = document.getElementById("popup-" + pid);
  popup.style.display = "none";
}