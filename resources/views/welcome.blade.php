<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Nexroar Data App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
      font-family: Arial, sans-serif;
      overflow: hidden;
    }
    h1 {
      font-size: 3em;
      margin-bottom: 20px;
      text-align: center;
    }
    .buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 80%;
      max-width: 300px;
    }
    .buttons a {
      padding: 10px 20px;
      text-decoration: none;
      color: white;
      background-color: #007bff;
      border-radius: 5px;
      text-align: center;
      transition: background-color 0.3s;
    }
    .buttons a:hover {
      background-color: #0056b3;
    }
    @keyframes backgroundAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    body {
      background-size: 200% 200%;
      animation: backgroundAnimation 10s ease infinite;
    }
  </style>
</head>
<body>
  <h1 class="animate__animated animate__fadeIn">Welcome to Nexroar Data App</h1>
  <div class="buttons">
    <a href="{{ route('recruiter.login') }}">Recruiter Login</a>
    <a href="{{ route('bdm.login') }}">BDM Login</a>
    <a href="{{ route('admin.login') }}">Admin Login</a>
  </div>
</body>
</html>