<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <style>
        /* Basic styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        .header {
            background-color: rgba(255, 165, 0, 0.5);
            /* Light orange with 50% opacity */
            padding: 10px 20px;
            height: 3em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* position: fixed; */
            width: 100%;
            top: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            /* Center the image vertically */
        }

        .logo-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
           
        }

        /* Right section: navigation links */
        .header .nav-links {
            display: flex;
            gap: 15px;
        }

        .header .nav-links a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .header .nav-links a:hover {
            background-color: rgba(255, 165, 0, 0.3);
            /* Light orange hover effect */
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="images/cat1.jpg" alt="Logo" class="logo-image">
        </div>
        <div class="nav-links">
            <a href="#login">Login</a>
            <a href="#signup">Signup</a>
            <a href="#profile">Profile</a>
        </div>
    </header>


</body>

</html>
