
function API(){
	
	this.base_url = "http://calaparan.xpsjobs.ph/";

	const instance = axios.create({
	  baseURL: 'http://calaparan.xpsjobs.ph/ajax-json/',
	  timeout: 5000,
	  headers: false,
	});


	this.insert_record = function(obj, func){
		instance.post('data-insert-record', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.get_qtr_record = function(obj, func){

		instance.get('data-qtr-record', {
			params: {
		      id: obj.enroll_id,
		      qtr : obj.qtr
		    }
		}).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.add_remarks = function(obj, func){
		instance.post('data-insert-remarks', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.student_load = function(enroll_id, func){
		instance.get('data-show-student', {
			params: {
		      id: enroll_id
		    }
		}).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})
	}

	this.remedial_load = function(enroll_id, func){
		instance.get('data-show-remedial', {
			params: {
		      id: enroll_id
		    }
		}).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})
	}

	this.insert_remedial = function(obj, func){
		instance.post('data-insert-remedial', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.insert_remarks_remedial = function(obj, func){
		instance.post('data-remarks-remedial', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.insert_core_values = function(obj, func){

		instance.post('insert-core-values', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

	this.update_profile_pic = function(obj, func){

		instance.post('update-profile-pic', obj, [{

		}]).then(function(res){
			if(res.status == 200){
				func(res.data)
			}
		})

	}

}

function DataTable(){

	this.listStudent = function(table){

		var dt = $('#datatable').DataTable({
			"processing": true,
        	"serverSide": true,
	        "ajax": {
	        	"url" : "http://localhost/calaparan/public/ajax-json/data-students",
	        	'type' : 'POST',
	        	 beforeSend : function(xhr) {
	        	 	var token = $('meta[name="csrf-token"]').attr('content')
			        xhr.setRequestHeader('X-CSRF-TOKEN', token);
			    }
	        },
	        "columns": [
	            { "data": "first_name" },
	            { "data": "middle_name" },
	            { "data": "last_name" },
	            { "data": "section" },
	            { "data": "gradeyr" },
	            { "data": "action" }
	        ],
	        "order": [[1, 'asc']]
	    });

		table(dt)
	}

	this.show_details =  function(table){
		return format = "<table class='table'><thead><tr><th>Grade Year</th><th>From</th><th>To</th><th>Section</th><th>Action</th></tr></thead><tbody></tbody></table>"
	}
	

	this.section_studentList = function(table, section_id, school_yr){

		var dt = $('#datatable').DataTable({
			"processing": true,
        	"serverSide": true,
	        "ajax": {
	        	"url" : "http://localhost/calaparan/public/ajax-json/section-students",
	        	'type' : 'POST',
	        	 data : { section : section_id, school_yr : school_yr },
	        	 beforeSend : function(xhr) {
	        	 	var token = $('meta[name="csrf-token"]').attr('content')
			        xhr.setRequestHeader('X-CSRF-TOKEN', token);
			    }
	        },
	        "columns": [
	            { "data": "student_name" },
	            { "data": "status" },
	            { "data": "enroll_route" },
	        ],
	        "columnDefs": [
	        	{
	        		render : function ( data, type, row ) {
	        			return "<a href='" + data + "' class='btn btn-sm btn-primary'>View Enrollment</a>";
	        		},
	        		targets : 2
	        	}
	        ]
		});

		table(dt)

	}

}