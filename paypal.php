<?php
  
?>

<table>
    <tr>
        <th>ID:</th>
        <th>Name:</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
        <th>Product Total Price</th>
    </tr>
    
    <tr>
        <td>1</td>
        <td>ABC</td>
        <td>30</td>
        <td>2</td>
        <td>60</td>
    </tr>
    <tr>
        <td>1</td>
        <td>ABC</td>
        <td>30</td>
        <td>2</td>
        <td>60</td>
    </tr>
</table>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
   <input type="hidden" name="cmd" value="_cart">
   <input type="hidden" name="upload" value="1">
   <input type="hidden" name="business" value="ashishbusiness@shop.com">
   
   <input type="hidden" name="item_name_1" value="Shirt">
   <input type="hidden" name="amount_1" value="1">
   <input type="hidden" name="quantity_1" value="1">
     

     
     
       <input type="submit" name="pay" value="Paypal">
</form>
