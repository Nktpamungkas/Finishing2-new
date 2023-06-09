<?php
    ini_set("error_reporting", 1);
    session_start();
    require_once "koneksi.php"; 
    $demand = $_GET['demand'];
    $sqlcetaklabel = "SELECT 
                            p.CODE AS DEMAND,
                            b.LEGALNAME1 AS PELANGGAN,
                            s.CODE AS NOMOR_ORDER,
                            (trim( s2.SUBCODE01 ) || trim( s2.SUBCODE02 ) || trim( s2.SUBCODE03 )) AS HANGER,
                            trim( s2.ITEMDESCRIPTION ) AS JENISKAIN,
                            trim( u.LONGDESCRIPTION ) AS WARNA,
                            trim (s2.SUBCODE05) AS NO_WARNA
                        FROM 
                            PRODUCTIONDEMAND p
                        LEFT JOIN SALESORDER s ON s.CODE = p.PROJECTCODE
                        LEFT JOIN SALESORDERLINE s2 ON s.PROJECTCODE = s2.PROJECTCODE
                        LEFT JOIN ORDERPARTNER o ON o.CUSTOMERSUPPLIERCODE = s.FNCORDPRNCUSTOMERSUPPLIERCODE
                        LEFT JOIN BUSINESSPARTNER b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                        LEFT JOIN USERGENERICGROUP u ON u.CODE = s2.SUBCODE05
                        WHERE p.CODE LIKE '%$demand%'";
    $stmt_cetaklabel = db2_exec($conn1,$sqlcetaklabel, array('cursor'=>DB2_SCROLLABLE));
    $rowdb2_cetaklabel = db2_fetch_assoc($stmt_cetaklabel);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Label</title>
<style>
	td{
	border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;
	}
	</style>
</head>


<body>
<table width="100%" border="0"style="width: 7in;">
  <tbody>    
    <tr>
        <td align="left" valign="top" style="height: 1.6in;"><table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
            <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo $rowdb2_cetaklabel['DEMAND'];?></div></td>
            </tr>
            <tr>
            <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">
                <?php echo $rowdb2_cetaklabel['PELANGGAN'];?></div></td>
            </tr>
            <tr>
            <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($rowdb2_cetaklabel['PO'],0,31);?></div></td>
            </tr>
            <tr>
            <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><strong><?php echo $rowdb2_cetaklabel['NOMOR_ORDER'];?></strong><?php echo " (".$rowdb2_cetaklabel['HANGER'].")";?></div></td>
            </tr>
            <tr>
            <td colspan="3" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:6px;"><?php echo $rowdb2_cetaklabel['HANGER'].'/asdsadsad'.substr($rowdb2_cetaklabel['JENISKAIN'],0,100);?></div></td>
            </tr>
            <tr>
            <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:7px;"><?php echo "<strong><span style='font-size:9px;'>".substr($rowdb2_cetaklabel['WARNA'],0,60)."</span></strong>/".substr($rowdb2_cetaklabel['NO_WARNA'],0,15);?></span></div></td>
            </tr>
            <tr>
            <td width="41%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">Tgl:</div></td>
            <td colspan="2" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">No MC :</div></td>
            </tr>
            <tr>
            <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lot'];?></div></td>
            <td colspan="2" align="left" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">L&amp;G :</div></td>
            </tr>
            <tr>
            <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">Overfeed:</div></td>
            <td width="27%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">Speed :</div></td>
            <td width="32%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid; border-left:0px #000000 solid; border-right:0px #000000 solid;">Suhu:</td>
            </tr>
            </table>
        </td>
    </tr>
  </tbody>
</table>
</body>
</html>