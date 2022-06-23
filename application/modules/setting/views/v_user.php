<div class="row">
	<div class="col-md-6">
		<?php
			if( $this->session->userdata('nama_role') == 'Administrator' ){
		?>
				<button type="button" class="btn btn-primary btn-bordered-primary" onclick="add_data()">Add</button>
		<?php
			}
		?>
		<button type="button" class="btn btn-success btn-bordered-success" onclick="reload_menu()">Reload</button>
	</div>
	<div class="col-md-6">
		<h2 class="h5 no-margin-bottom" style="text-align: right; color: silver;"><i><?= $judul ?></i></h2>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="card-box">
			<div class="table-responsive">
			    <table id="table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead>
			            <tr>
			                <th style="width:10px;">No.</th>
			                <th>Username</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Phone</th>
			                <th>Access</th>
			                <th style="width:35px;">Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="#" id="form" class="form-horizontal">
	            <div class="modal-body form" style="margin-left: 10px; margin-right: 10px;">
	                <div class="form-body">
	                    <div class="form-group row">
	                    	<div class="col-md-6">
	                            <label>Username<span class="text-danger"> *</span></label>
								<input type="text" name="user_name" id="user_name" placeholder="username" class="form-control">
								<input type="hidden" name="idxx_user" id="idxx_user">
							</div>
							<div class="col-md-6">
	                            <label>Name<span class="text-danger"> *</span></label>
								<input type="text" name="nama_user" id="nama_user" placeholder="name" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
	                            <label>Password<span class="text-danger"> *</span></label>
								<input type="password" name="pass_word" id="pass_word" placeholder="password" class="form-control">
							</div>
							<div class="col-md-6">
	                            <label>Email<span class="text-danger"></span></label>
								<input type="text" name="mail_user" id="mail_user" placeholder="email" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
	                            <label>Phone<span class="text-danger"></span></label>
								<input type="text" name="telp_user" id="telp_user" placeholder="phone" class="form-control">
							</div>
							<div class="col-md-6">
	                            <label>Access<span class="text-danger"> *</span></label>
								<input type="text" name="idxx_role" id="idxx_role" class="select2-input">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
			                    <img class="imgx_pasx" id="uploadPreview" src="<?= base_url(); ?>assets/images/no-image.png" style="height: 180px; width: 100%;"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<input id="imgx_user" type="file" name="imgx_user" onchange="PreviewImage();" accept="image/jpeg, image/png, image/jpg"/>
							</div>
						</div>
	                </div>
	            </div>
	            <div class="modal-footer">
					<input type="submit" class="btn btn-primary btn-save" value="Save">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	            </div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$('#idxx_role').select2({
	    width: '100%',
	    placeholder: '- - - Access - - -',
	    ajax: {
	        url: "<?= site_url('setting/user/get_role') ?>",
	        dataType: 'json',
	        quietMillis: 100,
	        data: function (term, page) {
	            return {
	                q: term,
	                page: page
	            };
	        },
	        results: function (data, page) {
	            var more = (page * 20) < data.total;
	            return {results: data.data, more: more};
	        }
	    },
	    formatResult: function(data){
	        var markup  = data.nama;

	        return markup;
	    },
	    formatSelection: function(data){
    		if( data.id == '' ){
    			$('#idxx_role').val('');
				$('#s2id_idxx_role a .select2-chosen').html('- - - Access - - -');
    		}

    		var markup  = data.nama;

	        return markup;
	    }
	});

	function reload_menu(){
		get_url_1('setting/User');
	}
	
	function add_data(){
		$('#modal_form').modal('show');
    	$('.modal-title').text('Add');
    	reset_form();
	}

	list_data();
	function list_data(){
		var table = $('#table').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "bDestroy": true,
	        "order": [],
	        "ajax": {
	        	"url": "<?= site_url('setting/user/list_data')?>",
	            "type": "POST",
	        },
	        "columnDefs": [
		        { 
		            "targets": [ 0, 6 ],
		            "className": "text-center",
		            "orderable": false
		        },
	        ],
	    });
	}

	function delete_data(idx){

		Swal.fire({
			title: 'Are you sure?',
			text: "data cannot be returned!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, clear data!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
		            url : "<?= site_url('setting/user/delete_data')?>/" + idx,
		            type: "POST",
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Deleted!',
							'data deleted successfully.',
							'success'
						);
		                list_data();
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                Swal.fire(
							'Deleted!',
							'data failed to delete.',
							'error'
						);
		            }
		        });
			}
		});
	}

	$("#form").on('submit',(function(e) {
        e.preventDefault();

		if( $('#user_name').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Username cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#nama_user').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Name cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#idxx_user').val() == '' ){
			if( $('#pass_word').val() == '' ){
				Swal.fire(
				'Required to fill!',
					'Password cannot be empty.',
					'warning'
				);
				return;
			}
		}

		if( $('#idxx_role').val() == '' || $('#idxx_role').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Access cannot be empty.',
				'warning'
			);
			return;
		}

		Swal.fire({
			title: 'Are you sure?',
			text: "data will be saved to database!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, save data!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
		            url : "<?= site_url('setting/user/save_data') ?>",
		            type: "POST",
		            dataType: "JSON",
		            data: new FormData(this),
		            contentType: false,
		            cache: false,
		            processData: false,
		            success: function(data){
		            	Swal.fire(
							'Saved!',
							'data saved successfully.',
							'success'
						);

						// $('#modal_form').modal('hide');
						if( $('#idxx_user').val() == '' ){
							$(".btn-save").attr("disabled", true);
						}else{
							$(".btn-save").attr("disabled", false);
						}
		                list_data();
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                Swal.fire(
							'Saved!',
							'data failed to save.',
							'error'
						);
		            }
		        });
			}
		});
	}));

	function reset_form(){
		$('#idxx_user').val('');
		$('#form')[0].reset();
		$("#user_name").attr("readonly", false);
		$('#idxx_role').val('');
		$('#s2id_idxx_role a .select2-chosen').html('- - - Access - - -');
		document.getElementById("uploadPreview").src = '<?= base_url(); ?>assets/images/no-image.png';
		$(".btn-save").attr("disabled", false);
	}

	function edit_data(idx){

		reset_form();

		$.ajax({
	        url : "<?php echo site_url('setting/user/edit_data/')?>" + idx,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){

	            $('#idxx_user').val(data.idxx_user);
	            $('#user_name').val(data.user_name);
	            $('#nama_user').val(data.nama_user);
	            $('#pass_word').val(data.pass_word);
	            $('#mail_user').val(data.mail_user);
	            $('#telp_user').val(data.telp_user);
	            $('#idxx_role').val(data.idxx_role);
	            $('#s2id_idxx_role a .select2-chosen').html(data.nama_role);
	            $("#user_name").attr("readonly", true);

	            if( data['imgx_user'] != '' && data['imgx_user'] != null ){
	            	document.getElementById("uploadPreview").src = '<?= base_url(); ?>' + data['imgx_user'];
	            }

	            $('#modal_form').modal('show');
	            $('.modal-title').text('Edit');

	        },
	        error: function (jqXHR, textStatus, errorThrown){
	            Swal.fire(
					'Error!',
					'data failed to retrieve.',
					'error'
				);
	        }
	    });
	}

	function PreviewImage() {
	    var oFReader = new FileReader();
	    oFReader.readAsDataURL(document.getElementById("imgx_user").files[0]);

	    oFReader.onload = function (oFREvent) {
	        document.getElementById("uploadPreview").src = oFREvent.target.result;
	    };
	}

</script>