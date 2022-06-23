<div class="row">
	<div class="col-md-6">
		<button type="button" class="btn btn-primary btn-bordered-primary" onclick="add_data()">Add</button>
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
			                <th>Group</th>
			                <th>Description</th>
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
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body form" style="margin-left: 10px; margin-right: 10px;">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Group<span class="text-danger"> *</span></label>
								<input type="text" name="nama_role" id="nama_role" placeholder="group" class="form-control">
								<input type="hidden" name="idxx_role" id="idxx_role">
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-md-12">
	                            <label>Description</label>
								<input type="text" name="desc_role" id="desc_role" placeholder="description" class="form-control">
							</div>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="save_data()" class="btn btn-primary btn-save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	function reload_menu(){
		get_url_1('setting/group');
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
	        	"url": "<?= site_url('setting/group/list_data')?>",
	            "type": "POST",
	        },
	        "columnDefs": [
		        { 
		            "targets": [ 0, 3 ],
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
		            url : "<?= site_url('setting/group/delete_data')?>/" + idx,
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

	function save_data(){

		if( $('#nama_role').val() == '' ){
			Swal.fire(
				'Required to fill!',
				'Group cannot be empty.',
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
		            url : "<?= site_url('setting/group/save_data') ?>",
		            type: "POST",
		            data: $('#form').serialize(),
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Saved!',
							'data saved successfully.',
							'success'
						);

						// $('#modal_form').modal('hide');
						if( $('#idxx_role').val() == '' ){
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
	}

	function reset_form(){
		$('#idxx_role').val('');
		$('#nama_role').val('');
		$('#desc_role').val('');
		$(".btn-save").attr("disabled", false);
	}

	function edit_data(idx){

		reset_form();

		$.ajax({
	        url : "<?php echo site_url('setting/group/edit_data/')?>" + idx,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){

	            $('#idxx_role').val(data.idxx_role);
	            $('#nama_role').val(data.nama_role);
	            $('#desc_role').val(data.desc_role);

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

</script>