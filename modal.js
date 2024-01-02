// Modal script
function openModal(errorMsg) {
  document.getElementById('errorText').innerHTML = errorMsg;
  document.getElementById('errorModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('errorModal').style.display = 'none';
}
