<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">body{font: 12px Microsoft Yahei, "sans-serif", "Arial", "Verdana";background:#459AF7;margin: 0px;padding: 0px;}::-webkit-scrollbar{width:0}.menu_list{width:195px;margin:0 auto}.menu_head{height:47px;line-height:47px;padding-left:38px;font-size:14px;color:#fff;position:relative;margin:0}.menu_list .current{color:#3b8cff;background:#fff url(./images/xz.png) center right no-repeat}.menu_body{line-height:38px;margin:9px;border-radius:5px;background:#fff}.menu_body a{display:block;height:38px;line-height:38px;padding-left:38px;color:#777;text-decoration:none;border-top:1px solid #f5f5f5}.menu_body a:first-child{border:0}.menu_body a:hover{text-decoration:none}#nobody{position:fixed;bottom:0;width:100%;background:#2F89EF}#nobody a{float:left;width:25%;padding:9px 0;text-align:center}</style>
</head>
	<div id="log"><img src="images/logo.gif"></div>

<div id="firstpane" class="menu_list">

	<?php $_from = $this->_var['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'menu');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['menu']):
?>
<li class="menu_head" ><?php echo $this->_var['menu']['label']; ?></li>

<?php if ($this->_var['menu']['action']): ?>

<?php else: ?>
<div class="menu_body" style="display:none" >
    <?php if ($this->_var['menu']['children']): ?>
    <?php $_from = $this->_var['menu']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
    <a href="<?php echo $this->_var['child']['action']; ?>" target="main-frame"><?php echo $this->_var['child']['label']; ?></a>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endif; ?>
 	</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
	<div id="nobody">

       <a href="privilege.php?act=modif" target="main-frame"><img src="images/gr.png"></a>
              <a href="index.php?act=clear_cache" target="main-frame" class="fix-submenu"><img src="images/hc.png"></a>
  <a href="javascript:window.top.frames['main-frame'].document.location.reload();window.top.frames['header-frame'].document.location.reload()"><img src="images/sx.png"></a>

  <a href="privilege.php?act=logout" target="_top" class="fix-submenu"><img src="images/tc.png"></a>
</div>

<script src="http://mat1.gtimg.com/libs/jquery/1.12.0/jquery.js"></script>
<script>
$(document).ready(function(){
	$("#firstpane li.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});

});
</script>
</body>
</html>