<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Futuristic Crypto Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: min-content;
      background-color: #010d15;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden;
    }

    /* Root Variables */
    :root {
      --primary-dark: #010d15;
      --primary-accent: #09c561;
      --background: #0a0f1a;
      --text-light: #ffffff;
      --text-secondary: #b0b0b0;
      --border-color: rgba(46, 46, 46, 0.6);
      --glass-bg: rgba(255, 255, 255, 0.1);
      --button-glow: rgba(9, 197, 97, 0.7);
      --grid-color: rgba(255, 255, 255, 0.05);
      --animation-glow: 0 0 8px rgba(9, 197, 97, 0.5), 0 0 15px rgba(9, 197, 97, 0.3), 0 0 30px rgba(9, 197, 97, 0.2);
    }

    /* Container */
    .container {
      text-align: center;
      width: 96%;
      height: 90vh;
      padding: 5px;
      backdrop-filter: blur(10px);
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    /* Navigation List */
    .nav-list {
      display: flex;
      justify-content: center;
      gap: 15px;
      list-style: none;
      padding: 0;
    }

    .nav-list li {
      padding: 12px 25px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
      font-weight: bold;
      color: var(--text-light);
      background: linear-gradient(145deg, #010d15, #0c1017);
      transition: background-color 0.3s, box-shadow 0.3s;
    }

    .nav-list li:hover {
      background: var(--primary-accent);
      color: var(--background);
      box-shadow: 0 0 10px var(--primary-accent), 0 0 20px var(--primary-accent);
    }

    .nav-list li.active {
      background: var(--primary-accent);
      color: var(--background);
      box-shadow: 0 0 15px var(--primary-accent), 0 0 30px var(--primary-accent);
      border: 1px solid var(--primary-accent);
    }

    /* Iframe Styling */
    iframe {
      width: 100%;
      height: 100%;
      border: none;
      border-radius: 12px;
      background: var(--glass-bg);
      border: 1px solid var(--border-color);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
    }
    
    iframe:hover {
      transform: scale(1.02);
      box-shadow: 0 0 20px rgba(9, 197, 97, 0.8), 0 0 40px rgba(9, 197, 97, 0.5);
    }
  </style>
</head>
<body>
  <div class="container">
    <ul class="nav-list">
      <li onclick="selectPage(this, 'student_profile_page.php')">Profile</li>
      <li onclick="selectPage(this, 'student_profile_update.php')">Profile Update</li>
      <li onclick="selectPage(this, 'student_password_change.php')">Change Password</li>
      <li onclick="selectPage(this, 'change-moods.html')">Change Moods</li>
    </ul>
    <iframe id="contentFrame" src=""></iframe>
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
