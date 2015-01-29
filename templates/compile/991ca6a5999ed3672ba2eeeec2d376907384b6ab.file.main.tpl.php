<?php /* Smarty version Smarty-3.1.11, created on 2015-01-28 09:30:15
         compiled from "/var/www/telcell/templates/main/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84814912154c8ac2734aeb6-48947204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '991ca6a5999ed3672ba2eeeec2d376907384b6ab' => 
    array (
      0 => '/var/www/telcell/templates/main/main.tpl',
      1 => 1422437327,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84814912154c8ac2734aeb6-48947204',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ns' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54c8ac27a45675_28678511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c8ac27a45675_28678511')) {function content_54c8ac27a45675_28678511($_smarty_tpl) {?><?php if (!is_callable('smarty_function_nest')) include '/var/www/telcell/classes/lib/smarty/plugins/function.nest.php';
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['TEMPLATE_DIR']->value)."/main/util/headerControls.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </head>    
    <body>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['TEMPLATE_DIR']->value)."/main/util/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
       
        <?php echo smarty_function_nest(array('ns'=>'content'),$_smarty_tpl);?>
                        
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['TEMPLATE_DIR']->value)."/main/util/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <input type="hidden" id="initialLoad" name="initialLoad" value="main" />
        <input type="hidden" id="contentLoad" value="<?php echo $_smarty_tpl->tpl_vars['ns']->value['contentLoad'];?>
" />	
    </body>


</html><?php }} ?>