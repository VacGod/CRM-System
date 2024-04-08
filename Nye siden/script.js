document.addEventListener('DOMContentLoaded', function() {
  const editButtons = document.querySelectorAll('.editBtn');
  editButtons.forEach(button => {
      button.addEventListener('click', function() {
          const modalId = this.getAttribute('data-modal-id');
          const modal = document.getElementById(modalId);
          modal.style.display = 'block';
      });
  });

  const closeButtons = document.querySelectorAll('.close');
  closeButtons.forEach(button => {
      button.addEventListener('click', function() {
          this.parentElement.parentElement.style.display = 'none';
      });
  });

  window.addEventListener('click', function(event) {
      if (event.target.className === 'modal') {
          event.target.style.display = 'none';
      }
  });
});
