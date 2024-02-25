<svg class="d-none" xmlns="http://www.w3.org/2000/svg">
  <symbol id="enlarge" viewBox="0 0 16 16">
    <path d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1h-4zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zM.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5z"/>
  </symbol>
  <symbol id="exit" viewBox="0 0 16 16">
    <path d="M5.5 0a.5.5 0 0 1 .5.5v4A1.5 1.5 0 0 1 4.5 6h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5zm5 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 10 4.5v-4a.5.5 0 0 1 .5-.5zM0 10.5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 6 11.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zm10 1a1.5 1.5 0 0 1 1.5-1.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4z"/>
  </symbol>
</svg>


<section id="landingHero" class="hero d-flex">
	<div id="container" class="container">
		<div class="d-flex flex-column justify-content-center align-items-center h-100 text-center">
			<h1 class="text-bg-primary px-3 display-1">Welcome to Tasker!</h1>

			<div class="text-bg-light text-primary px-3 display-6">
				<p class="m-0">A Web Based Task Management Solution</p>
			</div>
		</div>
	</div>
</section>

<section id="landingAbout">
	<div class="container py-5 px-4 px-md-0">
		<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
			<div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
				<h1 class="display-4 fw-bold lh-1 text-primary text-center text-lg-start">Tasker</h1>
				<h3 class="display-4 fw-bold lh-1 d-flex justify-content-center flex-wrap d-lg-block">Streamline Your <span class="text-primary">Workflow</span>, <br class="d-none d-md-block"><span class="text-primary">Achieve</span> More Together!</h3>
				<p class="lead">With Tasker, you can enhance clarity and effectiveness by linking tasks and workflows to overarching company objectives.</p>
			</div>
			<div class="col-lg-4 p-0 pb-3">
				<img class="rounded-lg-3 img-fluid" src="<?=base_url('assets/img/logo/logo_transparent.png')?>" alt="" width="720">
			</div>
		</div>
	</div>
</section>

<section id="landingFeatures">
	<div class="container-fluid">
		<div class="container px-4 py-5" id="custom-cards">
			<h2 class="pb-2 border-bottom text-primary border-primary">Features</h2>

			<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
				<div class="col">
					<div class="card card-cover h-100 overflow-hidden text-white bg-primary rounded-5 shadow-lg">
						<div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
							<h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Project Management</h2>
							<ul class="d-flex list-unstyled mt-auto">
								<li class="me-auto">
									<i class="rounded-circle border border-white fa fa-2x fa-project-diagram p-3"></i>
								</li>
								<li class="d-flex align-items-center">
									<button type="button" class="btn btn-outline-light"  data-bs-toggle="modal" data-bs-target="#projectModal">View Details</button>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card card-cover h-100 overflow-hidden text-white bg-primary rounded-5 shadow-lg">
						<div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
							<h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Task Management</h2>
							<ul class="d-flex list-unstyled mt-auto">
								<li class="me-auto">
									<i class="rounded-circle border border-white fa fa-2x fa-tasks p-3"></i>
								</li>
								<li class="d-flex align-items-center">
									<button type="button" class="btn btn-outline-light"  data-bs-toggle="modal" data-bs-target="#taskModal">View Details</button>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card card-cover h-100 overflow-hidden text-white text-bg-primary rounded-5 shadow-lg">
						<div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
							<h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">User Management</h2>
							<ul class="d-flex list-unstyled mt-auto">
								<li class="me-auto">
									<i class="rounded-circle border border-white fa fa-2x fa-users p-3"></i>
								</li>
								<li class="d-flex align-items-center">
									<button type="button" class="btn btn-outline-light"  data-bs-toggle="modal" data-bs-target="#userModal">View Details</button>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="landingGallery" class="photo-gallery">
  <div class="container">
  	<h2 class="pb-2 border-bottom text-white">Gallery</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 gallery-grid py-5">

    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/1_dashboard.png')?>" data-caption="Dashboard">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/1_dashboard.png')?>" />
    			<figcaption>Dashboard</figcaption>
    		</a>
    	</div>
    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/2_User_List.png')?>" data-caption="User List">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/2_User_List.png')?>" />
    			<figcaption>User List</figcaption>
    		</a>
    	</div>
    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/3_Project.png')?>" data-caption="Project List">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/3_Project.png')?>" />
    			<figcaption>Project List</figcaption>
    		</a>
    	</div>
    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/4_Task.png')?>" data-caption="Task List">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/4_Task.png')?>" />
    			<figcaption>Task List</figcaption>
    		</a>
    	</div>
    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/5_Assigned_Projects.png')?>" data-caption="Assigned Projects">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/5_Assigned_Projects.png')?>" />
    			<figcaption>Assigned Projects</figcaption>
    		</a>
    	</div>
    	<div class="col-sm-6 col-md-3 mb-4 text-center card bg-white bg-opacity-25">
    		<a class="card-body text-decoration-none text-white" data-fancybox="gallery" data-src="<?=base_url('assets/img/gallery/6_Add_Task.png')?>" data-caption="Add Task">
    			<img class="card-img" src="<?=base_url('assets/img/gallery/6_Add_Task.png')?>" />
    			<figcaption>Add Task</figcaption>
    		</a>
    	</div>
    	
    </div>
  </div>
</section>





<!-- Modals -->
<div class="modal fade" id="projectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">Project Management</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="m-0">Admin can create/update projects and assign them to specific team members.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="taskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">Task Management</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Admin can create/update tasks, assign them to specific team members, and set due dates.</p>
        <p class="m-0">Users can create/update tasks.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">User Management</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="m-0">Admin can create/update users.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
