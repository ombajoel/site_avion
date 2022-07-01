<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="assets/dist/css/formcss.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body> <?php include('config/error.php')?>  
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        
        <div class="signup">
            
            <form method="post">
                <label for="chk" aria-hidden="true">Creer un compte</label>
                <input type="text" name="nom" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="password" name="confirmation" placeholder="Password" required="">
                <button name="newCompte">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="post">
                <label for="chk" aria-hidden="true">se connecter</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button name="connexion">Login</button>
            </form>
        </div>
    </div>
</body>

</html>