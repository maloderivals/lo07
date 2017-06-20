<?php


?>
<html>
    <head>
        <title>Page d'authentification</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            
        <h1>Veuillez vous authentifier</h1>
        <br/>
        <br/>
        <br/>
        <br/>
        
        <div><form action="../index.php" method="POST">
                <fieldset >
                    <legend >Rentrez votre numéro étudiant</legend>
                    <div class="row" >
                        <div class="col-lg-2">
                            <input type="text" name="id" value="" />
                        </div>
                    </div>
                    <br/>
        <br/>
                    <div class ="row">
                         <div class="col-lg-2">
                        <input class="btn btn-primary"  name='choix' type="submit" value="authentification">
                        </div>
                        <div class="col-lg-2">
                        <input class="btn btn-primary"  type="reset" value="Reset">
                        </div>
                    </div>
                    </div>
                    
                </fieldset>
            </form></div>
        </div>
    </body>
</html>