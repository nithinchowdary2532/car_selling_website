<?php


if (!isset($_SESSION['user_id'])) {
  // The user is not logged in, so show the pending registration modal.

  // Include the database connection file.
  include 'connect.php';

  // Get the user's email address.
  $email = $_POST['email'];

  // Check if the user's email address exists in the database.
  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
  $select_user->execute([$email]);
  $user_exists = $select_user->rowCount() > 0;

  // If the user's email address exists and their registration status is pending, show the modal.
  if ($user_exists && $select_user->fetch(PDO::FETCH_ASSOC)['registration_status'] === 'pending') {

    // Set the modal content.
    $modal_content = '
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pending Registration</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Your registration is pending. Please click the link below to verify your email address and activate your account.</p>
            <a href="[verification email link]">[Verification email link]</a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    ';

    // Display the modal.
    echo $modal_content;
  }
}
