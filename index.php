<?php
/* Email input from a live contact form to your desired email address through a SMTP and access to your Gmail account of choice. */
$msg = '';
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');
    require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server so don't use
    $mail->isSMTP();
    // 0 = off // 1 = client messages // 2 = client and server messages
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tsl';
    $mail->SMTPAuth = true;
    // This is the Gmail account that will be used for the tranfer (middle-man)
    $mail->Username = "acjones0391@gmail.com";
    // Password to the Gmail account above. Can use a pass generated for app instead.
    $mail->Password = "dtodlbpbieamlxqu";
    // Set as the same email address you just gave up the password to up above.
    $mail->setFrom('acjones0391@gmail.com', 'RebReal Development');
    // Where do you want the message to be sent?
    $mail->addAddress('anthony@rebrealdevelopment.com', 'Mr. Jones');
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        // Edit the Subject line below, as desired
        $mail->Subject = 'RebReal Development - Contact Form Submission';
        $mail->isHTML(false);
        // If your form has other fields, add them below. ie: Phone: {$_POST['phone']}
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
          // JS popup alert to let user know the message was sent.
          header('Location: thank-you.html');
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script src="/dist/js/index.js"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
    />
    <link rel="stylesheet" href="dist/css/main.css" />
    <link rel="icon" href="dist/img/favicon.ico" type="icon" />
    <title>RebReal Development</title>
  </head>
  <body>
    <script>
      document.body.className += " fade-out";
    </script>
    <header>
      <h2>RebReal Development</h2>
      <h2 class="mobile-head-h2">RebReal Dev</h2>

      <nav>
        <div class="nav-links">
        <li><a class="hvr-underline-from-center" href="#about">About</a></li>
        <li>
          <a class="hvr-underline-from-center" href="#contact">Contact</a>
        </li>
      </div>
      

      <div class="mobile-btn">
        <div class="btn-line"></div>
        <div class="btn-line"></div>
      </div>
    </nav>
    </header>
    <main>
      <section id="hero">
        <img src="./dist/img/rebreal_logo_tm.png" alt="rr-logo" />
        <h3>
          Welcome to RebReal Development<br />Where we specialize in turning
          nothing into something
        </h3>
        <button class="hero-btn hvr-float-shadow" onclick="window.location.href = '#contact';">Rise With Us</button>
      </section>
      <section id="about">
        <h1>test</h1>
      </section>
      <section>
        <div class="about-blocks">
          <div class="about-content">
            <h2>About</h2>
            <div class="hr-bar"></div>
            <p>
              RebReal Development is currently a one-man team and is a one-stop shop for all of your Web needs. We specialize in Website Development/Design, Social Media Management, and Marketing Videography. RebReal is based in the heart of Colorado Springs, CO near the downtown area.
            </p>
          </div>
          <div class="about-img"></div>
        </div>
      </section>
      <section id="services">
        <div class="services-blocks">
          <div class="services-content">
            <h2>Services</h2>
            <div class="hr-bar"></div>
            <p>
              As mentioned above our specialities are Web Developmnet/Design, Social Media Management, and Marketing Videography, but our services also include Website Hosting, Logo/Branding, and Website Management. Looking forward to talking to you soon! 
            </p>
          </div>
          <div class="services-img"></div>
        </div>
      </section>
      <section id="img-block">
        <div class="dark-overlay"></div>
      </section>
      <section class="contact">

      </section>
      <section id="contact">
        <div class="sec-contain">
          <h2>Get In Touch!</h2>
          <div class="hr-bar-center"></div>
           <!-- Add this bit of PHP, just before your '<form' line -->
           <?php if (!empty($msg)) {
                          echo "<h2>$msg</h2>";
                        } ?>
           <form method="post" autocomplete="off">
            <input type="text" name="name" placeholder="Name" />
            <input type="email" name="email" placeholder="Email" />
            <fieldset>
              <legend>Service(s) You Need</legend>
              
                <input
                  type="checkbox"
                  name="web-dev"
                  value="Website Development"
                  id="web-dev"
                />
                <label for="web-dev">Website Developemt</label>
                <input
                  type="checkbox"
                  name="web-mang"
                  value="Website Management"
                  id="web-mang"
                />
                <label for="web-mang">Website Management</label>
                <input
                  type="checkbox"
                  name="web-host"
                  value="Website Hosting"
                  id="web-host"
                />
                <label for="web-host">Website Hosting</label>
                <div class="spacer-2x"></div>
                <input
                  type="checkbox"
                  name="soc-med"
                  value="Social Media Management"
                  id="soc-med"
                />
                <label for="soc-med">Social Media Management</label>
                <input
                  type="checkbox"
                  name="logo-design"
                  value="Logo/Branding Design"
                  id="logo-design"
                />
                <label for="logo-design">Logo/Branding Design</label>
                <input
                  type="checkbox"
                  name="vid"
                  value="Videography"
                  id="vid"
                />
                <label for="vid">Videography</label>
              
              
            </fieldset>
            <textarea
              name=""
              id=""
              cols="30"
              placeholder="Enter Your Comment"
            ></textarea>
            <button><i class="fa fa-paper-plane"></i> Submit</button>
          </form>
        </div>
        </div>
      </section>
    </main>
    <footer>
      <div class="social">
        <a href="https://www.facebook.com/rebrealdev/" class="soc-icons"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/rebrealdev" class="soc-icons"><i class="fab fa-twitter"></i></a>
        <a href="mailto:anthony@rebrealdevelopment.com" class="soc-icons"><i class="fa fa-envelope"></i></a>
        
        <a href="https://www.instagram.com/rebrealdev/" class="soc-icons"><i class="fab fa-instagram"></i></a>
        <a href="https://www.pinterest.com/rebrealdevelopment/" class="soc-icons"><i class="fab fa-pinterest"></i></a>
      </div>
      Copyright &copy; 2019 | Developed by RebReal
    </footer>
  <script src="/dist/js/index.js"></script> 
  <script src="/dist/js/app.js"></script>
  </body>
</html>
