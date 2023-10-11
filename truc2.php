<div class="webform-component">
<div class="form-item">
<label>Préférences musicales :</label>
<select name="gouts[]" multiple size="10">
<?php
$query4 = mysql_query('SELECT idmenus,v_parent,m_nom,m_link FROM
v5_menus child
ORDER BY
case
when v_parent = 0
then m_nom
else    (
select  m_nom
from    v5_menus parent
where   parent.idmenus = child.v_parent
)
end
,       case when v_parent = 0 then 1 end desc
,       m_nom');
$isFirst = true;
while($row = mysql_fetch_assoc($query4)) {
if($row['v_parent'] == 0) {
//if(!$isFirst)
//echo '</option>';
if($row['m_link'] == '#') {
echo '<option disabled="disabled">-'. $row['m_nom'] .'</option>';
}else{
echo '<option value="'.$row['idmenus'].'">-'. $row['m_nom'] .'</option>';
}
//afficher le optgroup
}else{
echo '<option value="'.$row['idmenus'].'">--'. $row['m_nom'] .'</option>';
//afficher l'option
}
$isFirst = false;
}
?>
</select>
<?php
if(isset($_POST["id"]) && $_POST["id"] == "insertmodif"){
$p_gout = $_POST['gouts'];
foreach($p_gout as $selectValue){
$truc2 = "INSERT INTO `v5_users_gouts`
SET id_gout=\"". $selectValue ."\",
cleanpseudo =\"". $cleanps ."\";";
mysql_query($truc2) or die('Erreur SQL !'.$truc2.'<br />'.mysql_error());
}
?>