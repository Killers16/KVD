<!DOCTYPE html>
<html>
    <head>
        <title>Kvalifikācijas darbs </title>
        <link type="text/css" rel="stylesheet" href="CSS/styles.css"/>
        <script type="text/javascript" src="JS\script.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      </head>
<body>
<div class="main">
    <div class="text">JAK  Audzēkņu uzskaites sistēmu</div>
</div>
<hr>


<table>
    <tr> 
        <th>Nr.</th>
        <th>Vārds</th>
        <th>Uzvārds</th>
        <th>Kurss</th>
        <th>Profesija</th>
        <th>Audzinatāja</th>
        <th>Iestāšanas Datums</th>
        <th>Izstāšanas Datums</th>
     </tr>
      
     <tr>   
     <td>Nr.</td>
     <td>Vārds</td>
     <td>Uzvārds</td>
     <td>Kurss</td>
     <td>Profesija</td>
     <td>Audzinatāja</td>
     <td>Iestāšanas Datums</td>
     <td>Izstāšanas Datums</th>
     </tr> 
</table>
<form class="container">
    <p>SKU</p>
    <input id="sku">
    <button type="button" onclick="TextValidation_sku()">Submit</button>
    <p id="output_sku"></p>
    </form>
    <form class="container">
    <p>Name</p>
    <input id="name">
    <button type="button" onclick="TextValidation_name()">Submit</button>
    <p id="output_name"></p>
    </form>
    <form class="container">
    <p>Price</p>
    <input id="price">
    <button type="button" onclick="TextValidation_price()">Submit</button>
    <p id="output_price"></p>
    </form>
<select  class="product_type_selector">
    <option value="" id="">Choose option</option>
    <option value="s" id="s">Size</option>
    <option value="h" id="h">HWI</option>
    <option value="w" id="w">Weight</option>
</select>
<div class="none_div" id="one" style="display: none;">
    <label for="testing">Size:</label> 
    <input type="text" id="texting" name="box" />
    <input type="submit" value="Submit">
</div>
<div class="none_div" id="two" style="display: none;">
    <label for="texting">Weight</label> 
    <input type="text" id="texting" name="box" />
    <label for="texting">Width</label> 
    <input type="text" id="texting" name="box" />
    <label for="texting">Lenght</label> 
    <input type="text" id="texting" name="box" />
    <input type="submit" value="Submit">
</div>
<div class="none_div" id="three" style="display: none;">
    <label for="texting">Weight</label> 
    <input type="text" id="texting" name="box" />
    <input type="submit" value="Submit">
</div>
</body>
</html>