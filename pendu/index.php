<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendu</title>
    <link rel="stylesheet" href="lependu.css">
</head>
<body>
    <?php
    include('header.php');
    ?>
    <main>  
        <div class="all">

            <?php 
            session_start();
            $fichier = file("mots.txt");
            $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            require('./Pendu.php');
            $pendu = new Pendu;
            $pendu->choiceword($fichier);
            $prevmot = strtoupper($_SESSION['mot']);
            $mot = $pendu->noaccent($prevmot);
            
            $_SESSION['false'] = 0; 
            $_SESSION['true'] = 0;

            if(!isset($_SESSION['victoires'])){
                $_SESSION['victoires'] = 0;
            }

            if(!empty($_GET) && $_GET['etat']=='jouer')
            {    
                if (isset($_POST["lettre"])) {
                $pendu->lettrestock();
                }
                
                if(!empty($_SESSION['played'])){
                    $pendu->wrongl($mot);
                }
                echo "<div class='glob'>";
                    echo '<form class="form" method="post">';
                        $pendu->bouttonaff($alphabet);
                    echo '</form>';
                    echo "<div class='droite'>";
                        echo "<div class='tirets'>";
                            $pendu->affword($mot);
                        echo "</div>";
                        echo "<div class='dessin'>";
                            $false = $_SESSION['false']; 
                            if($false !=0){
                                echo "<img src='./assets/Le-Pendu ($false).png'>";
                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                if($_SESSION['true']== strlen($mot)){
                    header("location:./index.php?etat=gagne");
                }
                if($_SESSION['false'] >= 8 ){
                    header("location:./index.php?etat=perdu");
                }
                
                echo "<p class='victoires'> nombre de victoires : $_SESSION[victoires]</p>";
                echo "<a class='recommencer' href='./Recommencer.php'>Nouveau Mot</a>";
            }
            elseif(!empty($_GET) && $_GET['etat']=='perdu'){
                $pendu->loseparty($mot);
            }

            elseif(!empty($_GET) && $_GET['etat']=='gagne'){
                $pendu->winparty($mot);
            }

            else{
                $pendu->index();
            }
            ?>
        </div>
    </main>
</body>
</html>





















































<?php
// $difference = array_diff($played, str_split($mot)); 
        // var_dump($difference);
     // if (isset($_POST["lettre"])) {
    //             $pletter = $_POST["lettre"];
    //             $_SESSION['played'][]=$pletter;
    //         }
    
    // // for($i=0; isset($alphabet[$i]); $i++ ) 
    // // {
    
        
    // // }  
    
    
    // for($j=0; isset($alphabet[$j]); $j++)
    // {
        
    //         for($l=0; isset($_SESSION['played'][$l]); $l++)
    //         {
    //             // echo "$_SESSION[played][$l]";
    //             if($alphabet[$j]== $_SESSION['played'][$l])
    //             {
    //                 echo "<p></p>";
    //             }
    //             else {
    //                  echo '<input type="submit" name="'."lettre".'" value="'.$alphabet[$j].'">';
    //             }
                   
                
    //         }
        
           
        
        
    // }   
    // var_dump($_SESSION);    
        
    //     // for($j=0; isset($result[$j]); $j++){
    //     //     if($alphabet[$i] == $result[$j]){
    //     //         echo "";
    //     //     }
    //     // }
    
     
    // // var_dump($result);

