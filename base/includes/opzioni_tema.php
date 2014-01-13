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
		//Seo
		register_setting('gruppo-opzioni', 'meta-description' );
		register_setting('gruppo-opzioni', 'meta-keywords' );
		//Grid
		register_setting('gruppo-opzioni', 'width-grid' );
		register_setting('gruppo-opzioni', 'numero-colonne' );
		register_setting('gruppo-opzioni', 'width-colonne' );
		register_setting('gruppo-opzioni', 'margin-image' );
		//Header
		register_setting('gruppo-opzioni', 'header-type-title' );
		register_setting('gruppo-opzioni', 'header-logo-max-width' );		
	}
?>

<?php
	//Pagina delle opzioni
	function opzioni_tema() {
?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_options.css">
		<link rel="stylesheet" type="text/css" media="all" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">				
		<link rel="stylesheet" href="/resources/demos/style.css">
		
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
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
									"		<input type=\"text\" class=\"width-colonne-false text-option-percent\" value=\""+widthColsArray[i]+"\"/>%"+
									"	</td>"+
									"</tr>";
					}
					
					$(".widthColTable").append(html);
				}
				
				$(function() {
					$( "#tabs" ).tabs();
				});				
			});						
		</script>

		<div class="wrap">
						
			<form action="options.php" method="post">
				
				<div id="tabs">
					<ul>
						<li><a href="#tabs-seo">Seo</a></li>
						<li><a href="#tabs-grid">Grid</a></li>
						<li><a href="#tabs-header">Header</a></li>
					</ul>
					
					<!--****************************************************-->
					<!--						SEO 						-->
					<!--****************************************************-->
					
					<div id="tabs-seo">
						<h2>Opzioni SEO</h2>																			
						<table>
							<tr>
								<th scope="row">Meta Description</th>
								<td style="width: 70%;">							
									<?php								
										if(get_option('meta-description')!= null){
											$metaDescription = get_option('meta-description');
										}
									?>
									<input type="text" value="<?php echo $metaDescription?>" style="width: 100%" name="meta-description"/>
								</td>
							</tr>			
							<tr>
								<th scope="row">Meta Keywords</th>
								<td style="width: 70%;">							
									<?php								
										if(get_option('meta-keywords')!= null){
											$metaKeywords = get_option('meta-keywords');
										}
									?>
									<input type="text" value="<?php echo $metaDescription?>" style="width: 100%" name="meta-keywords"/>
								</td>
							</tr>											
						</table>		
					</div>
					
					<!--****************************************************-->
					<!--						GRID						-->
					<!--****************************************************-->
					
					<div id="tabs-grid">
						<h2>Pagina Opzioni</h2>
						
						<?php settings_fields('gruppo-opzioni'); ?>		
						<?php do_settings_sections('gruppo-opzioni'); ?>				
						
						<!-- OPZIONE AGGIUNTI TESTO -->
						
						<table class="form-table">
							<tr>
								<th scope="row">Larghezza griglia</th>
								<td>							
									<?php								
										if(get_option('width-grid')!= null){
											$widthGridValue = get_option('width-grid');
										} else{
											$widthGridValue = 89;
										}	
									?>
									<input type="text" value="<?php echo $widthGridValue?>" class="width-grid text-option-percent" name="width-grid"/>%
								</td>
							</tr>					
						</table>
						
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
						
						<table class="form-table">
							<tr>
								<th scope="row">Larghezza margini immagine</th>
								<td>							
									<?php								
										if(get_option('margin-image')!= null){
											$marginImageValue = get_option('margin-image');
										} else{
											$marginImageValue = 5;
										}	
									?>
									<input type="text" value="<?php echo $marginImageValue?>" class="margin-image text-option-percent" name="margin-image"/>px
								</td>
							</tr>					
						</table>						
					</div>
					
					<!--****************************************************-->
					<!--						HEADER						-->
					<!--****************************************************-->
					
					<div id="tabs-header">
						<h2>Header</h2>
							<input type="radio" class="header-type-title" name="header-type-title" value="text" 
								<?php								
									if(get_option('header-type-title') == null || get_option('header-type-title') == "" || get_option('header-type-title')== "text" ){
										echo "checked=\"checked\"";
									}
								?>>Text	
							<input type="radio" class="header-type-title" name="header-type-title" value="image"
								<?php								
									if(get_option('header-type-title')== "image" ){
										echo "checked=\"checked\"";
									}
								?>>Image
							
							<table class="form-table headerTableHeight">
								<tr>
									<th scope="row">Larghezza massima logo del sito</th>
									<td>							
										<?php								
											if(get_option('header-logo-max-width')!= null){
												$headerLogoWidth = get_option('header-logo-max-width');
											} else{
												$headerLogoWidth = 200;
											}	
										?>
										<input type="text" value="<?php echo $headerLogoWidth?>" class="header-logo-max-width text-option-percent" name="header-logo-max-width"/>px
									</td>
								</tr>								
							</table>
					</div>
					
				</div>
				
				<p class="submit">
					<input type="submit" value="<?php _e('Salva'); ?>">
				</p>
			</form>

		</div>
		
<?php } ?>
