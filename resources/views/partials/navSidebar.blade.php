<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
    	 <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
	        </div>
	        <div class="info">
	          <a href="#" class="d-block">Alexander Pierce</a>
	        </div>
	      </div>
	       <nav class="mt-2">
	       	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          @if(Auth::guard('web')->check())
	          		@if(Auth::user()->account_type == "Student")
			          <li class="nav-item has-treeview">
			            <a href="{{route('student_record')}}" class="nav-link">
			              <i class="nav-icon fas fa-tachometer-alt"></i>
			              <p>
			                Records
			              </p>
			            </a>
			          </li>
			          <li class="nav-item has-treeview">
					       <a href="{{route('guest_logout')}}" class="nav-link">
				              <i class="nav-icon fas fa-tachometer-alt"></i>
				              <p>
				                Logout
				              </p>
				            </a>
				        </li>
			        @endif
			        @if(Auth::user()->account_type == "Teacher")
			        	<li class="nav-item has-treeview">
			            <a href="{{route('lists_student')}}" class="nav-link">
			              <i class="nav-icon fas fa-tachometer-alt"></i>
			              <p>
			                Students
			              </p>
			            </a>
			          </li>
			           <li class="nav-item has-treeview">
					       <a href="{{route('guest_logout')}}" class="nav-link">
				              <i class="nav-icon fas fa-tachometer-alt"></i>
				              <p>
				                Logout
				              </p>
				            </a>
				        </li>
			        @endif
	          @endif
	          @if(Auth::guard('admin')->check())
		          <li class="nav-item has-treeview">
		            <a href="{{route('teacher_all')}}" class="nav-link">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Teachers
		                <i class="right fas fa-angle-left"></i>
		              </p>
		            </a>
		            <ul class="nav nav-treeview">
		              <li class="nav-item">
		                <a href="{{route('teacher_create')}}" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Add</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="{{route('teacher_all')}}" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>View</p>
		                </a>
		              </li>
		         </ul>
		         <li class="nav-item has-treeview">
		            <a href="#" class="nav-link">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Students
		                <i class="right fas fa-angle-left"></i>
		              </p>
		            </a>
		            <ul class="nav nav-treeview">
		              <li class="nav-item">
		                <a href="{{route('students.create')}}" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Add</p>
		                </a>
		              </li>
		         </ul>
	          </li>
	           <li class="nav-item has-treeview">
	            <a href="{{route('section_all')}}" class="nav-link">
	              <i class="nav-icon fas fa-tachometer-alt"></i>
	              <p>
	                Sections
	              </p>
	            </a>
	           </li>
	            <li class="nav-item has-treeview">
	            <a href="{{route('subject_all')}}" class="nav-link">
	              <i class="nav-icon fas fa-tachometer-alt"></i>
	              <p>
	                Subjects
	              </p>
	            </a>
	           </li>
	           <li class="nav-item has-treeview">
	            <a href="{{route('enroll_students')}}" class="nav-link">
	              <i class="nav-icon fas fa-tachometer-alt"></i>
	              <p>
	                Enrolls
	              </p>
	            </a>
	           </li>
	            <li class="nav-item has-treeview">
		       <a href="{{route('logout')}}" class="nav-link">
	              <i class="nav-icon fas fa-tachometer-alt"></i>
	              <p>
	                Logout
	              </p>
	            </a>
	        </li>
	         @endif
	        
	       </ul>
	     </nav>
	</div>
</aside>