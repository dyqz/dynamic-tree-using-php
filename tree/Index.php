<!DOCTYPE html>
<html>
  <head>
    <title class="Title">Dynamic Tree Menu</title>
    <link rel="stylesheet" href="tree.css"/>
  </head>
  <body>
    <ul class="tree">
        
      
      

<?php
//Connecting to a database
 $conn = mysqli_connect('localhost', 'root', '', 'develop_db');
 
 
 $result2= mysqli_query($conn, 'select * from tree_entry');
 

 echo "<b class='Title'> <center>Database Output</center> </b> <br> <br>";
 
 if ($result2) {
 
     while ($row = $result2->fetch_assoc()) {
         $field1name = $row["entry_id"];
         $field2name = $row["parent_entry_id"];
             
                //Checking if its parent or child
                 if( $field2name==0){
                     

                    //Fetching Parent name

                    $result= mysqli_query($conn, 'select * from tree_entry_lang');
                    while($parent= $result->fetch_assoc()){
                     if($parent['entry_id']==$field1name && $parent['lang']== "ger"){
                         echo '<ul class="tree">
        
      
      
                         <li class="section">
                           <input type="checkbox" id="'.$parent['name'].'"/>
                           <label for="'.$parent['name'].'">'. $parent['name']. '</label>
                           <ul>';
                     }
                    }
                   
                        //child                   
                    $result3= mysqli_query($conn, 'SELECT * FROM tree_entry');
                    while ($new_row = $result3->fetch_assoc()) {
                                              
        
                        if($field1name == $new_row['parent_entry_id'])
                        {
                            

                            //Fetching Child Name
        
                            $result= mysqli_query($conn, 'select * from tree_entry_lang');
                            while($child= $result->fetch_assoc()){
                             if($child['entry_id']==$new_row['entry_id']){
                                 
                                echo '<li class="section">
                                <input type="checkbox" id="'.$child['name'].' "/>
                                <label for="'.$child['name'].' ">'.  $child['name']. '</label>';
                            



                            //Super Child
                                        $result4= mysqli_query($conn, 'SELECT * FROM tree_entry');
                                        while ($child_row = $result4->fetch_assoc()) 
                                    {
                                                            
                                        if($new_row['entry_id'] == $child_row['parent_entry_id'])
                                        {
                                            $result= mysqli_query($conn, 'select * from tree_entry_lang');
                                            while($sup_child= $result->fetch_assoc()){
                                             if($sup_child['entry_id']==$child_row['entry_id']){
                                                echo '<ul>
                                                <li>'. $sup_child['name'].'</li>
                                                </ul>';
                                             }
                                            }
                                            
                                        }
                                        
                                    }
                                }
                                    }

                        }
                  echo       "</li>";
                      
                    }
         
        echo '</ul></ul>';
         
        
     }
     
    }
 
 }
 
?>

</body>
<script src="app.js"></script>
</html>