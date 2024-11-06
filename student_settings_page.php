<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="Resources/student_settings_page.css?v=<?php echo time(); ?>">
  <title>Futuristic Crypto Dashboard</title>
  
</head>
<body>
  <div class="container">
    <ul class="nav-list">
      <li onclick="selectPage(this, 'student_profile_page.php')">Profile</li>
      <li onclick="selectPage(this, 'student_profile_update.php')">Profile Update</li>
      <li onclick="selectPage(this, 'student_password_change.php')">Change Password</li>
    </ul>
    <iframe id="contentFrame" src="student_profile_page.php"></iframe>
  </div>

  <script>
    function selectPage(element, page) {
      // Remove 'active' class from all items
      document.querySelectorAll('.nav-list li').forEach(li => li.classList.remove('active'));
      
      // Add 'active' class to the selected item
      element.classList.add('active');

      // Load the page into the iframe
      document.getElementById('contentFrame').src = page;
    }
  </script>
</body>
</html>
