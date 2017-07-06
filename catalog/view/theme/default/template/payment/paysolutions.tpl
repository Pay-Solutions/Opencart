<form action="<?php echo $action; ?>" method="post" id="payment">

<input type="Hidden" Name="payso" value="payso"/>
<input Type="Hidden" Name="customeremail" value="<?=$youraccount?>"/>
<input Type="Hidden" Name="merchantid" value="<?php print_r($this->data['paysolutions_transaction']); ?>"/>
<input Type="Hidden" Name="refno" value="<?=$invoice?>"/>
<input Type="Hidden" Name="productdetail" value="<?=$description?>"/>
<input Type="Hidden" Name="total" value="<?=$price?>"/>
<input Type="Hidden" Name="postURL" value="<?=$postURL?>"/>


<input Type="Hidden" Name="currencyCode" value="<?=$currencyCode?>"/>

  <div class="buttons">
    <div class="right"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></div>
  </div>

</form>
