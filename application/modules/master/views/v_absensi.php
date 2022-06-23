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
			                <th>Karyawan</th>
			                <th>Tanggal</th>
			                <th>Jam Masuk</th>
			                <th>Jam Keluar</th>
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
	                            <label>Karyawan <i class="text-danger">*</i></label>
								<input type="text" name="idxx_user" id="idxx_user" class="select2-input">
								<input type="hidden" name="idxx_absn" id="idxx_absn">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Tanggal</label>
								<input type="text" name="tglx_absn" id="tglx_absn" placeholder="tanggal" readonly class="form-control datepicker" style="background-color: white;">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Jam Masuk</label>
								<input type="text" name="jamx_msuk" id="jamx_msuk" placeholder="00:00" readonly class="form-control" style="background-color: white;">
							</div>
						</div>
                        <div class="form-group row">
                        	<div class="col-md-12">
	                            <label>Jam Keluar</label>
								<input type="text" name="jamx_klar" id="jamx_klar" placeholder="00:00" readonly class="form-control" style="background-color: white;">
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

	$('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "bottom",
        todayBtn: true,
        todayHighlight: true,  
    });

    $('#jamx_msuk, #jamx_klar').datetimepicker({
        format: "HH:mm",
        use24hours: true,
        icons: {
            date: "fa fa-clock-o",
        }
    }).on('changeDate', function(){
        $(this).datetimepicker('hide');
    });

	$('#idxx_user').select2({
	    width: '100%',
	    placeholder: '- - - Karyawan - - -',
	    ajax: {
	        url: "<?= site_url('master/absensi/get_user') ?>",
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
	        var markup = data.nama;
	        return markup;
	    },
	    formatSelection: function(data){
	    	if( data.id == '' ){
    			$('#idxx_user').val('');
				$('#s2id_idxx_user a .select2-chosen').html('- - - Karyawan - - -');
    		}

	        return data.nama;
	    }
	});

	function reload_menu(){
		get_url_1('master/absensi');
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
	        	"url": "<?= site_url('master/absensi/list_data')?>",
	            "type": "POST",
	        },
	        "columnDefs": [
		        { 
		            "targets": [ 0, 5 ],
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
		            url : "<?= site_url('master/absensi/delete_data')?>/" + idx,
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

		if( $('#idxx_user').val() == '' || $('#idxx_user').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Karyawan cannot be empty.',
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
		            url : "<?= site_url('master/absensi/save_data') ?>",
		            type: "POST",
		            data: $('#form').serialize(),
		            dataType: "JSON",
		            success: function(data){

		            	if( data.status == 'ada' ){
		            		Swal.fire(
								'Saved!',
								'data already exists.',
								'warning'
							);
		            	}else if(data.status == true){
			            	Swal.fire(
								'Saved!',
								'data saved successfully.',
								'success'
							);

							// $('#modal_form').modal('hide');
							if( $('#idxx_absn').val() == '' ){
								$(".btn-save").attr("disabled", true);
							}else{
								$(".btn-save").attr("disabled", false);
							}
			                list_data();
			            }else{
			            	Swal.fire(
								'Saved!',
								'data failed to save.',
								'error'
							);
			            }
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
		$('#idxx_absn').val('');
		$('#nama_gift').val('');
		$('#tglx_absn').val('<?= date('d-m-Y') ?>');
		$('#jamx_msuk').val('<?= date('H:i') ?>');
		$('#jamx_klar').val('');
		$(".btn-save").attr("disabled", false);
		$('#idxx_user').val('');
		$('#s2id_idxx_user a .select2-chosen').html('- - - Karyawan - - -');
	}

	function edit_data(idx){

		reset_form();

		$.ajax({
	        url : "<?php echo site_url('master/absensi/edit_data/')?>" + idx,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){

	        	var tglSplit = data.tglx_absn.split('-');

	            $('#idxx_absn').val(data.idxx_absn);
	            $('#tglx_absn').val(tglSplit[2] + '-' + tglSplit[1] + '-' + tglSplit[0]);
	            $('#jamx_msuk').val(data.jamx_msuk.substring(0, 5));
	            $('#jamx_klar').val(data.jamx_klar.substring(0, 5));
    			$('#idxx_user').val(data.idxx_user);
				$('#s2id_idxx_user a .select2-chosen').html(data.nama_user);

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