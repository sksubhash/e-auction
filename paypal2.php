<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="ashishbusiness@shop.com">

<!-- SPecify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="hb">
<input type="hidden" name="item_number" value="1">
<input type="hidden" name="amount" value="1">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="http://www.onlinetuting.com/myshop/paypal_success.php" />
<input type="hidden" name="cancel_return" value="http://www.onlinetuting.com/myshop/paypal_cancel.php" />

<!-- Display the payment button. -->
  <input type="image"
    src="paypal.png"  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1" src="https://paypalobjects.com/en_US/i/scr/pixel.gif">
	
</form>	
