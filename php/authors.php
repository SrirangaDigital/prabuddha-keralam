	<?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>			<header>
					<h2>Authors</h2>
					<p>List of all authors in alphabetic order</p>
				</header>
								<div class="row">
									<div class="12u">
										<section class="box">
				<div class="archive_holder">
					<div class="alphabet">
							<span class="letter"><a href="authors.php?letter=അ">അ</a></span>
							<span class="letter"><a href="authors.php?letter=ആ">ആ</a></span>
							<span class="letter"><a href="authors.php?letter=ഇ">ഇ</a></span>
							<span class="letter"><a href="authors.php?letter=ഈ">ഈ</a></span>
							<span class="letter"><a href="authors.php?letter=ഉ">ഉ</a></span>
							<span class="letter"><a href="authors.php?letter=ഊ">ഊ</a></span>
							<span class="letter"><a href="authors.php?letter=എ">എ</a></span>
							<span class="letter"><a href="authors.php?letter=ഏ">ഏ</a></span>
							<span class="letter"><a href="authors.php?letter=ഐ">ഐ</a></span>
							<span class="letter"><a href="authors.php?letter=ഒ">ഒ</a></span>
							<span class="letter"><a href="authors.php?letter=ഓ">ഓ</a></span>
							<span class="letter"><a href="authors.php?letter=ക">ക</a></span>
							<span class="letter"><a href="authors.php?letter=ഗ">ഗ</a></span>
							<span class="letter"><a href="authors.php?letter=ച">ച</a></span>
							<span class="letter"><a href="authors.php?letter=ജ">ജ</a></span>
							<span class="letter"><a href="authors.php?letter=ട">ട</a></span>
							<span class="letter"><a href="authors.php?letter=ഡ">ഡ</a></span>
							<span class="letter"><a href="authors.php?letter=ത">ത</a></span>
							<span class="letter"><a href="authors.php?letter=ദ">ദ</a></span>
							<span class="letter"><a href="authors.php?letter=ധ">ധ</a></span>
							<span class="letter"><a href="authors.php?letter=ന">ന</a></span>
							<span class="letter"><a href="authors.php?letter=പ">പ</a></span>
							<span class="letter"><a href="authors.php?letter=ഫ">ഫ</a></span>
							<span class="letter"><a href="authors.php?letter=ബ">ബ</a></span>
							<span class="letter"><a href="authors.php?letter=ഭ">ഭ</a></span>
							<span class="letter"><a href="authors.php?letter=മ">മ</a></span>
							<span class="letter"><a href="authors.php?letter=യ">യ</a></span>
							<span class="letter"><a href="authors.php?letter=ര">ര</a></span>
							<span class="letter"><a href="authors.php?letter=റ">റ</a></span>
							<span class="letter"><a href="authors.php?letter=ല">ല</a></span>
							<span class="letter"><a href="authors.php?letter=വ">വ</a></span>
							<span class="letter"><a href="authors.php?letter=ശ">ശ</a></span>
							<span class="letter"><a href="authors.php?letter=ഷ">ഷ</a></span>
							<span class="letter"><a href="authors.php?letter=സ">സ</a></span>
							<span class="letter"><a href="authors.php?letter=ഹ">ഹ</a></span>
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
										//~ echo "<div class=\"clearfix\"></div></div>";
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

								//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
								//~ $rs = mysql_select_db($database,$db) or die("No Database");

								$query = "select * from author where authorname like '$letter%' order by authorname";
								/*
								$query = "select * from author where authorname like '$letter%' order by authorname";
								*/

								//~ $result = mysql_query($query);
								//~ $num_rows = mysql_num_rows($result);

								$result = $db->query($query); 
								$num_rows = $result ? $result->num_rows : 0;

								if($num_rows > 0)
								{
									echo '<ul>';
									for($i=1;$i<=$num_rows;$i++)
									{
										//~ $row=mysql_fetch_assoc($result);
										$row = $result->fetch_assoc();

										$authid=$row['authid'];
										$authorname=$row['authorname'];
										//~ echo '<div class="article">';
										
										echo "<li>";
										echo "<span class=\"titlespan\"><a href=\"auth.php?authid=$authid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
										echo "</li>";
										
									}
										echo '</ul>';
										//~ echo '</div>';
										
								}

								else
								{
									echo "<li>Sorry! No author names were found to begin with the letter '$letter' in Prabuddhakeralam </li>";
								}
								if($result){$result->free();}
								$db->close();
								?>
								</div>
							</section>
						</div>
					</div>
				</section>
				<?php include("footer.php");?>
