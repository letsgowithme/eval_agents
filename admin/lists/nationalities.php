<?php 
require_once "includes/DB.php";
// $nationality_id = strip_tags($_GET($nationality["id"]));
//afficher les nationalités
$sql = "SELECT * FROM  nationality";

$requete = $dbConnect->query($sql);
$requete->execute();
$nationalities = $requete->fetchALL(PDO::FETCH_ASSOC);


?>
<select name="nationality" id="nationality">
<?php foreach($nationalities as $nationality): ?>
    <option value="<?= $nationality["id"] ?>" name="<?= $nationality["id"] ?>"><?= strip_tags($nationality['title']) ?></option>
<?php endforeach; ?>
</select>
