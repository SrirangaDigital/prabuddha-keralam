    <?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>
				<header>
					<h2>Search</h2>
					<p>Search through the entire collection</p>
				</header>
				<?php
				include("connect.php");
				require_once("common.php");
				?>
                <div class="row">
					<div class="12u">
						
						<!-- Form -->
							<section class="box">
								<h3>Search</h3>
								<?php include("keyboard.php");?>
								<form method="get" action="search-result.php">
									<div class="row uniform 50%">
										<div class="6u 12u(3)">
											Title <input type="text" name="title" id="title" onfocus="SetId('title')" value=""/>
										</div>
									</div>
									
									<div class="row uniform 50%">
										<div class="3u 12u(3)">
											Author <input type="text" name="author" id="author" onfocus="SetId('author')" value="" />
										</div>
									</div>
										<div class="row uniform 50%">
<!--
											<div class="2u 12u(3)">
-->
											<div class="2u 12u(3)">
												Period
												<select name="year1" style="cursor:context-menu;">
													<option value="">&nbsp;</option>
															<?php

																$query = "select distinct year from article order by year";
																$result = $db->query($query);
																$num_rows = $result ? $result->num_rows : 0;

																if($num_rows > 0)
																{
																	for($i=1;$i<=$num_rows;$i++)
																	{
																		$row = $result->fetch_assoc();

																		$year=$row['year'];
																		echo "<option value=\"$year\">" . $year . "</option>";
																	}
																}

																if($result){$result->free();}

															?>
												</select>
											</div>
											<div class="clr1" style="margin-top: 35px">&ndash;</div>
											<div class="2u 12u(3)">
												&nbsp;
												<select name="year2" style="cursor:context-menu;">
													<option value="">&nbsp;</option>
														<?php
															$result = $db->query($query);
															$num_rows = $result ? $result->num_rows : 0;

															if($num_rows > 0)
															{
																for($i=1;$i<=$num_rows;$i++)
																{
																	$row = $result->fetch_assoc();

																	$year=$row['year'];
																	echo "<option value=\"$year\">" . $year . "</option>";
																}
															}
															if($result){$result->free();}
															$db->close();
														?>
												</select>
											</div>
										</div>
										<div class="row uniform 50%">
											<div class="4u 12u(3)">
												<input type="submit" value="Search" class="fit" />
											</div>
											<div class="2u 12u(3)">
												<input type="reset" value="Reset" class="fit" />
											</div>
										</div>
								</form>
							</section>
						</div>
					</div>
					</section>
				<?php include("footer.php");?>
