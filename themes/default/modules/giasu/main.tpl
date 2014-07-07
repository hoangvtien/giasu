<!-- BEGIN: main -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td>STT</td>
						<td>Họ và tên</td>
						<td>Ngày sinh</td>
						<td>Nơi công tác</td>
						<td>Email</td>
						<td>Dạy môn</td>
						<td>Số buổi / tuần</td>
						<td>Số điện thoại</td>
					</tr>
				</thead>
				<tbody>
				<!-- BEGIN: data -->			
					<tr>
						<td>{DATA.weight}</td>
						<td><a href="{DATA1.link}">{DATA.namegs}</a></td>
						<td>{DATA.datebirth}</td>
						<td>{DATA.workplace}</td>
						<td>{DATA.email}</td>
						<td>{DATA.subregister}</td>
						<td>{DATA.numsession}</td>
						<td>{DATA.phonenumber}</td>
					</tr>
				<!-- END: data -->
						<tr>
							<td colspan="8"><a href="{URL_ADD}" class="btn btn-default" style="color: #000;">{LANG.tutoring}</a></td>
						</tr>	
				</tbody>
			</table>
		</div>	
	</div>
</div>	
<!-- END: main -->