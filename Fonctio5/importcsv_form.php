<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Importe un fichier</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
    </head>
    <body>

        
        <h1 style="color:red"><e>Cette page a été concu spécialement pour que vous puissiez déposer des cursus ou des règlements au format CSV</e></h1>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/><br/>
<br/>

        <div class='container'>
           
            <div class='row'>
                <div class ="col-xs-12">
                <div class="col-xs-5"> 
            <h2>Choisis le  cursus a importer</h2>
            <form method="post" enctype="multipart/form-data" action="importCursusCsv.php">
                <input name ="userfile" type="file" value="table" />
                <br/>
                <input class="btn btn-primary" name="submit" type="submit" value="Importer"/><br>
            </form>
                </div>
                <div class="col-xs-5 ">
       

        
            <h2>Choisis le règlement que tu veux importer</h2>
            <form method="post" enctype="multipart/form-data" action="../Fonctio3/importReglementCsv.php">
                <input name ="userfile" type="file" value="table" />
                <br/>
                <input class="btn btn-primary" name="submit" type="submit" value="Importer"/>
            </form>
                    </div>
        </div>
 </div>
        <div>
            
           
            
        </div>
    </body>

</html>
