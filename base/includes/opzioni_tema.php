<?php
	// Carica la pagina delle opzioni
	add_action('admin_menu', 'creazione_menu');
?>

<?php		
	// Crea la pagina delle opzioni
	function creazione_menu() {
		add_submenu_page('themes.php', 'Opzioni per il tema', 'Opzioni', 'administrator', __FILE__, 'opzioni_tema');
		add_action('admin_init', 'registra_opzioni');
    }
?>

<?php
	//Inizializzazioni opzioni
	function registra_opzioni() {
		register_setting('gruppo-opzioni', 'numero-colonne' );
		register_setting('gruppo-opzioni', 'width-colonne' );
	}
?>

<?php
	//Pagina delle opzioni
	function opzioni_tema() {
?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_options.css">
		
		<script type="text/javascript">
			
			var widthCols = "<?php echo get_option('width-colonne') ?>";
						
			jQuery(document).ready(function($) {
				$(document).ready(					
					function () {								
						if(widthCols!=""){							
							creaWidthCol(widthCols);
						}else{							
							creaWidthColDefault($( ".numero-colonne option:selected").val());
						}
					}			
				)
				
				$('.submit').click(function(){
					var widthColonne = "";
					var totalPercent = 0;
					var onlyNumber = true;
					$(".width-colonne-false").each(function() {							
						if(!$(this).val().replace(/[^0-9\.]/g,"")){
							alert('Sono accettati solo valori numerici per la larghezza delle colonne');
							onlyNumber = false;							
						}else{
							totalPercent = totalPercent + parseInt($(this).val());
							widthColonne += $(this).val() + ",";
						}
					});						
					if(!onlyNumber){						
						return false;
					}						
					if(totalPercent>100){
						alert('La somma delle percentuali delle collonne deve essere uguale o inferiore a 100');
						return false;
					}
					$(".width-colonne").val(widthColonne.substr(0, (widthColonne.length-1)));						
				});
				
				$('.numero-colonne').change(function(){					
					creaWidthColDefault($( ".numero-colonne option:selected").val());
				});
				
				function creaWidthColDefault(numCol){
					$(".widthColTable").empty();
					
					var percent = 100/numCol;
					percent = parseInt(percent);
					
					var html;
					for(var i=0;i<numCol;i++){
						html += 	"<tr>"+
									"	<th scope=\"row\">Larghezza colonne "+(i+1)+"</th>"+
									"	<td>"+							
									"		<input class=\"width-colonne-false\" value=\""+percent+"\"/>%"+
									"	</td>"+
									"</tr>";
					}
					
					$(".widthColTable").append(html);
				}
				
				function creaWidthCol(widthCols){
					$(".widthColTable").empty();
					
					var widthColsArray = widthCols.split(",");
					
					var html;
					for(var i=0;i<widthColsArray.length;i++){						
						html += 	"<tr>"+
									"	<th scope=\"row\">Larghezza colonne "+(i+1)+"</th>"+
									"	<td>"+							
									"		<input class=\"width-colonne-false\" value=\""+widthColsArray[i]+"\"/>%"+
									"	</td>"+
									"</tr>";
					}
					
					$(".widthColTable").append(html);
				}
				
			});

		</script>

		<div class="wrap">
			<h2>Pagina Opzioni</h2>
			
			<form action="options.php" method="post">

				<?php settings_fields('gruppo-opzioni'); ?>		
				<?php do_settings_sections('gruppo-opzioni'); ?>				
				
				<!-- OPZIONE AGGIUNTI TESTO -->
				
				<table class="form-table">
					<tr>
						<th scope="row">Numero di colonne</th>
						<td>							
							<?php								
								if(get_option('numero-colonne')!= null){
									$numColValue = get_option('numero-colonne');
								} else{
									$numColValue = 3;
								}	
							?>
							<select class="numero-colonne" name="numero-colonne">
								<?php 
									for($i=1; $i<=6; $i++){
										if($numColValue==$i){
											echo '<option value='.$i.' selected>'.$i.'</option>';
										}else {
											echo '<option value='.$i.'>'.$i.'</option>';
										}
									}
								?>								
							</select>							
						</td>
					</tr>					
				</table>
				
				<table class="widthColTable form-table">
				</table>
				
				<input type="hidden" class="width-colonne" name="width-colonne" value="">
				
				<p class="submit">
					<input type="submit" value="<?php _e('Salva'); ?>">
				</p>	

			</form>

		</div>
		
<?php } ?>
