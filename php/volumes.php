    <?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>
				<header>
					<h2>Volumes</h2>
					<p>List of all volumes published till date</p>
				</header>
								<div class="row">
									<div class="12u">
										<section class="box">
										<?php

												include("connect.php");
												require_once("common.php");
												$query = 'select distinct volume from article order by volume';
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												$row_count = 10;
												$count = 0;
												$col = 3;
												if($num_rows > 0)
												{
													while($row = $result->fetch_assoc())
													{
														$count++;
														if($count > $row_count) {
															$count = 1;
														}
														echo '<a href="part.php?vol='. $row['volume'] .'"><div class="button alt" > Volume&nbsp;'. intval($row['volume']) .'&nbsp;&nbsp;('.getYear($row['volume']) . ')</div></a>';
													}
												}
												if($result){$result->free();}
												$db->close();
										?>
									</section>	
									</div>
								</div>
							</section>
						<?php include("footer.php");?>
