<footer class="text-muted py-5">
  
  <div class="d-flex justify-content-center">
    <?php
    if($cookie=false){
  ?>
    <section class="cookie">
   <div class="txt">
      <p class="">
        Nous utilisons des cookies<br>
         vous acceptez <a href="#" target="_blanck">Politique des cookies.</a>
      </p>
   </div>
   <div>
      <a class="btn accept" name="accepter" onclick="/traitement/sauvegarderCookie.php">Accept</a>
   </div>
</section>
<?php
}
?>
    <p class="float-end mb-1">
      <a href="index.php">Retour en haut de la page</a>
      <br>
      &copy; Azur est une création de Raphaël TISBA & Théodore CAVAILLE COLL
    </p>
    
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
// Permet d'afficher le nom du fichier uploadé
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>
