<div class="row">
	<div class="col-md-8">
		<button type="button" class="btn btn-primary btn-bordered-primary" onclick="save_data()">Save</button>
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
			<form action="#" id="form" class="form-horizontal">
				<div class="form-group row">
		        	<div class="col-md-8">
		        	</div>
		        	<div class="col-md-4">
						<input type="text" name="idxx_role" id="idxx_role" class="select2-input">
					</div>
		        </div>
		        <hr>
		        <div class="form-group row">
		        	<table id="table_akses" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				        <thead>
				            <tr>
				                <th>Menu</th>
				                <th style="width: 65px; text-align: center;"><input type="checkbox" id="checkAll" onclick="checklistAll()"></th>
				            </tr>
				        </thead>
				        <tbody>
				        </tbody>
				    </table>
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
	        var markup = data.nama;
	        return markup;
	    },
	    formatSelection: function(data){
	    	if( data.id == '' ){
    			$('#idxx_role').val('');
				$('#s2id_idxx_role a .select2-chosen').html('- - - Access - - -');
				$('#table_akses tbody').empty();
    		}else{
    			get_modul(data.id);
    		}

	        return data.nama;
	    }
	});

	function reload_menu(){
		get_url_1('setting/Akses');
	}

	function get_modul(){
		$('#table_akses tbody').empty();
		$.ajax({
            url : "<?= site_url('setting/Akses/get_modul')?>",
            type: "POST",
            dataType: "JSON",
            success: function(result){
            	for (var i = 0; i < result.length; i++) {
					var str = '<tr>'+
								'<td>'+result[i]['nama_mdul']+'</td>'+
								'<td align="center"><input type="checkbox" class="cls_all" id="mdl_'+result[i]['idxx_mdul']+'" onclick="checkModul('+result[i]['idxx_mdul']+')"></td>'+
							'</tr>'+
							'<tr>'+
								'<td colspan="2"><div id="tbl_'+result[i]['idxx_mdul']+'"></div></td>'+
							'</tr>';

					$('#table_akses tbody').append(str);
					
					get_modul_child(result[i]['idxx_mdul']);
            	}
            }
        });
	}

	function get_modul_child(id){
		$.ajax({
            url : "<?= site_url('setting/Akses/get_modul_child/')?>" + id + "/" + $('#idxx_role').val(),
            type: "POST",
            dataType: "JSON",
            success: function(resultx){
            	for (var j = 0; j < resultx.length; j++) {

            		var chkd = '';
            		if( resultx[j]['idxx'] != 0 ){
            			chkd = 'checked';
            		}

					var strx = '<table width="100%" style="background-color: #fbfbfa;"><tr><td>'+
									resultx[j]['nama_menu']+
								'</td>'+
								'<td align="right" style="width: 52px;">'+
									'<input type="checkbox" '+chkd+' name="mnu_'+resultx[j]['idxx_menu']+'" id="mnu_'+resultx[j]['idxx_menu']+'" class="cls_'+id+' cls_all">'+
								'</td></tr></table>';

					$('#tbl_'+id).append(strx);
				}
            }
		});
	}

	function save_data(){

		if( $('#idxx_role').val() == "" || $('#idxx_role').val() == null ){
			Swal.fire(
				'Must choose!',
				'Access cannot be empty.',
				'warning'
			);
			return;
		}

		// console.log( $('#form').serialize() );

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
		            url : "<?= site_url('setting/akses/save_data')?>",
		            type: "POST",
		            data: $('#form').serialize(),
		            dataType: "JSON",
		            success: function(data){
		            	Swal.fire(
							'Saved',
							'data saved successfully.',
							'success'
						);
						reload_menu();
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                Swal.fire(
							'Saved',
							'data failed to save.',
							'error'
						);
		            }
		        });
			}
		});
	}

	function checklistAll(){
		if( $('#checkAll').is(":checked") == true ){
			$('.cls_all').prop('checked', true);
		}else{
			$('.cls_all').prop('checked', false);
		}
	}

	function checkModul(id){
		if( $('#mdl_'+id).is(":checked") == true ){
			$('.cls_'+id).prop('checked', true);
		}else{
			$('.cls_'+id).prop('checked', false);
		}
	}

</script>