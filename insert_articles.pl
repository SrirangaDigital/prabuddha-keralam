#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"pke.xml") or die "can't open pke.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');
#vnum, number, month, year, title, feature, authid, page, 

$sth11r=$dbh->prepare("CREATE TABLE article(title varchar(500), 
authid varchar(200),
authorname varchar(1000),
featid varchar(10),
page varchar(10), 
page_end varchar(10), 
volume varchar(10),
part varchar(10),
year varchar(10), 
month varchar(10),
titleid varchar(30), primary key(titleid)) ENGINE=MyISAM");
$sth11r->execute();
$sth11r->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		print $volume . "\n";
	}
	elsif($line =~ /<part pnum="(.*)" month="(.*)" year="(.*)" info="(.*)">/)
	{
		$part = $1;
		$month = $2;
		$year = $3;
		$count = 0;
		$prev_pages = "";
	}	
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$feature = $1;
		$featid = get_featid($feature);
	}	
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$pages = $1;
		($page, $page_end) = split(/-/, $pages);
		if($pages eq $prev_pages)
		{
			$count++;
			$id = "pke_" . $volume . "_" . $part . "_" . $page . "_" . $page_end . "_" . $count; 
		}
		else
		{
			$id = "pke_" . $volume . "_" . $part . "_" . $page . "_" . $page_end . "_0";
			$count = 0;		
		}
		$prev_pages = $pages;
		if ($page_end)
		{
        } 
		else {
			$page_end = $page;
		}
	}	
	elsif($line =~ /<author>(.*)<\/author>/)
	{
		$authorname = $1;
		$authids = $authids . ";" . get_authid($authorname);
		$author_name = $author_name . ";" .$authorname;
	}
	elsif($line =~ /<allauthors\/>/)
	{
		$authids = "0";
		$author_name = "";
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_article($title,$authids,$author_name,$featid,$page,$page_end,$volume,$part,$year,$month,$id);
		$authids = "";
		$featid = "";
		$author_name = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$authids,$author_name,$featid,$page,$page_end,$volume,$part,$year,$month,$id) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into article values('$title','$authids','$author_name','$featid','$page','$page_end','$volume','$part','$year','$month','$id')");
	
	$sth1->execute();
	$sth1->finish();
}

sub get_authid()
{
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}

sub get_featid()
{
	my($feature) = @_;
	my($sth,$ref,$featid);

	$feature =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select featid from feature where feat_name='$feature'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$featid = $ref->{'featid'};
	$sth->finish();
	return($featid);
}
