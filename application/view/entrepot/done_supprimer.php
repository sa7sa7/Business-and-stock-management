<div class="cd-popup is-visible" role="alert" id="cache">
	<div class="cd-popup-container">
		<p>Cet Entrepot a été supprimé.</p>
		<ul class="cd-buttons">
			<li><a href="#" onclick="validation()">Valider</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<script language="javascript">
function validation() 
{
    document.getElementById("cache").className = "cd-popup";
}
</script>