<!-- BEGIN: main -->
<form role="form" action="" method="post" name="formregister" enctype="multipart/form-data" onsubmit="" >
  <div class="form-group">
		<h2>Đăng ký gia sư</h2>
		 <div class="form-group">
		 	<label>Tên người đăng ký</label>
			<input name="namegs" id="name" type="text" class="form-control" placeholder="Tên người đăng ký" >
		 </div>
		<div class="form-group">
			<label>Ngày/Tháng/Năm sinh</label>
			<input name="datebirth" id="datebirth" type="text" class="form-control" placeholder="Ngày tháng năm sinh">
		</div>
		<div class="form-group">
			<label>Nơi công tác hiện tại</label>
			<input name="workplace" id="workplace" type="text" class="form-control" placeholder="Nơi công tác hiện tại">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input name="email" id="mail" type="text" class="form-control" placeholder="Email">
		</div>
		<div class="form-group">
			<label>Số điện thoại</label>
			<input name="phonenumber" id="phone" type="text" class="form-control" placeholder="Số điện thoại">
		</div>
		<div class="form-group">
			<label>Môn đăng ký dạy</label>
			<input name="subregister" id="subregister" type="text" class="form-control" placeholder="Môn đăng ký dạy" >
		</div>
		<div class="form-group">
			<label>Số buổi/tuần</label>
			<input name="numsession" id="numsession" type="text" class="form-control" placeholder="Số buổi/tuần" >
		</div>
		<div class="form-group">
			<label>Yêu cầu (yêu cầu thêm, dạy buổi sáng/chiều/tối)</label>
			<textarea name="requirements" id="comment" class="form-control" placeholder="Yêu cầu gia sư"></textarea>
		</div>
		<label>Ảnh đại diện</label>
		<input type="file" name="avartar" id="avartar" />
		<button type="submit" class="btn btn-default navbar-btn">Đăng ký</button>
		<div id="msg" class="message"></div>
	</div>
</form>
<!-- END: main -->