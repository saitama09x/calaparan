$(document).ready(function(){
		var api = new API();


		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd'
		})

		var load_records = function(){
			var dom = $("#dom-load");
			var div = $("<div>");
			div.addClass("d-flex justify-content-center");
			var img = $("<img>");
			img.attr('src', api.base_url + "/assets/img/loader1.gif");
			div.html(img);
			dom.html(div);
			var enroll_id = $("meta[name='enroll-id']").data('id')
			api.student_load(enroll_id, function(res){
				$("#dom-load").html(res)
			});
		}

		var load_remedial = function(){
			var enroll_id = $("meta[name='enroll-id']").data('id')
			var dom = $("#remedial-load");
			var div = $("<div>");
			div.addClass("d-flex justify-content-center");
			var img = $("<img>");
			img.attr('src', api.base_url + "/assets/img/loader1.gif");
			div.html(img);
			dom.html(div);
			api.remedial_load(enroll_id, function(res){
				$("#remedial-load").html(res)
			});
		}
		
		load_records();
		load_remedial();

		var edit_modal = $("#edit_modal");
		var remarks_modal = $("#remarks_modal");
		var remedial_modal = $("#remedial_modal");
		var remedial_remarks_modal = $("#remedial_remarks_modal");

		$('#remark_area').summernote({
			placeholder : 'Please write your remarks',
			height: 200,
			focus: true,
			toolbar: [
	          ['style', ['style']],
	          ['font', ['bold', 'underline', 'clear']],
	          ['color', ['color']],
	       	]
		})

		$('.remedial-rem').summernote({
			placeholder : 'Please write your remarks',
			height: 200,
			focus: true,
			toolbar: [
	          ['style', ['style']],
	          ['font', ['bold', 'underline', 'clear']],
	          ['color', ['color']],
	       	]
		})

		$("[name^='quarter']").click(function(){

			var val = $(this).val();
			var enroll_id = $("meta[name='enroll-id']").data('id')
			var gradeval = $("[name^='gradeval']");

			api.get_qtr_record({ enroll_id : enroll_id, qtr : val}, function(res){
					if(res){
						gradeval.each(function(index, item){
							var id = $(this).data("id");
							$(this).val(res.records[id]);
						})
					}
			});


		})

		$("#studentrecord").on('submit', function(e){
			e.preventDefault();
			var gradeval = $("[name^='gradeval']");
			var quarter = $("[name^='quarter']");
			var enroll_id = $("meta[name='enroll-id']").data('id')

			var form = new FormData();
			form.append('enroll_id', enroll_id)

			quarter.each(function(index, val){
				if($(this).is(":checked")){
					form.append('quarter', $(this).val());
				}
			})

			gradeval.each(function(index, val){
				form.append('gradeval['+index+']', JSON.stringify(
					{ 
					code : $(val).data('id'), 
					value : $(val).val()
					}
				))
			})

			api.insert_record(form, function(res){
				if(res){
					edit_modal.modal('hide')
					load_records()
				}
			})

		})

		$("#btn-update").click(function(){
			$("#studentrecord").trigger('submit');
		})

		$("#btn-remedial").click(function(){

			var checkrem = $(".remedial-check");
			var enroll_id = $("meta[name='enroll-id']").data('id')
			var remdate_from = $("#remdate-from").val();
			var remdate_to = $("#remdate-to").val();

			var sub_arr = [];
			checkrem.each(function(index, item){
				var val = $(this).val();
				if($(this).is(":checked")){
					sub_arr.push(val);
				}
			})
			
			var form = new FormData();

			form.append('enroll_id', enroll_id);
			form.append('remdate_from', remdate_from);
			form.append('remdate_to', remdate_to);
			form.append('subjects', JSON.stringify(sub_arr));

			sub_arr.map(function(val){

				var final =  $("input[name='finalval[" + val + "]'").val()

				form.append("finalval[" + val + "]", final);

				var mark = $("input[name='markval[" + val + "]'").val();

				form.append("markval[" + val + "]", mark);

				var remcom = $("input[name='recomval[" + val + "]'").val();

				form.append("recomval[" + val + "]", remcom);

			})

			api.insert_remedial(form, function(res){
				if(res){
					remedial_modal.modal('hide');
					load_remedial();
				}
			})

		})

		var subj = ''
		var enroll_id = ''

		$("#dom-load").on("click", '.btn-add-remarks', function(){
			subj = $(this).data('subjcode');
			enroll_id = $(this).data('eid');
		})

		$("#remedial-load").on("click", '.btn-add-remarks', function(){
			subj = $(this).data('subjcode');
			enroll_id = $(this).data('eid');
		})

		$("#btn-remarks").click(function(){
			var val = $('#remark_area').summernote('code');
			var form = new FormData();
			form.append('subjcode', subj);
			form.append('enroll_id', enroll_id);
			form.append('value', val);

			api.add_remarks(form, function(res){
				if(res){
					remarks_modal.modal('hide')
					load_records()
				}
			})
		})

		$("#btn-remarks_remedial").click(function(){

			var val = $('.remedial-rem').summernote('code');
			var form = new FormData();
			form.append('subjcode', subj);
			form.append('enroll_id', enroll_id);
			form.append('value', val);
			api.insert_remarks_remedial(form, function(res){
				if(res){
					remedial_remarks_modal.modal('hide')
					load_remedial()
				}
			})

		})

		$("#update-values").click(function(){
			var data_obj = [];
			var enroll_id = $("meta[name='enroll-id']").data('id')
			var quarter = $("input[name^='quarter_values']");
			var sel_quarter;
			
			quarter.each(function(){
				if($(this).is(":checked")){
					sel_quarter = $(this).val()
				}
			})

			$("[name^='bh-select["+sel_quarter+"']").each(function(index, item){
				var val = $(this).val();
				var id = $(this).data('id')

				if(val != ''){
					var obj = {'id' : id, 'val' : val}
					data_obj.push(obj);
				}
			});

			var data = {
				enroll_id : enroll_id,
				quarter : sel_quarter,
				data : data_obj
			}

			api.insert_core_values(data, function(res){
				alert("successfully saved")
			})

		})

})