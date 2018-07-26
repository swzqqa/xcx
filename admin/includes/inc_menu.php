<?php


if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}


$modules['01_certificate_manage']['service_market']     = 'service_market.php';
$modules['01_certificate_manage']['certificate']        = 'index.php?act=main';
$modules['01_certificate_manage']['sms_resource']     = 'index.php?act=about_us';
$modules['01_certificate_manage']['logistic_tracking']  = 'logistic_tracking.php';
$modules['02_cat_and_goods']['04_bonustype_list']       = 'bonus.php?act=list';
$modules['02_cat_and_goods']['01_goods_list']       = 'goods.php?act=list'; 
$modules['02_cat_and_goods']['03_category_list']    = 'category.php?act=list';
$modules['02_cat_and_goods']['06_goods_brand_list'] = 'brand.php?act=list';
$modules['02_cat_and_goods']['08_goods_type']       = 'goods_type.php?act=manage';
$modules['02_cat_and_goods']['11_goods_trash']      = 'goods.php?act=trash';       
$modules['02_cat_and_goods']['12_batch_pic']        = 'picture_batch.php';
$modules['04_order']['02_order_list']               = 'order.php?act=list';
$modules['04_order']['04_merge_order']              = 'order.php?act=merge';
$modules['04_order']['05_edit_order_print']         = 'order.php?act=templates';
$modules['04_order']['09_delivery_order']           = 'order.php?act=delivery_list';
$modules['04_order']['10_back_order']               = 'order.php?act=back_list';
$modules['06_stats']['report_guest']                = 'guest_stats.php?act=list';
$modules['06_stats']['report_order']                = 'order_stats.php?act=list';
$modules['06_stats']['report_sell']                 = 'sale_general.php?act=list';
$modules['06_stats']['sale_list']                   = 'sale_list.php?act=list';
$modules['06_stats']['sell_stats']                  = 'sale_order.php?act=goods_num';
$modules['06_stats']['report_users']                = 'users_order.php?act=order_num';
$modules['06_stats']['visit_buy_per']               = 'visit_sold.php?act=list';
$modules['08_members']['03_users_list']             = 'users.php?act=list';
$modules['08_members']['04_users_add']              = 'users.php?act=add';
$modules['08_members']['05_user_rank_list']         = 'user_rank.php?act=list';
$modules['11_system']['wxa_setting']        = 'wxa_setting.php?act=list';
$modules['10_priv_admin']['admin_logs']             = 'admin_logs.php?act=list';
$modules['10_priv_admin']['admin_list']             = 'privilege.php?act=list';
$modules['10_priv_admin']['admin_role']             = 'role.php?act=list';
$modules['11_system']['banner_mobile']        = 'mobile_setting.php?act=list';
$modules['11_system']['03_shipping_list']           = 'shipping.php?act=list';
$modules['11_system']['05_area_list']               = 'area_manage.php?act=list';
$modules['11_system']['sitemap']                    = 'sitemap.php';
$modules['11_system']['check_file_priv']            = 'check_file_priv.php?act=check';
$modules['11_system']['ucenter_setup']              = 'integrate.php?act=setup&code=ucenter';
$modules['13_backup']['02_db_manage']               = 'database.php?act=backup';
$modules['13_backup']['03_db_optimize']             = 'database.php?act=optimize';
$modules['13_backup']['04_sql_query']               = 'sql.php?act=main';
?>
