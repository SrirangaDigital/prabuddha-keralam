    <?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				    <?php include("sec_nav.php");?>
							<?php
								include("connect.php");
								require_once("common.php");
								if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}
								if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}
								if(!(isValidVolume($volume) && isValidPart($part)))
								{ 
									echo "Invalid URL";
									
									echo "</div></div>";
									echo "<div class=\"clearfix\"></div></div>";
									echo "</body></html>";
									exit(1);
								}

								$db = @new mysqli('localhost', "$user", "$password", "$database");
								$db->set_charset('utf8');
								if($db->connect_errno > 0)
								{
									echo 'Not connected to the database [' . $db->connect_errno . ']';
									echo "</div></div>";
									echo "<div class=\"clearfix\"></div></div>";
									echo "</body></html>";
									exit(1);
								}
								$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
								$query = "select distinct year,month from article where volume='$volume' and part='$part'";
								$result = $db->query($query); 
								$num_rows = $result ? $result->num_rows : 0;
								if($num_rows > 0)
								{
									$row = $result->fetch_assoc();
									$month=$row['month'];
									$year=$row['year'];
									$dpart = preg_replace("/^0/", "", $part);
									$dpart = preg_replace("/\-0/", "-", $dpart);
								}
								if($result){$result->free();}
												echo "<header>";
												echo "<h2>" . getMonth($month) . ",&nbsp;" . $year . "</h2>";
												echo "<p>Volume&nbsp;" . intval($volume) . ",&nbsp;Issue&nbsp;" . $dpart . "</p>";
												echo "</header>";
							?>
				
				
										<section class="box">
											<div class="archive_holder">
											<div class="row">
												<div class="9u 12u(3)">
													


											<?php
											$query = 'select * from article where volume=\'' . $volume . '\' and part=\'' . $part . '\'';

											$result = $db->query($query); 
											$num_rows = $result ? $result->num_rows : 0;
											//~ echo '<ul class="dot">';
											echo '<ul>';
											if($num_rows > 0)
											{
												while($row = $result->fetch_assoc())
												{
													$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
													$result3 = $db->query($query3); 
													$row3 = $result3->fetch_assoc();		
													
													$dpart = preg_replace("/^0/", "", $row['part']);
													$dpart = preg_replace("/\-0/", "-", $dpart);
													
													if($result3){$result3->free();}

/*
													echo '<div class="article">';
*/
													
													echo "<li>";
													//~ echo ($row3['feat_name'] != '') ? '<span class="featurespan"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span></div>' : '';
													echo '	<span class="titlespan"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
													if($row['authid'] != 0) {

														echo '	<span class="authorspan"> ';
														$authids = preg_split('/;/',$row['authid']);
														$authornames = preg_split('/;/',$row['authorname']);
														$a=0;
														foreach ($authids as $aid) {

															echo '<a href="auth_' . $aid . '.html">&nbsp;' . $authornames[$a] . '</a> ';
															$a++;
														}
														
														echo '	</span>';
														echo '</li>';
													}
													
/*
													echo '</div>';
*/
												}
												//~ echo '</ul>';
											} echo '</ul>';

											if($result){$result->free();}
											$db->close();
											?>
										</div>
									</div>
								</div>
							</section>
						</section>
					    <?php include("footer.php");?>
