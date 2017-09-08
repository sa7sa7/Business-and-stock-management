<br><br><br>

<div class="container">

<table class="table">
	<tr>

	<td valign="top" width="25%">
	<dl>


	 <dt><img src="<?php if($user->image != NULL) echo URL_image . $_SESSION['id_user'] . '\\' . $user->image; else echo URL . 'img/cd-avatar.jpeg'; ?>" class="image"></dt>

	 <br> <br>

	</dl>
	</td>
	
	 
	<td>
		<dl> Votre Identifiant:  <?php echo  $user->login ?></dl>
    	<dl> Votre Nom:  <?php echo  $user->nom ?></dl>
    	<dl> Votre Prenom: <?php  echo  $user->prenom ?></dl>
    	<dl> <a href="" onclick="hideThis(this);"  id="aaa"> Changer Votre Mot de Passe</a></dl>
    </td>
</div>

<script language="javascript">
function hideThis(div)
{
	alert(div);
if(document.getElementById(div).style.visibility=="hidden")
    {
        document.getElementById(div).style.visibility="visible";
    }
    else
    {
        document.getElementById(div).style.visibility="hidden";
    }
}
</script>