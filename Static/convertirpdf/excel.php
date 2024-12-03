   <?php include "../connect/db.php";?>   
     
    <?php
          header('Content-Type: application/vnd.ms-excel');
          header('Content-Disposition: attachment; filename="test.xls"');
    ?>

     <h1>CONSULTAR PUNTAJES</h1>
     <DIV>
      <TABLE>
       <THEAD>
           <TR>
             <TH>Id</TH>
             <TH>Puntaje Jugador</TH>
             <th>Puntaje IA</th>
             <th>Fecha y Hora</th>
           </TR>
       </THEAD> 
        <?php 
             $consulta="SELECT *FROM puntajes;";
             $resul=mysqli_query($conn,$consulta);
               while($row=mysqli_fetch_array($resul)){ ?>
                    <tr>
                       <TD> <?php echo $row['id']; ?> </TD>
                       <TD> <?php echo $row['jugador_puntos']; ?></TD>
                       <TD><?php echo $row['ia_puntos']; ?></TD>
                       <TD><?php echo $row['fecha_hora']; ?></TD>
                    </tr>
            <?php  }   ?>
       </TABLE>        
   </DIV>
