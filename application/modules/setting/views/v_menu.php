<div class="row">
	<div class="col-md-8">
		<button type="button" class="btn btn-primary btn-bordered-primary" onclick="add_data_modul()">Add Modul</button>
		<button type="button" class="btn btn-info btn-bordered-info" onclick="add_data_menu()">Add Menu</button>
		<button type="button" class="btn btn-success btn-bordered-success" onclick="reload_menu()">Reload</button>
	</div>
	<div class="col-md-4">
		<h2 class="h5 no-margin-bottom" style="text-align: right; color: silver;"><i><?= $judul ?></i></h2>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="card-box">
	        <div class="form-group row">
	        	<table id="table_akses" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead>
			            <tr>
			                <th>Menu</th>
			            </tr>
			        </thead>
			        <tbody>
			        </tbody>
			    </table>
	        </div>
		</div>
	</div>
</div>

<div id="modal_form_modul" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-modul" id="myExtraLargeModalLabel">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body form" style="margin-left: 10px; margin-right: 10px;">
                <form action="#" id="form_modul" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Nama Modul<span class="text-danger"> *</span></label>
								<input type="text" name="nama_mdul" id="nama_mdul" placeholder="nama modul" class="form-control">
								<input type="hidden" name="idxx_mdul" id="idxx_mdul">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Icon Modul</label>
								<input type="text" name="icon_mdul" id="icon_mdul" placeholder="icon fa" class="form-control">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-3">
	                            <label>Position Modul</label>
								<input type="text" name="posx_mdul" id="posx_mdul" placeholder="position" class="form-control">
							</div>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="save_data_modul()" class="btn btn-primary btn-save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_form_menu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-menu" id="myExtraLargeModalLabel">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body form" style="margin-left: 10px; margin-right: 10px;">
                <form action="#" id="form_menu" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Nama Menu<span class="text-danger"> *</span></label>
								<input type="text" name="nama_menu" id="nama_menu" placeholder="nama menu" class="form-control">
								<input type="hidden" name="idxx_menu" id="idxx_menu">
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-md-12">
	                            <label>Modul<span class="text-danger"> *</span></label>
								<input type="text" name="idxx_mdul_accs" id="idxx_mdul_accs" class="select2-input">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Url Menu<span class="text-danger"> *</span></label>
								<input type="text" name="urlx_menu" id="urlx_menu" placeholder="url menu" class="form-control">
								<span style="color: silver; font-size: 12px;">* folder/controller</span>
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-3">
	                            <label>Position Menu</label>
								<input type="text" name="posx_menu" id="posx_menu" placeholder="position" class="form-control">
							</div>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="save_data_menu()" class="btn btn-primary btn-save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	get_modul();

	$('#idxx_mdul_accs').select2({
	    width: '100%',
	    placeholder: '- - - Modul - - -',
	    ajax: {
	        url: "<?= site_url('setting/user/get_modul') ?>",
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
    			$('#idxx_mdul_accs').val('');
				$('#s2id_idxx_mdul_accs a .select2-chosen').html('- - - Modul - - -');
    		}

    		var markup  = data.nama;

	        return markup;
	    }
	});

	function reload_menu(){
		get_url_1('setting/menu');
	}

	function get_modul(){
		$('#table_akses tbody').empty();
		$.ajax({
            url : "<?= site_url('setting/menu/get_modul')?>",
            type: "POST",
            dataType: "JSON",
            success: function(result){
            	for (var i = 0; i < result.length; i++) {
					var str = '<tr style="background-color: #86E3FC;">'+
								'<td>'+result[i]['nama_mdul']+'</td>'+
								'<td align="center" width="12%">'+
									'<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data_modul('+result[i]['idxx_mdul']+')"><i class=" mdi mdi-account-edit-outline"></i></a>&nbsp;&nbsp;'+
									'<a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data_modul('+result[i]['idxx_mdul']+')"><i class="mdi mdi-delete-forever"></i></a>'+
								'</td>'+
							'</tr>'+
							'<tr>'+
								'<td colspan="3"><div id="tbl_'+result[i]['idxx_mdul']+'"></div></td>'+
							'</tr>';

					$('#table_akses tbody').append(str);
					
					get_modul_child(result[i]['idxx_mdul']);
            	}
            }
        });
	}

	function get_modul_child(id){
		$.ajax({
            url : "<?= site_url('setting/menu/get_modul_child/')?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(resultx){
            	for (var j = 0; j < resultx.length; j++) {

            		var chkd = '';
            		if( resultx[j]['idxx'] != 0 ){
            			chkd = 'checked';
            		}

					var strx = '<table width="100%" style="background-color: #FFF; border: 2px solid #86E3FC;"><tr><td>'+
									(j+1)+'. '+resultx[j]['nama_menu']+
								'</td>'+
								'<td align="center" width="10%">'+
									'<a class="btn btn-xs btn-warning" style="height: 25px;" href="javascript:void(0)" title="Edit" onclick="edit_data_menu('+resultx[j]['idxx_menu']+')"><i class=" mdi mdi-account-edit-outline"></i></a>&nbsp;&nbsp;'+
									'<a class="btn btn-xs btn-danger" style="height: 25px;" href="javascript:void(0)" title="Hapus" onclick="delete_data_menu('+resultx[j]['idxx_menu']+')"><i class="mdi mdi-delete-forever"></i></a>'+
								'</td>'+
								'</tr></table>';

					$('#tbl_'+id).append(strx);
				}
            }
		});
	}

	function reset_form_modul(){
		$('#idxx_mdul').val('');
		$('#nama_mdul').val('');
		$('#icon_mdul').val('');
		$('#posx_mdul').val('');
		$(".btn-save").attr("disabled", false);
	}

	function reset_form_menu(){
		$('#idxx_menu').val('');
		$('#nama_menu').val('');
		$('#urlx_menu').val('');
		$('#posx_menu').val('');
		$('#idxx_mdul_accs').val('');
		$('#s2id_idxx_mdul_accs a .select2-chosen').html('- - - Modul - - -');
		$(".btn-save").attr("disabled", false);
	}

	function add_data_modul(){
		$('#modal_form_modul').modal('show');
    	$('.modal-title-modul').text('Add');
    	reset_form_modul();
	}

	function save_data_modul(){

		if( $('#nama_mdul').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Nama Modul cannot be empty.',
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
		            url : "<?= site_url('setting/menu/save_data_modul') ?>",
		            type: "POST",
		            data: $('#form_modul').serialize(),
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Saved!',
							'data saved successfully.',
							'success'
						);

						// $('#modal_form_modul').modal('hide');
						if( $('#idxx_mdul').val() == '' ){
							$(".btn-save").attr("disabled", true);
						}else{
							$(".btn-save").attr("disabled", false);
						}
		                get_modul();
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
	}

	function add_data_menu(){
		$('#modal_form_menu').modal('show');
    	$('.modal-title-menu').text('Add');
    	reset_form_menu();
	}

	function save_data_menu(){

		if( $('#nama_menu').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Nama Menu cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#idxx_mdul_accs').val() == '' || $('#idxx_mdul_accs').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Modul cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#urlx_menu').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Url Menu cannot be empty.',
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
		            url : "<?= site_url('setting/menu/save_data_menu') ?>",
		            type: "POST",
		            data: $('#form_menu').serialize(),
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Saved!',
							'data saved successfully.',
							'success'
						);

						// $('#modal_form_menu').modal('hide');
						if( $('#idxx_menu').val() == '' ){
							$(".btn-save").attr("disabled", true);
						}else{
							$(".btn-save").attr("disabled", false);
						}
		                get_modul();
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
	}

	function delete_data_modul(idx){

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
		            url : "<?= site_url('setting/menu/delete_data_modul')?>/" + idx,
		            type: "POST",
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Deleted!',
							'data deleted successfully.',
							'success'
						);
		                get_modul();
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

	function delete_data_menu(idx){

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
		            url : "<?= site_url('setting/menu/delete_data_menu')?>/" + idx,
		            type: "POST",
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Deleted!',
							'data deleted successfully.',
							'success'
						);
		                get_modul();
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

	function edit_data_modul(idx){

		reset_form_modul();

		$.ajax({
	        url : "<?php echo site_url('setting/menu/edit_data_modul/')?>" + idx,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){

	            $('#idxx_mdul').val(data.idxx_mdul);
	            $('#nama_mdul').val(data.nama_mdul);
	            $('#posx_mdul').val(data.posx_mdul);
	            $('#icon_mdul').val(data.icon_mdul);

	            $('#modal_form_modul').modal('show');
	            $('.modal-title-modul').text('Edit');

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

	function edit_data_menu(idx){

		reset_form_menu();

		$.ajax({
	        url : "<?php echo site_url('setting/menu/edit_data_menu/')?>" + idx,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){

	            $('#idxx_menu').val(data.idxx_menu);
	            $('#nama_menu').val(data.nama_menu);
	            $('#urlx_menu').val(data.urlx_menu);
	            $('#posx_menu').val(data.posx_menu);

	            $('#idxx_mdul_accs').val(data.idxx_mdul);
	            $('#s2id_idxx_mdul_accs a .select2-chosen').html(data.nama_mdul);

	            $('#modal_form_menu').modal('show');
	            $('.modal-title-menu').text('Edit');

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

</script>