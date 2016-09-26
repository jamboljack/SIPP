<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Data Pedagang</title>
<style type="text/css">
	table {
    	border: 1px solid #ccccb3;    	
    	width: 100%;
	}
	
    th {
    	height: 30px;
	}
	
    th {
    	height: 20px;
    	background-color: #eff3f8;
    	color: black;
	}
	
    th, td {
	    padding: 5px;
	    border-bottom: 1px solid #ddd;	
	}
    h4 {
        text-decoration: underline;
        line-height: 0.5px;   
    }	
</style>

<style type="text/css">
	body{
        font-family: "Times New Roman"; 
        font-size:14px
    }
	
    h1{
        font-size:15px
    }	
</style>

<style>
@media print{
	#comments_controls,
	#print-link{
		display:none;
	}
}
</style>
</head>

<body>
<a href="#Print">
<img src="<?php echo base_url(); ?>img/print_icon.gif" height="36" width="32" title="Print" id="print-link" onClick="window.print(); return false;" />
</a>
<div class="page">
<div align="left"><img src="<?php echo base_url(); ?>img/logo-home.png"></div>
<div align="center">LAPORAN HRD</div>  
<div align="center">ALL EMPLOYEE LIST</div>  
<br>
<br>
<table align="center">
    <tr>
        <th width="5%">No</th>
        <th width="10%">NPWRD</th>
        <th width="15%">Nama Pedagang</th>
        <th>Alamat</th>
        <th width="30%">Pasar</th>
    </tr>
    <?php
    foreach($daftarlist as $d) {
        $department_id = $d->department_id;
    ?>
    <tr>
        <td colspan='9'><b>Department : <?php echo $d->department_name; ?></b></td>
    </tr>
    <?php
      $daftarlist = $this->lap1_model->select_all_employee($department_id)->result(); 
    	$no = 1; 
    	foreach($daftarlist as $r) {
        $tgllahir    = $r->emp_birthdate;                                    
        if (!empty($tgllahir)) {
          $xtgllahir  = explode("-",$tgllahir);
          $thn    = $xtgllahir[0];
          $bln    = $xtgllahir[1];
          $tgl    = $xtgllahir[2];

          $lahir    = $tgl.'-'.$bln.'-'.$thn;
        } else { 
          $lahir    = '';
        }

        $tgljoin     = $r->emp_start_join;                                   
        if (!empty($tgljoin)) {
          $xtgljoin   = explode("-",$tgljoin);
          $thn1     = $xtgljoin[0];
          $bln1     = $xtgljoin[1];
          $tgl1     = $xtgljoin[2];

          $join     = $tgl1.'-'.$bln1.'-'.$thn1;
        } else { 
          $join     = '';
        }

        $tglend    = $r->emp_end_contract;                                   
        if (!empty($tglend)) {
          $xtglend  = explode("-",$tglend);
          $thn2     = $xtglend[0];
          $bln2     = $xtglend[1];
          $tgl2     = $xtglend[2];

          $end    = $tgl2.'-'.$bln2.'-'.$thn2;
        } else { 
          $end    = '';
        } 
    ?>
    <tr>
      <td align="center"><?php echo $no; ?></td>
      <td align="center"><?php echo $r->emp_nik; ?></td>               
      <td><?php echo $r->emp_name; ?></td>
      <td align="center"><?php echo $lahir; ?></td>
      <td align="center"><?php echo $join; ?></td>
      <td align="center"><?php echo $end; ?></td>      
      <td align="center"><?php echo age($r->emp_start_join); ?></td>      
      <td><?php echo $r->position_name; ?></td>
      <td><?php echo $r->status_name; ?></td>     
    </tr>
    <?php 
      $no++; 
      } 
    }
    ?>
  </table>
</div>

</body>
</html>