<?php

error_reporting( error_reporting() & ~E_NOTICE );

session_start();

//Engedélyek kezelése

$allow_delete = false; // Fájlok törlése
$allow_upload = false; // Fájlok feltöltése
$allow_create_folder = false; // Mappa létrehozáse
$allow_reg_user = false; // Felhasználó regisztrálása




if ($_SESSION["userlvl"] == 2) {
	$allow_delete = true;
	$allow_upload = true;
	$allow_create_folder = true;
} elseif ($_SESSION["userlvl"] == 9) {
	$allow_delete = true;
	$allow_upload = true;
	$allow_create_folder = true;
	$allow_reg_user = true;
}




setlocale(LC_ALL,'en_US.UTF-8');

$allow_show_folders = true; // Mappák megjelenitése

$disallowed_patterns = ['*.php','.*','*.html','*.js','*.css'];  // Ezeket a fajta fájlokat nem lehet feltölteni
$hidden_patterns = ['*.php','.*','*.html','*.js','*.css','css','JavaScript','database','img']; // Ezek a fájlok rejtve maradnak

$tmp_dir = dirname($_SERVER['SCRIPT_FILENAME']);
if(DIRECTORY_SEPARATOR==='\\') $tmp_dir = str_replace('/',DIRECTORY_SEPARATOR,$tmp_dir);
$tmp = get_absolute_path($tmp_dir . '/' .$_REQUEST['file']);

if($tmp === false)
	err(404,'file vagy könyvtár nem található');
if(substr($tmp, 0,strlen($tmp_dir)) !== $tmp_dir)
	err(403,"Tiltott");
if(strpos($_REQUEST['file'], DIRECTORY_SEPARATOR) === 0)
	err(403,"Tiltott");
if(preg_match('@^.+://@',$_REQUEST['file'])) {
	err(403,"Tiltott");
}


if(!$_COOKIE['_sfm_xsrf'])
	setcookie('_sfm_xsrf',bin2hex(openssl_random_pseudo_bytes(16)));
if($_POST) {
	if($_COOKIE['_sfm_xsrf'] !== $_POST['xsrf'] || !$_POST['xsrf'])
		err(403,"XSRF Failure");
}

$file = $_REQUEST['file'] ?: '.';

if($_GET['do'] == 'list') {
	if (is_dir($file)) {
		$directory = $file;
		$result = [];
		$files = array_diff(scandir($directory), ['.','..']);
		foreach ($files as $entry) if (!is_entry_ignored($entry, $allow_show_folders, $hidden_patterns)) {
			$i = $directory . '/' . $entry;
			$stat = stat($i);
			$result[] = [
				'mtime' => $stat['mtime'],
				'size' => $stat['size'],
				'name' => basename($i),
				'path' => preg_replace('@^\./@', '', $i),
				'is_dir' => is_dir($i),
				'is_deleteable' => $allow_delete && ((!is_dir($i) && is_writable($directory)) ||
														(is_dir($i) && is_writable($directory) && is_recursively_deleteable($i))),
				'is_readable' => is_readable($i),
				'is_writable' => is_writable($i),
				'is_executable' => is_executable($i),
			];
		}
		usort($result,function($f1,$f2){
			$f1_key = ($f1['is_dir']?:2) . $f1['name'];
			$f2_key = ($f2['is_dir']?:2) . $f2['name'];
			return $f1_key > $f2_key;
		});
	} else {
		err(412,"nem könyvtár");
	}
	echo json_encode(['success' => true, 'is_writable' => is_writable($file), 'results' =>$result]);
	exit;
} elseif ($_POST['do'] == 'delete') {
	if($allow_delete) {
		rmrf($file);
	}
	exit;
} elseif ($_POST['do'] == 'mkdir' && $allow_create_folder) {
	$dir = $_POST['name'];
	$dir = str_replace('/', '', $dir);
	if(substr($dir, 0, 2) === '..')
	    exit;
	chdir($file);
	@mkdir($_POST['name']);
	exit;
} elseif ($_POST['do'] == 'upload' && $allow_upload) {
	foreach($disallowed_patterns as $pattern)
		if(fnmatch($pattern, $_FILES['file_data']['name']))
			err(403,"File típus nem megengedett.");

	$res = move_uploaded_file($_FILES['file_data']['tmp_name'], $file.'/'.$_FILES['file_data']['name']);
	exit;
} elseif ($_GET['do'] == 'download') {
	foreach($disallowed_patterns as $pattern)
		if(fnmatch($pattern, $file))
			err(403,"File típus nem megengedett.");

	$filename = basename($file);
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	header('Content-Type: ' . finfo_file($finfo, $file));
	header('Content-Length: '. filesize($file));
	header(sprintf('Content-Disposition: attachment; filename=%s',
		strpos('MSIE',$_SERVER['HTTP_REFERER']) ? rawurlencode($filename) : "\"$filename\"" ));
	ob_flush();
	readfile($file);
	exit;
}
function is_entry_ignored($entry, $allow_show_folders, $hidden_patterns) {
	if ($entry === basename(__FILE__)) {
		return true;
	}

	if (is_dir($entry) && !$allow_show_folders) {
		return true;
	}
	foreach($hidden_patterns as $pattern) {
		if(fnmatch($pattern,$entry)) {
			return true;
		}
	}
	return false;
}

function rmrf($dir) {
	if(is_dir($dir)) {
		$files = array_diff(scandir($dir), ['.','..']);
		foreach ($files as $file)
			rmrf("$dir/$file");
		rmdir($dir);
	} else {
		unlink($dir);
	}
}
function is_recursively_deleteable($d) {
	$stack = [$d];
	while($dir = array_pop($stack)) {
		if(!is_readable($dir) || !is_writable($dir))
			return false;
		$files = array_diff(scandir($dir), ['.','..']);
		foreach($files as $file) if(is_dir($file)) {
			$stack[] = "$dir/$file";
		}
	}
	return true;
}


function get_absolute_path($path) {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $parts = explode(DIRECTORY_SEPARATOR, $path);
        $absolutes = [];
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes);
    }

function err($code,$msg) {
	http_response_code($code);
	header("Content-Type: application/json");
	echo json_encode(['error' => ['code'=>intval($code), 'msg' => $msg]]);
	exit;
}

function asBytes($ini_v) {
	$ini_v = trim($ini_v);
	$s = ['g'=> 1<<30, 'm' => 1<<20, 'k' => 1<<10];
	return intval($ini_v) * ($s[strtolower(substr($ini_v,-1))] ?: 1);
}
$MAX_UPLOAD_SIZE = min(asBytes(ini_get('post_max_size')), asBytes(ini_get('upload_max_filesize')));

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/uploader.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script language="JavaScript" src="JavaScript/upload.js" type="text/javascript"></script>

</head>
<body>

<div>
<?php if($allow_reg_user): ?>
  <a href="regform.html">Felhasználó regisztrálása</a>
  <?php endif; ?>
  <a class="text" href="logout.php">Kijelentkezés</a>
  <style>
.text:link, .text:visited {
    margin-left: 150px;
    margin-top: 3px;
    background-color: #F5F5F5;
    color: black;
    border-style: solid;
    border-width:2px;
    border-radius: 15px 15px 15px 15px;
    width:200px

}
a:link, a:visited {
  background-color: #401b58;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
</style>
    <?php if($allow_create_folder): ?>
        <form action="?" method="post" id="mkdir" />
        <label for=dirname>Új mappa létrehozása</label><input id=dirname type=text name=name value="" />
        <input type="submit" value="létrehozás" />
        </form>

    <?php endif; ?>
    <?php if($allow_upload): ?>

        <div id="file_drop_target">
            Huzd ide a fájlt feltöltéshez
            <b>vagy</b>
            <input type="file" multiple />
        </div>
    <?php endif; ?>

</div>
<div id="breadcrumb">&nbsp;</div>
<table id="table"><thead><tr>
	<th>Név</th>
	<th>Méret</th>
	<th>Utolsó modosítás</th>
	<th>Engedélyek</th>
	<th>Műveletek</th>
</tr></thead><tbody id="list">
<style>
#table {
	width:100%;
	border:2px solid black;
	margin-top:50px;
  background-color: #ee06c7;
}
</style>
</tbody></table>

</body>
</html>