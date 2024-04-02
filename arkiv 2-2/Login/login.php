
<!DOCTYPE html> 
<html lang="nb"> 

<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width='device-width', initial-scale=1.0"> 
    <title>Login</title>'
    <link rel="stylesheet" href="login.css">
    
</head>

<body>
    <main>
        <?php
        require "check.php"; // Inkluderer 'check.php' som antagelig inneholder logikk for brukerautentisering

        // Sjekker om det har oppstått en feil under innlogging, vist ved $failed-variabelen
        if (isset($failed)) { ?>
            <div id="login-bad">Feil Brukernavn eller passord.</div> <!-- Viser en feilmelding hvis innloggingen feiler -->
        <?php } ?>
            
        <!-- Oppretter et innloggingsskjema -->
        <form id="login-form" method="post" target="_self">
            <h1>Login</h1> <!-- Overskrift for skjemaet -->
            <label for="user">Brukernavn</label> <!-- Etikett for brukernavnfeltet -->
            <input type="text" name="user" required> <!-- Inputfelt for brukernavn, merket som obligatorisk -->
            <label for="passord">Passord</label> <!-- Etikett for passordfeltet -->
            <input type="passord" name="passord" required> <!-- Inputfelt for passord, bør være type="password" for å skjule passordet, og er også obligatorisk -->
            <input type="submit" value="Sign In"> <!-- Knapp for å sende skjemaet -->
        </form>
    </main>
</body>
</html>