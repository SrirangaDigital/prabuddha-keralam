	<?php include("header.php");?>
	<?php include("nav.php"); ?>
		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>			<header>
					<h2>Authors</h2>
					<p>List of all authors sorted alphabetically</p>
				</header>
								<div class="row">
									<div class="12u">
										<section class="box">
				<div class="archive_holder">
					<div class="alphabet">
							<span class="letter"><a href="authors_01.html">അ</a></span>
							<span class="letter"><a href="authors_02.html">ആ</a></span>
							<span class="letter"><a href="authors_03.html">ഇ</a></span>
							<span class="letter"><a href="authors_04.html">ഈ</a></span>
							<span class="letter"><a href="authors_05.html">ഉ</a></span>
							<span class="letter"><a href="authors_06.html">ഊ</a></span>
							<span class="letter"><a href="authors_07.html">ഋ</a></span>
							<span class="letter"><a href="authors_08.html">എ</a></span>
							<span class="letter"><a href="authors_09.html">ഏ</a></span>
							<span class="letter"><a href="authors_10.html">ഐ</a></span>
							<span class="letter"><a href="authors_11.html">ഒ</a></span>
							<span class="letter"><a href="authors_12.html">ഓ</a></span>
							<span class="letter"><a href="authors_13.html">ക</a></span>
							<span class="letter"><a href="authors_14.html">ഗ</a></span>
							<span class="letter"><a href="authors_15.html">ച</a></span>
							<span class="letter"><a href="authors_16.html">ജ</a></span>
							<span class="letter"><a href="authors_17.html">ട</a></span>
							<span class="letter"><a href="authors_18.html">ഡ</a></span>
							<span class="letter"><a href="authors_19.html">ത</a></span>
							<span class="letter"><a href="authors_20.html">ദ</a></span>
							<span class="letter"><a href="authors_21.html">ധ</a></span>
							<span class="letter"><a href="authors_22.html">ന</a></span>
							<span class="letter"><a href="authors_23.html">പ</a></span>
							<span class="letter"><a href="authors_24.html">ഫ</a></span>
							<span class="letter"><a href="authors_25.html">ബ</a></span>
							<span class="letter"><a href="authors_26.html">ഭ</a></span>
							<span class="letter"><a href="authors_27.html">മ</a></span>
							<span class="letter"><a href="authors_28.html">യ</a></span>
							<span class="letter"><a href="authors_29.html">ര</a></span>
							<span class="letter"><a href="authors_30.html">റ</a></span>
							<span class="letter"><a href="authors_31.html">ല</a></span>
							<span class="letter"><a href="authors_32.html">വ</a></span>
							<span class="letter"><a href="authors_33.html">ശ</a></span>
							<span class="letter"><a href="authors_34.html">ഷ</a></span>
							<span class="letter"><a href="authors_35.html">സ</a></span>
							<span class="letter"><a href="authors_36.html">ഹ</a></span>
							<span class="letter"><a href="authors_37.html">#</a></span>
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
								if($letter == 'Special')
								{
									$query = "select * from author where authorname regexp '^[a-zA-Z].*' order by authorname";
								}
								else
								{
									$query = "select * from author where authorname like '$letter%' order by authorname";
								}
								
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
										echo "<span class=\"titlespan\"><a href=\"auth_". $authid . ".html\">$authorname</a></span>";
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
