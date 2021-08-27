<?php
  // Initialize sessions

  // Start a new session
  session_set_cookie_params(15000,"/",".mattdev.fr",FALSE);
  // démarre une session
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home/");
    exit;
  }

  // Include config file
  require_once "config/config.php";

  // Define variables and initialize with empty values
  $username = $password = '';
  $username_err = $password_err = '';

  // Process submitted form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if username is empty
    if(empty(trim($_POST['username']))){
      $username_err = 'Merci d\'indiquer votre nom d\'utilisateur.';
    } else{
      $username = trim($_POST['username']);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
      $password_err = 'Merci d\'indiquer votre mot de passe.';
    } else{
      $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
      // Prepare a select statement
      $sql = 'SELECT id, username, password FROM users WHERE username = ?';

      if ($stmt = $mysql_db->prepare($sql)) {

        // Set parmater
        $param_username = $username;

        // Bind param to statement
        $stmt->bind_param('s', $param_username);

        // Attempt to execute
        if ($stmt->execute()) {

          // Store result
          $stmt->store_result();

          // Check if username exists. Verify user exists then verify
          if ($stmt->num_rows == 1) {
            // Bind result into variables
            $stmt->bind_result($id, $username, $hashed_password);

            if ($stmt->fetch()) {
              if (password_verify($password, $hashed_password)) {

                // Start a new session
                session_set_cookie_params(3600,"/",".mattdev.fr",FALSE);
                // démarre une session
                session_start();

                // Store data in sessions
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

               

                // Redirect to user to page


               // $redirection = $_SERVER['QUERY_STRING'];
                 // header("Location: redirect.php?area=".$redirection_valuei."", true, 301); 
                 //header("Location: redirect.php?area=dev");
                 //header("Location: redirect.php".'?'.$_SERVER['QUERY_STRING']);
                 header("location: home/");

              } else {
                // Display an error for passord mismatch
                $password_err = 'Mot de passe invalide';
              }
            }
          } else {
            $username_err = "Cet utilisateur n'existe pas";
          }
        } else {
          echo "Une erreur s'est produite. Veuillez réésayer";
        }
        // Close statement
        $stmt->close();
      }

      // Close connection
      $mysql_db->close();
    }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter - Mon compte MattDev</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="stylesheet" href="assets/webfonts/stylesheet.css">

    </head>
    <body>



    <!-- Header -->
    
    <!-- Login script -->
        
    <!-- Login form -->

    <div class="container text-center brand-container">
            <div class="md-logo"><img src="assets/img/logo.png" width="158px"></div>
            <span class="app-badge">AUTHENTIFICATION</span>
         

</div>
            

            <div class="container  login">
              <!-- ALERT -->
              <?php include_once('includes/alert.php') ?>
          

            <div class="login-container">
                <div class="title">Je me connecte aux services MattDev</div>

            

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
               

                                                                                                    
                    <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
                    <label class="label-form" for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
                    <span class="help-block"><b><?php echo $username_err; ?></b></span>
                    </div>

                    <div class="form-group">
                        <label class="label-form" for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
                        <span class="help-block"><b><?php echo $password_err;?></b></span>
                    </div>

                    <button type="submit" name="login" id="sign_in" class="submit-btn">Se connecter</button>
                </form>
                <hr>
                    
                    <p class="text-center text-muted">&copy; 2021 MattDev</p>
            </div>
        </div>
    </div></div></div>



</body></html>


