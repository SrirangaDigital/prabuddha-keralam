	<?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>
											<?php

												include("connect.php");
												require_once("common.php");

												if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

												if(!(isValidVolume($volume)))
												{
													exit(1);
												}

												$query = "select distinct year,part,month from article where volume='$volume' order by part";
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												
												echo '<header>';
												echo '<h2>Volume&nbsp;'.intval($volume).'</h2>';
												echo '<p>'.getYear($volume).'</p>';
												echo '</header>';
											?>
				
								<div class="row">
									<div class="12u">
										<section class="box">
												
												
								<div class="clearfix">
									<nav id="menu" class="nav">					
										<ul>
											<?php


												if($num_rows > 0)
												{
													$isFirst = 1;
													while($row = $result->fetch_assoc())
													{
														echo "<li>";
														echo '<a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">';
														echo '<span>'.getMonth_part($row['month']).' </span>';
														echo "</a>";
														echo "</li>";
														$isFirst = 0;
													}
												}
													echo '</ul>';

												if($result){$result->free();}
												$db->close();

												?>
							</nav>
							</div>
						</div>
					</div>
				</section>

			</section>
					
			
		<?php include("footer.php"); ?>
