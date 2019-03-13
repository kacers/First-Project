<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
    </title>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="formule.css">
    
</head>
<body>

      <?php
      session_start();
  if(isset($_POST['inscrire'])){
    $pseudo=htmlspecialchars(trim($_POST['pseudo']));
    $nom=htmlspecialchars(trim($_POST['nom']));
    $prenom=htmlspecialchars(trim($_POST['prenom']));
    $adresse=htmlspecialchars(trim($_POST['adresse']));
    $matiere=htmlspecialchars(trim($_POST['matiere']));
    $niveau=htmlspecialchars(trim($_POST['niveau']));
    $description=htmlspecialchars(trim($_POST['description']));
    $tel=htmlspecialchars(trim($_POST['tel']));
    $email=htmlspecialchars(trim($_POST['email']));
    $mdp=htmlspecialchars(trim($_POST['mdp']));
    $rmdp=htmlspecialchars(trim($_POST['rmdp']));  
    $image=($_POST['image']);

    if($pseudo &&$nom &&$prenom &&$adresse &&$matiere &&$niveau &&$email &&$tel &&$description &&$mdp &&$rmdp){
      if($mdp==$rmdp){
        $mdp=md5($mdp);
        try{
          $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
          $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
            $test=$bdd->prepare(" SELECT * FROM prof WHERE Pseudo='$pseudo' ");
            $test->execute();
            $num=$test->rowCount();
             if($num==0){
          
               $connexion=$bdd->prepare("INSERT INTO prof (Pseudo,Nom,Prenom,Matiere,Adresse,Niveau,Email,Tel,Description,Mdp) VALUES ('$pseudo','$nom','$prenom','$matiere','$adresse','$niveau','$email','$tel','$description','$mdp')");

                 $connexion->execute();
                 header("location:membre.php");
               // echo ('Inscription Avec succee');
              }   
             else{
              echo "Nom D/'utilisateur deja existant";
                }
              }
        catch(PDOException $e){
          echo "erreur ".$e->getMessage();
        }
      }
        else{
          echo "Mot De Passe Incorrect";
        }
      }  
     else{
      echo "Veuiller Remplire Tous Les Champs!!";
        }
  }

 ?>
  <div class=p>
       
           <div class=a1><a href="Acceuil.php"><h1><em>my</em>prof</h1> </a> </div>
       <div class=b>
           <div class=b1><h2>inscription</h2></div>
           <div class=b2><form action="Inscription.php" method="POST">
               <input type="text" placeholder="Pseudo" name="pseudo">
               <input type="text" placeholder="Nom" name="nom">
               <input type="text" placeholder="Prènom" name="prenom">
               <input type="text" placeholder="matière" name="matiere">
               <input type="text" placeholder="Adresse" name="adresse">
               <input type="text" placeholder="niveau" name="niveau">
               <input type="email" placeholder="Email" name="email">
               <input type="tel" placeholder="Télèphone" name="tel">
               <input type="text" placeholder="Description" name="description"  style="
                 padding-bottom: 78.4px;">
               <input type="password" placeholder="Mot de passe" name="mdp">
               <input type="password" placeholder="Confirmer Mot de passe" name="rmdp">
               <input type="file" name="image">
                   <button type="submit" values="S'inscrire" name="inscrire">S'inscrire</button>
                   <a href="connecter.php">Deja inscrit</a>
           </form></div>
       </div>
   </div>
 
    
</body>
</html>