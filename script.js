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
function toggleEditForm(contactId) {
    var formId = "editForm" + contactId;
    var form = document.getElementById(formId);
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Function to bind delete event to dynamically added delete buttons
function bindDeleteEvent() {
    $('.delete-contact-person').click(function() {
        var contactPersonId = $(this).data('contact-person-id');
        deleteContactPerson(contactPersonId);
    });
}

// Function to handle deletion of contact persons
function deleteContactPerson(contactPersonId) {
    if (confirm('Are you sure you want to delete this contact person?')) {
        $.ajax({
            url: 'remove_contact_person.php',
            type: 'POST',
            data: { contact_person_id: contactPersonId },
            success: function(response) {
                if (response.trim() === 'success') {
                    // Refresh contact person list
                    showContactPersons();
                } else {
                    alert('Error deleting contact person');
                }
            },
            error: function() {
                alert('Error deleting contact person');
            }
        });
    }
}
