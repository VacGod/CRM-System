<?php
// Starter en ny sesjon eller fortsetter den eksisterende.
session_start();

// Sjekker om brukernavn er sendt og at en sesjon ikke allerede er etablert.
if (isset($_POST["user"]) && !isset($_SESSION["user"])) {
    
    // Definerer en assosiativ array av brukernavn og passord.
    $users = [
        "Admin" => "Test123",
        
    ];

    // Sjekker om brukernavnet eksisterer i arrayen, og om passordet er korrekt.
    if (isset($users[$_POST["user"]]) && $users[$_POST["user"]] == $_POST["passord"]) {
        // Oppretter en brukersesjon hvis legitimasjonen er korrekt.
        $_SESSION["user"] = $_POST["user"];
    }
    
    // Setter en feilvariabel hvis innloggingen mislykkes.
    if (!isset($_SESSION["user"])) { 
        $failed = true; 
    }
}

// Omdirigerer til hjemmesiden hvis brukeren er autentisert.
if (isset($_SESSION["user"])) {
    header("Location: hjem.php");
    exit();
}
?>
