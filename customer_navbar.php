<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link

      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"

      rel="stylesheet"

    />



    <title>Navbar</title>
    <style>
        * {
  margin: 0px;

  padding: 0px;

  box-sizing: border-box;
}

.body-text {
  display: flex;

  font-family: "Montserrat", sans-serif;

  align-items: center;

  justify-content: center;

  margin-top: 250px;
}

nav {
  display: flex;

  justify-content: space-around;

  align-items: center;

  min-height: 8vh;

  background-color: teal;

  font-family: "Montserrat", sans-serif;
}

.heading {
  color: white;

  text-transform: uppercase;

  letter-spacing: 5px;

  font-size: 20px;
}

.nav-links {
  display: flex;

  justify-content: space-around;

  width: 30%;
}

.nav-links li {
  list-style: none;
}

.nav-links a {
  color: white;

  text-decoration: none;

  letter-spacing: 3px;

  font-weight: bold;

  font-size: 14px;

  padding: 14px 16px;
}

.nav-links a:hover:not(.active) {
  background-color: lightseagreen;
}

.nav-links li a.active {
  background-color: #4caf50;
}

/* Hero image */
div.hero {
  min-height: 90vh;
  text-align: center;
  padding-top: 250px;
}
.cl-white {
  color: rgb(230, 225, 225);
}
.align-center {
  text-align: center;
  align-items: center;
}
.padding-top-10 {
  padding-top: 10px;
}
.padding-bottom-10 {
  padding-bottom: 10px;
}

.padding-left-20 {
  padding-left: 20px;
}

    </style>

  </head>

  <body>

    <nav>

      <div class="heading">

        

      </div>
  SPORTYZONE
      <ul class="nav-links"> 


        <li><a class="active" href="index.php">Home</a></li>

         <li><a href="login.php">Login</a></li>

          <li><a href="register.php">Signup</a></li>

        <li><a href="aboutsport.php">About Us</a></li>


      </ul>

    </nav>



</html>