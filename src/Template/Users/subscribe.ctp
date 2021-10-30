<?php $payer_email= $this->request->getSession()->read('Auth.User.email');
      $payer_id= $this->request->getSession()->read('Auth.User.id');
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GUH9RPFFVZ9ZJ">
<input type="hidden" name="custom" value="<?php echo $payer_id; ?>"/>
<table>
<tr><td><input type="hidden" name="on0" value="Premium membership">Premium membership</td></tr><tr><td><select name="os0">
	<option value="ITH">ITH : $9.99 USD - monthly</option>
</select> </td></tr>
</table>
<input type="hidden" name="cancel_return" value="http://inthehousemusic.com/users/cancel">
<input type="hidden" name="notify_url" value="http://inthehousemusic.com/users/success">
<input type="hidden" name="return" value="http://inthehousemusic.com/users/success">
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

