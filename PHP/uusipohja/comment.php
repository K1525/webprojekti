<!DOCTYPE html>
<html>
   
<head>
   <title>Kommentointi</title>
   <meta charset="utf-8" />
   
   <link rel="stylesheet" href="css/com.css" type="text/css" />
</head>
   
<body>
   <?php
   include('post-comment.php');
   ?>
   
   <div id="respond">      <h3>Jätä arviosti!</h3>      <form action="post-comment.php" method="post" id="commentform">        <label for="comment_author" class="required">Nimi:</label>
       <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">        <label for="email" class="required">Sähköposti:</label>
       <input type="email" name="email" id="email" value="" tabindex="2" required="required">        <label for="comment" class="required">Arviosi:</label>
       <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>        <!-- comment_post_ID value hard-coded as 1 -->
       <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" />
       <input name="submit" type="submit" value="Lähetä" />        </form>    </div>
   
</body>
   
</html>