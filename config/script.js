	$(document).ready(function(){
		$("#loader").hide();
		$(".loader").hide();
		$("#lokasi").change(function(){
			var id = $("#lokasi").val();
			if(id!=""){
				$.get("get_lokasi.php", { id:id},function(data){
				$("#map").html(data);});
			}else{
				alert('Anda belum memilih Provinsi');
				$("#lokasi").html("");
			}
		});
		$("#more").click(function(){
			var tanggal = $("#last_loaded").val();
			if(tanggal!=""){
				$("#loader").show();
				$.get("get_artikel.php", { tanggal:tanggal},function(data){
					var ll=$(data).find("#laast_loaded").val();
					console.log(ll);
					if(typeof ll != 'undefined'){
						$("#last_loaded").val(ll);
						$(data).appendTo("#berita");
					}
					else{
						$("#last_loaded").val(ll);
						$(data).appendTo("#berita");
					}
					$("#loader").hide();
				});
			}
		});
		$(".btn-gambar").click(function(){
			var idcabang = $(this).data('idcabang');
			var tanggal;
			if(idcabang=="semua"){
				tanggal=$(".tanggal_all").val();
			}else if(idcabang=="other"){
				tanggal=$(".tanggal_other").val();
			}else{
				tanggal=$("#"+idcabang).val();
			}
			$(".loader").show();
			if(tanggal!="kosong"){
				$.get("get_gambar.php", { idcabang:idcabang,tanggal:tanggal},function(data){
				var ll=$(data).find("#laast_loaded").val();
						if(idcabang=="semua"){
							$(data).appendTo("#tab_all");
							$(".tanggal_all").val(ll);
						}else if(idcabang=="other"){
							$(".tanggal_other").val(ll);
							$(data).appendTo("#tab_other");
						}else{
							$("#"+idcabang).val(ll);
							$(data).appendTo("#tab_"+idcabang);
						}
					$(".loader").hide();
			})}else{
				$(".loader").hide();
			}
		});
	var id = 'semua';
	if(id!=""){
		$.get("get_lokasi.php", { id:id},function(data){
		$("#map").html(data);});
	}else{
		alert('Anda belum memilih Provinsi');
		$("#lokasi").html("");
	}			
	});