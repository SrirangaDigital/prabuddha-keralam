	<?php include("header.php");?>
	<?php include("nav.php"); ?>

		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php");?>
			<?php
				include("connect.php");
				require_once("common.php");
				if(isset($_GET['authid'])){$authid = $_GET['authid'];}else{$authid = '';}
				if(isset($_GET['author'])){$authorname = $_GET['author'];}else{$authorname = '';}
				echo "<header>";
				echo "<h2>$authorname</h2>";
				echo "<p>Bibliography</p>";
				echo "</header>";
			?>
								<div class="row">
									<div class="12u">
										<section class="box">
											
										<?php


										$db = @new mysqli('localhost', "$user", "$password", "$database");
										$db->set_charset('utf8');
										if($db->connect_errno > 0)
										{
											echo 'Not connected to the database [' . $db->connect_errno . ']';
											echo "</div></div>";
											echo "</body></html>";
											exit(1);
										}

										$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");



										$query = "(select titleid, title, page from article where authid like '%$authid%')";


										$result = $db->query($query);
										$num_rows = $result ? $result->num_rows : 0;
										echo '<ul>';
										if($num_rows > 0)
										{
											for($i=1;$i<=$num_rows;$i++)
											{
												//~ $row=mysql_fetch_assoc($result);
												$row = $result->fetch_assoc();

												//~ $type=$row['type'];
												$book_id=$row['titleid'];
												$title=$row['title'];
												$page=$row['page'];
												
												$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
												$title = preg_replace('/!/', "", $title);
												$type = 1;
												$query_aux = "select * from article where titleid='$book_id'";
													
													//~ $result_aux = mysql_query($query_aux);
													$result_aux = $db->query($query_aux); 
													//~ $row_aux=mysql_fetch_assoc($result_aux);
													$row_aux = $result_aux->fetch_assoc();

													$titleid=$row_aux['titleid'];
													$title=$row_aux['title'];
													$featid=$row_aux['featid'];
													$page=$row_aux['page'];
													$authid=$row_aux['authid'];
													$volume=$row_aux['volume'];
													$part=$row_aux['part'];
													$year=$row_aux['year'];
													$month=$row_aux['month'];
													
													if($result_aux){$result_aux->free();}
													
													$paper = $volume;	
													$title1=addslashes($title);
															
													$query3 = "select feat_name from feature where featid='$featid'";
													
													//~ $result3 = mysql_query($query3);		
													//~ $row3=mysql_fetch_assoc($result3);
													
													$result3 = $db->query($query3); 
													$row3 = $result3->fetch_assoc();
													
													$dpart = preg_replace("/^0/", "", $part);
													$dpart = preg_replace("/\-0/", "-", $dpart);
													$feature=$row3['feat_name'];
													
													if($result3){$result3->free();}
															
														echo "<li>";
												echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
												echo "
												<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
												<span class=\"yearspan\">
													<a href=\"toc_".$volume."_".$part.".html\">" . $month_name{intval($month)} . " " . $year ." &nbsp;(Volume&nbsp;".intval($volume).", Issue&nbsp;".$dpart.")</a>
												</span>";
												if($feature != "")
												{
													echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=" . urlencode($feature) . "&amp;featid=$featid\">$feature</a></span>";
												}
														
														echo "</li>\n";
													
													
												} echo '</ul>';
											}
										else
										{
											echo "No data in the database";
										}
										if($result){$result->free();}
										$db->close();
										?>
										</section>
									</div>
								</div>
							</section>
				<?php include("footer.php");?>
