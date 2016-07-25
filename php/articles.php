	<?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
	<?php include("sec_nav.php"); ?>
				<header>
					<h2>Articles</h2>
					<p>List of all articles sorted alphabetically</p>
				</header>
				
				
								<div class="row">
									<div class="12u">
										<section class="box">
		<div class="archive_holder">
			<div class="alphabet">
				<span class="letter"><a href="articles.php?letter=അ">അ</a></span>
				<span class="letter"><a href="articles.php?letter=ആ">ആ</a></span>
				<span class="letter"><a href="articles.php?letter=ഇ">ഇ</a></span>
				<span class="letter"><a href="articles.php?letter=ഈ">ഈ</a></span>
				<span class="letter"><a href="articles.php?letter=ഉ">ഉ</a></span>
				<span class="letter"><a href="articles.php?letter=ഊ">ഊ</a></span>
				<span class="letter"><a href="articles.php?letter=ഋ">ഋ</a></span>
				<span class="letter"><a href="articles.php?letter=എ">എ</a></span>
				<span class="letter"><a href="articles.php?letter=ഏ">ഏ</a></span>
				<span class="letter"><a href="articles.php?letter=ഐ">ഐ</a></span>
				<span class="letter"><a href="articles.php?letter=ഒ">ഒ</a></span>
				<span class="letter"><a href="articles.php?letter=ഓ">ഓ</a></span>
				<span class="letter"><a href="articles.php?letter=ക">ക</a></span>
				<span class="letter"><a href="articles.php?letter=ഗ">ഗ</a></span>
				<span class="letter"><a href="articles.php?letter=ഘ">ഘ</a></span>
				<span class="letter"><a href="articles.php?letter=ച">ച</a></span>
				<span class="letter"><a href="articles.php?letter=ഛ">ഛ</a></span>
				<span class="letter"><a href="articles.php?letter=ജ">ജ</a></span>
				<span class="letter"><a href="articles.php?letter=ഞ">ഞ</a></span>
				<span class="letter"><a href="articles.php?letter=ട">ട</a></span>
				<span class="letter"><a href="articles.php?letter=ഡ">ഡ</a></span>
				<span class="letter"><a href="articles.php?letter=ത">ത</a></span>
				<span class="letter"><a href="articles.php?letter=ദ">ദ</a></span>
				<span class="letter"><a href="articles.php?letter=ധ">ധ</a></span>
				<span class="letter"><a href="articles.php?letter=ന">ന</a></span>
				<span class="letter"><a href="articles.php?letter=പ">പ</a></span>
				<span class="letter"><a href="articles.php?letter=ഫ">ഫ</a></span>
				<span class="letter"><a href="articles.php?letter=ബ">ബ</a></span>
				<span class="letter"><a href="articles.php?letter=ഭ">ഭ</a></span>
				<span class="letter"><a href="articles.php?letter=മ">മ</a></span>
				<span class="letter"><a href="articles.php?letter=യ">യ</a></span>
				<span class="letter"><a href="articles.php?letter=ര">ര</a></span>
				<span class="letter"><a href="articles.php?letter=റ">റ</a></span>
				<span class="letter"><a href="articles.php?letter=ല">ല</a></span>
				<span class="letter"><a href="articles.php?letter=വ">വ</a></span>
				<span class="letter"><a href="articles.php?letter=ശ">ശ</a></span>
				<span class="letter"><a href="articles.php?letter=ഷ">ഷ</a></span>
				<span class="letter"><a href="articles.php?letter=സ">സ</a></span>
				<span class="letter"><a href="articles.php?letter=ഹ">ഹ</a></span>
				<span class="letter"><a href="articles.php?letter=Special">#</a></span>
			</div>
						<?php

						include("connect.php");
						require_once("common.php");

						if(isset($_GET['letter']))
						{
							$letter=$_GET['letter'];
							
							//~ if(!(isValidLetter($letter)))
							//~ {
								//~ echo "<li>Invalid URL</li>";
								//~ 
								//~ echo "</ul></div></div>";
								//~ include("include_footer.php");
								//~ echo "<div class=\"clearfix\"></div></div>";
								//~ include("include_footer_out.php");
								//~ echo "</body></html>";
								//~ exit(1);
							//~ }
							
							if($letter == '')
							{
								$letter = 'അ';
							}
						}
						else
						{
							$letter = 'അ';
						}

						//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
						//~ $rs = mysql_select_db($database,$db) or die("No Database");

						$db = @new mysqli('localhost', "$user", "$password", "$database");
						$db->set_charset('utf8');
						if($db->connect_errno > 0)
						{
							echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
							echo "</ul></div></div>";
							echo "<div class=\"clearfix\"></div></div>";
							echo "</body></html>";
							exit(1);
						}

						$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

						if($letter == 'Special')
						{
							$query = "select * from article where title regexp '^[a-zA-Z].*' order by title, volume, part, page";
						}
						else
						{
							$query = "select * from article where title like '$letter%' order by title, volume, part, page";
						}

						//~ $result = mysql_query($query);
						//~ $num_rows = mysql_num_rows($result);

						$result = $db->query($query); 
						$num_rows = $result ? $result->num_rows : 0;
						echo "<ul>";
						if($num_rows > 0)
						{
							for($i=1;$i<=$num_rows;$i++)
							{
								//~ $row=mysql_fetch_assoc($result);
								$row = $result->fetch_assoc();
								
								$titleid=$row['titleid'];
								$title=$row['title'];
								$featid=$row['featid'];
								$page=$row['page'];
								$authid=$row['authid'];
								$volume=$row['volume'];
								$part=$row['part'];
								$year=$row['year'];
								$month=$row['month'];
								
								$title1=addslashes($title);
								
								$query3 = "select feat_name from feature where featid='$featid'";
								
								$result3 = $db->query($query3); 
								//~ $result3 = mysql_query($query3);	
									
								//~ $row3=mysql_fetch_assoc($result3);		
								$row3 = $result3->fetch_assoc();		
								$feature=$row3['feat_name'];
								$dpart = preg_replace("/^0/", "", $part);
								$dpart = preg_replace("/\-0/", "-", $dpart);
								if($result3){$result3->free();}
										
								echo "<li>";
								echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
								echo "
								<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
								<span class=\"yearspan\">
									<a href=\"toc.php?vol=$volume&amp;part=$part\">" . $month_name{intval($month)} . " " . $year ." &nbsp;(Volume&nbsp;".intval($volume).", Issue&nbsp;".$dpart.")</a>
								</span>";
								if($feature != "")
								{
									echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=" . urlencode($feature) . "&amp;featid=$featid\">$feature</a></span>";
								}
								
								if($row['authid'] != 0) 
								{

									echo "<br />";
									$aut = preg_split('/;/',$authid);

									$fl = 0;
									foreach ($aut as $aid)
									{
										$query2 = "select * from author where authid=$aid";

										$result2 = $db->query($query2); 				
										$num_rows2 = $result2 ? $result2->num_rows : 0;
										
										if($num_rows2 > 0)
										{
											$row2 = $result2->fetch_assoc();		

											$authorname=$row2['authorname'];
											
											if($fl == 0)
											{
												echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">&nbsp;&nbsp;$authorname</a></span>";
												$fl = 1;
											}
											else
											{
												echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
											}
										}
										if($result2){$result2->free();}
									}
								}
								//~ echo "<br /><span class=\"downloadspan\"><a href=\"../../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";

								echo "</li>";
								
							}echo "</ul>";
								
						}      
						else
						{
							echo "<li>Sorry! No articles were found to begin with the letter '$letter' in Prabuddhakeralam</li>";
						}
						if($result){$result->free();}
						$db->close();
						?>
							</div>
						</section>
					</div>
				</div>
			</section>
			<?php include("footer.php"); ?>
