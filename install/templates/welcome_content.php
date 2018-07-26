<script type="text/javascript" src="./js/welcome.js"></script>
<form method="post">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
<td valign="top" class="kzs"><h2 class="passmail-title main-bg-color">用户协议</h2><div id="wrapper">
	
  <iframe id="iframe" src="templates/license_<?php echo $installer_lang;?>.htm" width="730" height="500"></iframe>
</div></td>

</tr>
<tr>
<td align="center" id="wks"><input type="checkbox" id="js-agree" class="p" />
  <label for="js-agree"> <?php echo $lang['agree_license'];?></label>
  <span><input class="button" type="submit" id="js-submit" class="p" value="<?php echo $lang['next_step'];?><?php echo $lang['setup_environment'];?>" /></span>
</td>
<td>&nbsp;</td>
</tr>
</table>
<input name="ucapi" type="hidden" value="<?php echo $ucapi; ?>" />
<input name="ucfounderpw" type="hidden" value="<?php echo $ucfounderpw; ?>" />
</form>