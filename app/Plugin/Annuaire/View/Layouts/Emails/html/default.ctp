<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">          
	<title><?php echo $title_for_layout;?></title>
</head>
<body>
	<table width="650" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333" style="border:1px solid #333333;padding:0;margin:0">
		<tr>
			<td>
				<table width="650" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td bgcolor="#333333" style="color:#ffffff;padding:10px"><h1 >Annuaire Culturel</h1></td>
					</tr>
					<tr>
						<td style="padding:20px"><?php echo $this->fetch('content');?></td>
					</tr>
					<tr>
						<td style="margin-top:20px" align="center">
						<font style="font-size:10px;color:#999999">Cet email a été envoyé à partir de l'application Ric WEB</font></td>
					</tr>
				</table>
			</td>
		</tr>
		
	</table>

</body>
</html>