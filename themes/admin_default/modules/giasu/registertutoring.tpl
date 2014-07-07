<!-- BEGIN: main -->
<!-- BEGIN: view -->
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php" method="get">
	<input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
	<input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
	<input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
	<strong>{LANG.search_title}</strong>&nbsp;<input class="form-control" type="text" value="{Q}" name="q" maxlength="255" />&nbsp;
	<input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
</form>
<br>

<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{LANG.weight}</th>
					<th>{LANG.namegs}</th>
					<th>{LANG.workplace}</th>
					<th>{LANG.email}</th>
					<th>{LANG.subregister}</th>
					<th>{LANG.begindate}</th>
					<th>{LANG.enddate}</th>
					<th>{LANG.numsession}</th>
					<th>{LANG.phonenumber}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td>
						<select class="form-control" id="id_weight_{VIEW.id}" onchange="nv_change_weight('{VIEW.id}');">
						<!-- BEGIN: weight_loop -->
							<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
						<!-- END: weight_loop -->
					</select>
				</td>
					<td> {VIEW.namegs} </td>
					<td> {VIEW.workplace} </td>
					<td> {VIEW.email} </td>
					<td> {VIEW.subregister} </td>
					<td> {VIEW.begindate} </td>
					<td> {VIEW.enddate} </td>
					<td> {VIEW.numsession} </td>
					<td> {VIEW.phonenumber} </td>
					<td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->

<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<input type="hidden" name="id" value="{ROW.id}" />
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<tbody>
				<tr>
					<td> {LANG.namegs} </td>
					<td><input class="form-control" type="text" name="namegs" value="{ROW.namegs}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
				</tr>
				<tr>
					<td> {LANG.alias} </td>
					<td><input class="form-control" type="text" name="alias" value="{ROW.alias}" id="id_alias" />&nbsp;<i class="fa fa-refresh fa-lg icon-pointer" onclick="nv_get_alias('id_alias');">&nbsp;</i></td>
				</tr>
				<tr>
					<td> {LANG.datebirth} </td>
					<td><input class="form-control" type="text" name="datebirth" value="{ROW.datebirth}" /></td>
				</tr>
				<tr>
					<td> {LANG.workplace} </td>
					<td><input class="form-control" type="text" name="workplace" value="{ROW.workplace}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
				</tr>
				<tr>
					<td> {LANG.email} </td>
					<td><input class="form-control" type="email" name="email" value="{ROW.email}" oninvalid="setCustomValidity( nv_email )" oninput="setCustomValidity('')" required="required" /></td>
				</tr>
				<tr>
					<td> {LANG.subregister} </td>
					<td><input class="form-control" type="text" name="subregister" value="{ROW.subregister}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
				</tr>
				<tr>
					<td> {LANG.begindate} </td>
					<td><input class="form-control" type="text" pattern="^[0-9]{2,2}$" name="begindate_hour" value="{ROW.begindate_hour}" >:<input class="form-control" type="text" pattern="^[0-9]{2,2}$" name="begindate_min" value="{ROW.begindate_min}" >&nbsp;<input class="form-control" type="text" name="begindate" value="{ROW.begindate}" id="begindate" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /></td>
				</tr>
				<tr>
					<td> {LANG.enddate} </td>
					<td><input class="form-control" type="text" pattern="^[0-9]{2,2}$" name="enddate_hour" value="{ROW.enddate_hour}" >:<input class="form-control" type="text" pattern="^[0-9]{2,2}$" name="enddate_min" value="{ROW.enddate_min}" >&nbsp;<input class="form-control" type="text" name="enddate" value="{ROW.enddate}" id="enddate" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /></td>
				</tr>
				<tr>
					<td> {LANG.numsession} </td>
					<td><input class="form-control" type="text" name="numsession" value="{ROW.numsession}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" /></td>
				</tr>
				<tr>
					<td> {LANG.phonenumber} </td>
					<td><input class="form-control" type="text" name="phonenumber" value="{ROW.phonenumber}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
				</tr>
				<tr>
					<td> {LANG.avartar} </td>
					<td><input class="form-control" type="text" name="avartar" value="{ROW.avartar}" id="id_avartar" />&nbsp;<button type="button" class="btn btn-info" id="img_avartar"><i class="fa fa-folder-open-o">&nbsp;</i> Browse server </button></td>
				</tr>
				<tr>
					<td> {LANG.requirements} </td>
					<td>{ROW.requirements}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
//<![CDATA[
	function nv_get_alias(id) {
		var title = strip_tags( $("[name='namegs']").val() );
		if (title != '') {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registertutoring&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
				$("#"+id).val( strip_tags( res ) );
			});
		}
		return false;
	}
	$("#begindate,#enddate").datepicker({
		showOn : "both",
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		buttonImage : nv_siteroot + "images/calendar.gif",
		buttonImageOnly : true
	});

	$("#img_avartar").click(function() {
		var area = "id_avartar";
		var path = "{NV_UPLOADS_DIR}/{MODULE_NAME}";
		var currentpath = "{NV_UPLOADS_DIR}/{MODULE_NAME}";
		var type = "image";
		nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});

	function nv_change_weight(id) {
		var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
		var new_vid = $('#id_weight_' + id).val();
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registertutoring&nocache=' + new Date().getTime(), 'ajax_action=1&id=' + id + '&new_vid=' + new_vid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] != 'OK') {
				alert(nv_is_change_act_confirm[2]);
			}
			clearTimeout(nv_timer);
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registertutoring';
			return;
		});
		return;
	}


//]]>
</script>
<!-- END: main -->