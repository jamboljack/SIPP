<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>img/kudus.jpg">
<title>Print Laporan Retribusi Pedagang</title>

<style type="text/css">
    body {
        margin: 0;
        font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
        font-weight: 300;
    }

    .page {
        width: 21cm;
        min-height: 29.7cm;
        padding: 0cm;
        margin: 0.1cm auto;
    }

    #table {
        display: table;
        
        width: 100%; 
        background: #fff;
        margin: 0;
        box-sizing: border-box;

     }

     .caption {
        display: block;
        width: 100%;
        background: #64e0ef;
        height: 55px;
        padding-left: 10px;
        color: #fff;
        font-size: 20px;
        line-height: 55px;
        text-shadow: 1px 1px 1px rgba(0,0,0,.3);
        box-sizing: border-box;
     }


     .header-row {
        background: #8b8b8b;
        color: #fff;

     }

    .row {
        display: table-row;
    }

    .cell {
        display: table-cell;
        
        padding: 6px; 
        border-bottom: 1px solid #e5e5e5;
        text-align: center;
    }

    .primary {
        text-align: left;
    }


    input[type="radio"],
    input[type="checkbox"]{
        display: none;
    }


    @media only screen and (max-width: 760px)  {

        body {
            padding: 0;
        }

        #table {
            display: block;
            margin: 44px 0 0 0;
        }

        .caption {
            position: fixed;
            top: 0;
            text-align: center;
            height: 44px;
            line-height: 44px;
            z-index: 5;
            border-bottom: 2px solid #999;
        }

        .row { 
            position: relative;
            display: block;
            border-bottom: 1px solid #ccc; 

        }

        .header-row {
            display: none;
        }
        
        .cell { 
            display: block;

            border: none;
            position: relative;
            height: 45px;
            line-height: 45px;
            text-align: left;
        }

        .primary:after {
            content: "";
            display: block;
            position: absolute;
            right:20px;
            top:18px;
            z-index: 2;
            width: 0; 
            height: 0; 
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent; 
            border-right:10px solid #ccc;

        }

        .cell:nth-of-type(n+2) { 
            display: none; 
        }


        input[type="radio"],
        input[type="checkbox"] {
            display: block;
            position: absolute;
            z-index: 1;
            width: 99%;
            height: 100%;
            opacity: 0;
        }
    
    input[type="radio"]:checked,
        input[type="checkbox"]:checked {
          z-index: -1;
        }

        input[type="radio"]:checked ~ .cell,
        input[type="checkbox"]:checked ~ .cell {
            display: block;

            border-bottom: 1px solid #eee; 
        }

        input[type="radio"]:checked ~ .cell:nth-of-type(n+2),
        input[type="checkbox"]:checked ~ .cell:nth-of-type(n+2) {
            
            background: #e0e0e0;
        }

        input[type="radio"]:checked ~ .cell:nth-of-type(n+2):before,
        input[type="checkbox"]:checked ~ .cell:nth-of-type(n+2):before {
            content: attr(data-label);

            display: inline-block;
            width: 60px;
            background: #999;
            border-radius: 10px;
            height: 20px;
            margin-right: 10px;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            color: white;

        }

        input[type="radio"]:checked ~ .primary,
        input[type="checkbox"]:checked ~ .primary  {
            border-bottom: 2px solid #999;
        }

        input[type="radio"]:checked ~ .primary:after,
        input[type="checkbox"]:checked ~ .primary:after {
            position: absolute;
            right:18px;
            top:22px;
            border-right: 10px solid transparent;
            border-left: 10px solid transparent; 
            border-top:10px solid #ccc;
            z-index: 2;
        }
    }
</style>

<div class="page">
<div id="table">
    <div class="header-row row">
    <span class="cell primary">Vehcile</span>
    <span class="cell">Exterior</span>
     <span class="cell">Interior</span>
    <span class="cell">Engine</span>
    <span class="cell">Trans</span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru WRX</span>
    <span class="cell" data-label="Exterior">World Rally Blue</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.5L H4 Turbo</span>
    <span class="cell" data-label="Trans"><a href="">5 Speed</a></span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru WRX STI</span>
    <span class="cell" data-label="Exterior">Crystal Black Silica</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.5L H4 Turbo</span>
     <span class="cell" data-label="Trans">6 Speed</span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru BRZ</span>
    <span class="cell" data-label="Exterior">Dark Grey Metallic</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.0L H4</span>
     <span class="cell" data-label="Trans">6 Speed</span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru Legacy</span>
    <span class="cell" data-label="Exterior">Satin White Pearl</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.5L H4</span>
     <span class="cell" data-label="Trans">Auto</span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru Legacy</span>
    <span class="cell" data-label="Exterior">Twilight Blue Metallic</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.5L H4</span>
     <span class="cell" data-label="Trans">Auto</span>
  </div>
  <div class="row">
    <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle">2013 Subaru Forester</span>
    <span class="cell" data-label="Exterior">Ice Silver Metallic</span>
     <span class="cell" data-label="Interior">Black</span>
     <span class="cell" data-label="Engine">2.5L H4 Turbo</span>
     <span class="cell" data-label="Trans">Auto</span>
  </div>
</div>
</div>

</body>
</html>