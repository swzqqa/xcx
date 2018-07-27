<!-- $Id: shop_config.htm 16865 2009-12-10 06:05:32Z sxc_shop $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,../js/region.js')); ?>
<style>
    .td_b_r{
        border-bottom:1px solid #dddddd;
        border-right:1px solid #dddddd;
        height: 35px;
    }
    .td_b{
        border-bottom:1px solid #dddddd;
        height: 35px;
    }
    .td_add{
        background-color: #f3fff6;
        height: 35px;
    }
    /* css注释：只对table td标签设置红色边框样式 */
</style>
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <?php $_from = $this->_var['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');$this->_foreach['bar_group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bar_group']['total'] > 0):
    foreach ($_from AS $this->_var['group']):
        $this->_foreach['bar_group']['iteration']++;
?><span class="<?php if ($this->_foreach['bar_group']['iteration'] == 1): ?>tab-front<?php else: ?>tab-back<?php endif; ?>" id="<?php echo $this->_var['group']['code']; ?>-tab"><?php echo $this->_var['group']['name']; ?></span><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </p>
    </div>
    <!-- tab body -->
    <div id="tabbody-div">
        <?php $_from = $this->_var['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');$this->_foreach['body_group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['body_group']['total'] > 0):
    foreach ($_from AS $this->_var['group']):
        $this->_foreach['body_group']['iteration']++;
?>
        <table width="100%" id="<?php echo $this->_var['group']['code']; ?>-table" <?php if ($this->_foreach['body_group']['iteration'] != 1): ?>style="display:none"<?php endif; ?>>
        <?php $_from = $this->_var['group']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'items');$this->_foreach['group_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['group_items']['total'] > 0):
    foreach ($_from AS $this->_var['items']):
        $this->_foreach['group_items']['iteration']++;
?>
        <tr><td>
            <div style="width:100%;">
                <form action=<?php echo $this->_var['items']['submit']; ?> method="post" enctype="multipart/form-data">
                    <table cellspacing="0px" width="100%"  style ="border-collapse:collapse">
                      
                       
                        <?php $_from = $this->_var['items']['vars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'param');$this->_foreach['group_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['group_items']['total'] > 0):
    foreach ($_from AS $this->_var['param']):
        $this->_foreach['group_items']['iteration']++;
?>
                        <tr>
                            <th width="20%" style="padding-right: 5%" align="right"><?php echo $this->_var['param']['name']; ?>：</th>
                            <td height="45px">
                                <?php if ($this->_var['param']['type'] == file): ?>
                                <input type="<?php echo $this->_var['param']['type']; ?>" style="width:200px;line-height:30px;" name="value[<?php echo $this->_var['param']['code']; ?>]" value="<?php echo $this->_var['param']['value']; ?>"/>
                                <?php elseif ($this->_var['param']['type'] == radio): ?>
                                <input type="<?php echo $this->_var['param']['type']; ?>"  name="value[<?php echo $this->_var['param']['code']; ?>]" value="1" <?php if ($this->_var['param']['value'] == 1): ?>checked="cheked"<?php endif; ?>/>是
                                <input type="<?php echo $this->_var['param']['type']; ?>"  name="value[<?php echo $this->_var['param']['code']; ?>]" value="0" <?php if ($this->_var['param']['value'] == 0): ?>checked="cheked"<?php endif; ?>/>否
                                <?php else: ?>
                                <input type="<?php echo $this->_var['param']['type']; ?>" style="padding-left: 5px;width:98%;height:30px;border-radius: 2px;border: 1px solid #dddddd" name="value[<?php echo $this->_var['param']['code']; ?>]" value="<?php echo $this->_var['param']['value']; ?>"/>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <tr style="display:none">
                            <th height="15px"></th>
                            <td><input type="text" name="code" value="<?php echo $this->_var['items']['code']; ?>" ></td>
                        </tr>
                        <tr>
                            <th width="20%"></th>
                            <td align="right"><input type="submit" name="submit" class="qued"></td>
                        <tr>
                    </table>
                </form>
            </div>
            </br></br>
        </td></tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'tab.js,validator.js')); ?>

<script language="JavaScript">
    region.isAdmin = true;
    onload = function()
    {
        // 开始检查订单
        startCheckOrder();
    }
    var ReWriteSelected = null;
    var ReWriteRadiobox = document.getElementsByName("value[209]");

    for (var i=0; i<ReWriteRadiobox.length; i++)
    {
        if (ReWriteRadiobox[i].checked)
        {
            ReWriteSelected = ReWriteRadiobox[i];
        }
    }

    function ReWriterConfirm(sender)
    {
        if (sender == ReWriteSelected) return true;
        var res = true;
        if (sender != ReWriteRadiobox[0]) {
            var res = confirm('<?php echo $this->_var['rewrite_confirm']; ?>');
        }

        if (res==false)
        {
            ReWriteSelected.checked = true;
        }
        else
        {
            ReWriteSelected = sender;
        }
        return res;
    }
</script>
<script language="JavaScript">
    <!--
    onload = function()
    {
        // 开始检查订单
        startCheckOrder();
    }
    function check_del()
    {
        if (confirm('<?php echo $this->_var['lang']['trash_img_confirm']; ?>'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 安装Flash样式模板
     */
    function setupFlashTpl(tpl, obj)
    {
        window.current_tpl_obj = obj;
        if (confirm(setupConfirm))
        {
            Ajax.call('flashplay.php?is_ajax=1&act=install', 'flashtpl=' + tpl, setupFlashTplResponse, 'GET', 'JSON');
        }
    }

    function setupFlashTplResponse(result)
    {
        if (result.message.length > 0)
        {
            alert(result.message);
        }

        if (result.error == 0)
        {
            var tmp_obj = window.current_tpl_obj.parentNode.parentNode.previousSibling;
            while (tmp_obj.nodeName.toLowerCase() != 'tr')
            {
                tmp_obj = tmp_obj.previousSibling;
            }
            tmp_obj = tmp_obj.getElementsByTagName('center');
            tmp_obj[0].appendChild(document.getElementById('current_theme'));
        }

    }
    //-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>