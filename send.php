<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = strip_tags(trim($_POST["fullname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($fullname) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir tous les champs et fournir une adresse email valide.";
        exit;
    }

    $recipient = "backbonetech@free.fr"; // Remplace par ton adresse email
    $subject = "Nouveau message de $fullname";
    $email_content = "Nom: $fullname\n";
    $email_content = "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $fullname <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Merci! Votre message a été envoyé.";
    } else {
        http_response_code(500);
        echo "Oups! Quelque chose a mal tourné, nous n'avons pas pu envoyer votre message.";
    }
} else {
    http_response_code(403);
    echo "Il y a eu un problème avec votre envoi, veuillez réessayer.";
}
