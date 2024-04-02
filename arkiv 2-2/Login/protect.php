<?php
session_start(); // Starter en ny sesjon eller fortsetter den eksisterende.

// Sjekker om det er sendt en logout-anmodning via POST.
if (isset($_POST["logout"])) {
    session_destroy(); // Ødelegger sesjonen.
    unset($_SESSION);  // Fjerner alle session variabler.
}

// Sjekker om en bruker er logget inn ved å se etter 'user' i sesjonen.
if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // Omdirigerer brukeren til innloggingssiden hvis de ikke er logget inn.
    exit(); // Avslutter skriptet for å sikre at ingen ytterligere kode kjøres.
}
?>
