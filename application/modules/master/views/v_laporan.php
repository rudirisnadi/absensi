<div class="row">
	<div class="col-md-12">
		<div class="card-box">
			<form action="#" id="form" class="form-horizontal">
				<div class="form-group row">
		        	<div class="col-md-3">
		        		<label>Karyawan</label>
						<input type="text" name="idxx_user" id="idxx_user" class="select2-input">
					</div>
		        	<div class="col-md-2">
		        		<label>Bulan</label>
						<select id="bulan" name="bulan">
							<option value="">--Pilih--</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
		        	</div>
		        	<div class="col-md-2">
		        		<label>Tahun</label>
						<select id="tahun" name="tahun">
							<option value="">--Pilih--</option>
							<?php
								for ($i=(date('Y')-3); $i <= date('Y'); $i++) { 
							?>
									<option value="<?= $i ?>"><?= $i ?></option>
							<?php
								}
							?>
						</select>
		        	</div>
		        	<div class="col-md-1">
		        		<label>&nbsp;</label><br>
		        		<button type="button" class="btn btn-success btn-bordered-success" onclick="cari_data()">Cari</button>
		        	</div>
		        	<div class="col-md-4">
						<h2 class="h5 no-margin-bottom" style="text-align: right; color: silver;"><i><?= $judul ?></i></h2>
					</div>
		        </div>
		        <hr>
		        <div class="form-group row" id="list_data">
		        </div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$('#bulan').select2();
	$('#tahun').select2();

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

	function cari_data(){
		
		if( $('#idxx_user').val() == '' || $('#idxx_user').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Karyawan cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#bulan').val() == '' || $('#bulan').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Bulan cannot be empty.',
				'warning'
			);
			return;
		}

		if( $('#tahun').val() == '' || $('#tahun').val() == null ){
			Swal.fire(
				'Required to fill!',
				'Tahun cannot be empty.',
				'warning'
			);
			return;
		}

		$('#list_data').empty();

		$.ajax({
            url : "<?= site_url('master/laporan/get_data')?>",
            type: "POST",
            data: {
            	idxx_user : $('#idxx_user').val(),
            	bulan : $('#bulan').val(),
            	tahun : $('#tahun').val()
            },
            dataType: "JSON",
            success: function(result){
            	var numb = 0;
            	for (var i = 0; i < result.length; i++) {
            		numb++;

            		if( result[i] == null ){

            			var str = '<div class="col-md-2" style="height: 83px; border: silver 1px solid; padding-left: 10px; padding-top: 7px;">'+
				        			'<span class="badge badge-secondary">'+numb+'</span>'+
				        			'<br><br>'+
				        			'<span class="badge badge-danger" style="width: 100%;">Tidak Hadir</span>'+
					        	'</div>';

            		}else{

						var str = '<div class="col-md-2" style="height: 83px; border: silver 1px solid; padding-left: 10px; padding-top: 7px;">'+
					        			'<span class="badge badge-secondary">'+numb+'</span>'+
					        			'<br><br>'+
					        			'<span class="badge badge-success">Hadir</span>&nbsp;'+
					        			'<span class="badge badge-info">masuk : '+result[i]['jamx_msuk'].substring(0,5)+'</span>&nbsp;'+
					        			'<span class="badge badge-warning">keluar : '+result[i]['jamx_klar'].substring(0,5)+'</span>'+
						        	'</div>';
					}

					$('#list_data').append(str);
            	}
            }
        });
	}

</script>