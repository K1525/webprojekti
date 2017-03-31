<head>
        <meta charset="utf-8">
        
</head>
<?php 
        require_once("db-init.php");
        $sql = "select ProductId, Name, Price, Description_more, gender, File_name
                from product join product_image
                on product_ProductId = ProductId
                WHERE ProductId LIKE {$_GET['id']}";
        $stmt = $db->query("$sql"); 
 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo    "<div class='isoproduct'>
                    <img src='kuvat/{$row['File_name']}.png' class='tuotekuvapop'/>
                        <div class='nimipop'>{$row['Name']} </div>
                        <div class='hintapop'>{$row['Price']} </div>
                        <div class='kuvauspop'>{$row['Description_more']}</div>
                 
                </div>";  
    } 
echo '<div id="commentlist">';

include('post-comment.php');
echo '</div>';
?>

<body>
   
   <div id="commentform"> 
       
       <h3>Jätä arviosi</h3>      
       
       <form action="post-comment.php" method="post" id="commentform">        
                  
           
            <div id=arvioarea>
                <label for="comment" class="required">Arviosi:</label>
                <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
           </div>       
            <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" />
            <input name="submit" type="button" value="Lähetä" id="commentbutton"/>        
       
       </form>    
    
    </div>
   
</body>